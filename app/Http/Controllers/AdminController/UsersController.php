<?php

namespace App\Http\Controllers\AdminController;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Validator;
use App\User;
use App\Permission_user;
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
        $aruser = User::all();
        return view('admin.user.index', ['arUser'=>$aruser]);
    }


    public function seeProfile($id)
    {
        $arUser = User::find($id);
        $count  = count(Product::where('user_id','=',$id)->get());
        return view('admin.user.User_detail',['aruser'=>$arUser,'count'=>$count]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.create');
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

                User::create(['name'=>$username,'email'=>trim($request->gmail), 'password'=>bcrypt($request->password),'address'=>trim($request->address), 'picture'  => $endPic ]);

                $arnewuser = User::where('email','=',trim($request->gmail) )->get();
                // dd($arnewuser[0]['id']);
                Permission_user::create(['user_id'=>$arnewuser[0]['id'], 'permission_id' => 1 ]);
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
        $aruser = User::find($id);
        return view('admin.user.edit',['aruser'=>$aruser]);
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
        $objUser = User::find($id);
        
        $tenanhcu = $objUser['picture']; //data
        $pathOldPic = storage_path('public/admins/'.$tenanhcu);
        //is_file kiểm tra khác rỗng
        if (is_file($pathOldPic) && ($tenanhcu != "") ) {
            //xóa ảnh cũ
            Storage::delete('public/admins/'.$tenanhcu); // xóa trong file
        }
        $arpermis = Permission_user::where('user_id','=',$id)->get();
        DB::table('permission_user')->where('user_id', '=',$arpermis[0]->user_id)->delete();
        if ($objUser != null) {
            $objUser->delete();
        }
        
        $request->session()->flash('msg-s', 'Delete thành công');
        return redirect()->route('admin.users');
    }
}
