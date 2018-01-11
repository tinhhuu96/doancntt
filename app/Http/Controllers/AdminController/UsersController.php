<?php

namespace App\Http\Controllers\AdminController;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Validator;
use App\User;
use App\Permission;
use App\Product;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        if (Session::get('USERNAME') == 'admin') {
            $aruser = DB::table('users')->get();
            return view('admin.user.index', ['arUser'=>$aruser]);
        }else{
            return view('error.404');
        }

    }


    public function seeProfile($id)
    {
        if (Session::get('USERNAME') == 'admin') {
            $arUser = User::find($id);
            // $count  = count(Product::where('user_id','=',$id)->get());
            return view('admin.user.User_detail',['aruser'=>$arUser]);
        }else{
            return view('error.404');
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Session::get('USERNAME') == 'admin') {
            return view('admin.user.create');
        }else{
            return view('error.404');
        }

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $username = trim($request->username);
        $inputs = $request->all();
        $rules = array(
            'username' => 'required|min:3|max:20',
            'gmail' => 'required|email',
            'password' => 'required|min:5|max:20',
            'password_confirmation' => 'required|same:password',
            'address'  => 'required',
            );
        $message = array(
            'required' => 'Xin mời nhập !',
            'username.min'=> 'Nhỏ nhất là 3 kí tự',
            'min'      => 'Nhỏ nhất là 5 kí tự',
            'max'      => 'Lớn nhất là 20 kí tự',
            'gmail.emai'=>'Không đúng định dạng',
            'same'      => 'Mật khẩu không trùng khớp',
            'fullname.max'    => 'Lớn nhất 50 kí tự',
            );
        $validator = Validator::make($inputs, $rules, $message);
        if ($validator->fails()) {
            return redirect('/adminpc/User/user-add')
                        ->withErrors($validator)
                        ->withInput();
        }
        if($username != 'admindemo' && $username!='mod'){
            $endPic= "";
            if ($request->avata != "") {
                $path = $request->file('avata')->store('public/admins');
                $tmp  = explode('/',$path);
                $endPic = end($tmp);
            }
            if ($request->username != "") {

                User::create(['name'=>$username,'email'=>trim($request->gmail), 'password'=>bcrypt($request->password),'phone'=>$request->phone,'address'=>trim($request->address), 'picture'  => $endPic ]);
                $request->session()->flash('msg-s','Thêm thành công');
                return redirect()->route('admin.users');

            }else{
                $request->session()->flash('msg-e','Không thể thêm admin');
                return redirect()->route('admin.users');
            }
        }else{
            $request->session()->flash('msg-e','Thêm thất bại !');
           return redirect()->route('admin.users');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug, $id)
    {
        if (Session::get('USERNAME') == 'admin') {
            $aruser = User::find($id);
            return view('admin.user.edit',['aruser'=>$aruser]);
        }else{
            return view('error.404');
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $objUser = User::find($id);
        $id = $objUser['id'];
        $passold = $objUser['password'];
        $username= $request->username;
        $slug = str_slug($objUser['name']);
        $password_old = $request->password_old ;

        $inputs = $request->all();
        $rules = array(
            'gmail' => 'required|email',
            'password_old' => 'required',
            'address'  => 'required',
            );
        $message = array(
            'required' => 'Xin mời nhập !',
            'name.min'=> 'Nhỏ nhất là 3 kí tự',
            'min'      => 'Nhỏ nhất là 5 kí tự',
            'max'      => 'Lớn nhất là 20 kí tự',
            'gmail.emai'=>'Không đúng định dạng',
            'same'      => 'Mật khẩu không trùng khớp',
            'fullname.max'    => 'Lớn nhất 50 kí tự',
            );
        $validator = Validator::make($inputs, $rules, $message);
        if ($validator->fails()) {
            return redirect()->route('admin.user.edit',['id'=>$id, 'slug'=>$slug])->withErrors($validator)->withInput();
        }

        if ($request->password != "") {
            $objUser->password = bcrypt($request->password);
        }

        if ($request->gmail) {
            $objUser->email = trim($request->gmail);
        }
        if ($request->address) {
            $objUser->address = trim($request->address);
        }
        if (Hash::check($password_old, $passold)) {
             //check password
            if ($username != 'admindemo' && $username!='mod') {
                if($request->avata != "" ){ // upload có ảnh
                    $tenanhcu = $objUser->picture; //data
                    $pathOldPic = storage_path('public/admins/'.$tenanhcu);
                    //is_file kiểm tra khác rỗng
                    if (is_file($pathOldPic) && ($tenanhcu != "") ) {
                        //xóa ảnh cũ
                        Storage::delete('public/admins/'.$tenanhcu); // xóa trong file
                    }
                    $path = $request->file('avata')->store('public/admins');
                    $tmp = explode('/',$path);
                    $tenanhmoi = end($tmp);
                    // dd($tenanhmoi);
                    $objUser->picture = $tenanhmoi;
                }else{
                    if ($request->delete_picture != "") {
                        // dd('lỗi');
                        $tenanhcu = $objUser->picture; //data
                        $pathOldPic = storage_path('public/admins/'.$tenanhcu);
                        //is_file kiểm tra khác rỗng
                        if (is_file($pathOldPic) && ($tenanhcu != "") ) {
                            //xóa ảnh cũ
                            Storage::delete('public/admins/'.$tenanhcu); // xóa trong file
                        }
                        $objUser->picture = "";

                    }
                }
                $objUser->update();
                $request->session()->flash('msg-s','Sửa thành công ');
                return redirect()->route('admin.users');
            }else{
                $request->session()->flash('msg-e','Sửa Thất bại ');
                return redirect()->route('admin.users');
            }
        }else{
            $request->session()->flash('msg-e','Mật khẩu cũ sai ');
            return redirect()->route('admin.user.edit',['id'=>$id, 'slug'=>$slug]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        if (Session::get('USERNAME') == 'admin') {
            $objUser = User::find($id);

            $tenanhcu = $objUser['picture']; //data
            $pathOldPic = storage_path('public/admins/'.$tenanhcu);
            //is_file kiểm tra khác rỗng
            if (is_file($pathOldPic) && ($tenanhcu != "") ) {
                //xóa ảnh cũ
                Storage::delete('public/admins/'.$tenanhcu); // xóa trong file
            }
            if ($objUser != null) {
                $objUser->delete();
            }

            $request->session()->flash('msg-s', 'Delete thành công');
            return redirect()->route('admin.users');
        }else{
            return view('error.404');
        }
    }
}
