<?php

namespace App\Http\Controllers\AdminController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Contact;
use Auth;
use Toastr;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMailAdmin;
use App\User;
use Carbon\Carbon;

class ContactController extends Controller
{
    public function index()
    {
        // dd('ok');
    	$arcontact = DB::table('contacts')->orderBy('updated_at', 'desc')->get();
    	return view('admin.contact.index',['contacts'=> $arcontact]);
    }

    public function View(Request $request)
    {
        $id = $request->aid;
        $contact= Contact::find($id);
        Contact::where('id','=',$id)->update(['view'=>1]);
        $name = $contact->name;
        $email = $contact->email;
        $content = $contact->content;
        $reply   = $contact->reply;
        return response()->json(['name'=>$name,'email'=>$email, 'content'=>$content, 'id' => $id,'reply'=> $reply]);
    }

    public function getcount(Request $req)
    {
    	$countcontact = count(Contact::where('view','=',0)->get());
    	return $countcontact;
    }

    public function getall(Request $req)
    {
        $countcontact = count(Contact::where('view','=',0)->get());
        return $countcontact;
    }

    public function arContact(Request $req)
    {
        $contact = Contact::all();
        $str ="";
        function ham_dao_nguoc_chuoi($str)
        {
            //tách mảng bằng dấu cách
            $arStr = explode(' ',$str);
            $arNgay = explode('-', $arStr[0]);
            return  $arStr[1].' '.$arNgay[2].'-'.$arNgay[1].'-'.$arNgay[0];
        }
        foreach ($contact as $key => $value) {
            $time = Carbon::parse($value->created_at)->diffForHumans();
            if ($value->view == 0 ) {
                $str .= '<li onclick="modelView('.$value->id.')">
                        <a href="javascript:void(0)">
                          <div class="pull-left">
                              <img src="'.asset('images/logo/avata.png').'" class="img-circle" alt="User Image">
                          </div>
                          <h4>
                            '.$value->name.'
                            <small><i class="fa fa-clock-o"></i> '.$time.'</small>
                          </h4>
                          <p>'.$value->content.'</p>
                        </a>
                    </li>';
            }

        }

        return $str;
    }

    public function setStar(Request $req)
    {
    	$id = $req->aid;
        $gt= $req->aso;
        // dd($id);
        if($id>0){
            if ($gt==0) {

                Contact::where('id','=',$id)->update(['star' => 1]);

                echo '<a href="javascript:void(0)" onclick="setStar('.$id.',1)"><i class="fa fa-star text-yellow"></i></a>';
            }
            if ($gt==1) {

                Contact::where('id','=',$id)->update(['star' => 0]);

                echo '<a href="javascript:void(0)" onclick="setStar('.$id.',0)"><i class="fa fa-star text-black"></i></a>';
            }
        }
    }

    public function destroy(Request $request)
    {
    	$listcontacts = $request->checkall;
    	// dd($listcontacts);
        if ($listcontacts == null) {
            $request->session()->flash('msg-e','Mời chọn để xóa !');
            return redirect()->route('admin.contact.index');
        }
        for ($i=0; $i < count($listcontacts); $i++) {
            $contacts = Contact::find($listcontacts[$i]);
            $contacts->delete();
        }
        $request->session()->flash('msg-s','Delete complated');
        return redirect()->route('admin.contact.index');
    }

    public function reply(Request $request)
    {
        $contact_from = Contact::create(['name' => Auth::user()->name, 'email' => Auth::user()->email,
            'content' => trim($request->content), 'reply' => $request->contact_id, 'view' => 1]);
        $contact_to = Contact::find($request->contact_id);
        Mail::to($contact_to)->send(new ContactMailAdmin($contact_from));
        $request->session()->flash('msg-s','Replied');
        return redirect()->route('admin.contact.index');
    }
}
