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
use App\Http\Requests\CreateUserRequest;
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
        $user = Session::get('USERNAME');
        if ($user == 'admin') {
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
    public function store(CreateUserRequest $request)
    {
        $name = trim($request->name);
        $inputs = $request->all();
        $endPic= "";
        if ($request->avata != "") {
            $path = $request->file('avata')->store('public/admins');
            $tmp  = explode('/',$path);
            $endPic = end($tmp);
        }
        $user = User::create(['name'=>$name,'email'=>trim($request->email),
            'password'=>bcrypt($request->password),'phone'=>$request->phone,
            'address'=>trim($request->address), 'picture'  => $endPic, 'permission_id' => $request->permission]);
        if ($user) {
            $request->session()->flash('msg-s','Thêm thành công');
        }else{
            $request->session()->flash('msg-e','Không thể thêm admin');
        }
            return redirect()->route('admin.users');
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
        $username= $request->username;
        $slug = str_slug($objUser['name']);

        if ($request->gmail) {
            $objUser->email = trim($request->gmail);
        }
        if ($request->address) {
            $objUser->address = trim($request->address);
        }
        $inputs = $request->all();
        $rules = array(
            'gmail' => 'required|email',
            'address'  => 'required',
            );
        $message = array(
            'required' => 'Xin mời nhập !',
            'min'      => 'Nhỏ nhất là 5 kí tự',
            'max'      => 'Lớn nhất là 20 kí tự',
            'gmail.emai'=>'Không đúng định dạng',
            );
        $validator = Validator::make($inputs, $rules, $message);
        if ($validator->fails()) {
            return redirect()->route('admin.user.edit',['id'=>$id, 'slug'=>$slug])->withErrors($validator)->withInput();
        }
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
        
        if ($objUser->update()) {
            $request->session()->flash('msg-s','Sửa thành công !');
        }else{
            $request->session()->flash('msg-s','Sửa thất bại ! ');
        }
        
        return redirect()->route('admin.users');
            
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
