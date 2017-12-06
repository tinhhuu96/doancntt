<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Toastr;

class AuthController extends Controller
{

	public function login()
	{
		return view('admin.login.index');
	}

	public function postLogin(Request $request)
	{
		$username = $request->username;
    	$password = $request->password;
    	if (Auth::attempt(['name'=>$username, 'password'=> $password])) {
	    	$username = $request->username;
	    	$password = $request->password;
	    	$arID = User::where('name','=',$username)->select('*')->get();
	            $id = $arID[0]['id'];
	            $picture = $arID[0]['picture'];
	            $gmail = $arID[0]['email'];
	            $fullname = $arID[0]['fullname'];
	            $request->session()->put('USERNAME',$arID[0]['name']);
	            $request->session()->put('PASSWORD', $password);
	            $request->session()->put('FULLNAME', $fullname);
	            $request->session()->put('PICTURE',$picture);
	            $request->session()->put('GMAIL',$gmail);
	            $request->session()->put('ID',$id);
	    		return redirect()->route('admin.index');
	    	}else{
	    		$request->session()->flash('msg-e', 'Đăng nhập thất bại');
	    		return redirect()->route('admin.login');
	    	}
	}

	public function logout(Request $request)
	{
		$request->session()->flush();
        Auth::logout();
        return redirect()->route('admin.login');
	}


}
