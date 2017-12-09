<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\User;
use Toastr;

class AuthController extends Controller
{

	public function login()
	{
		if (Session::get('USERNAME')) {
			return redirect()->route('admin.index');
		}else{
			return view('admin.login.index');	
		}
		
	}

	public function postLogin(Request $request)
	{
		$username = $request->username;
    	$password = $request->password;
    	if (Auth::attempt(['email'=>$username, 'password'=> $password])) {
	    	$username = $request->username;
	    	$password = $request->password;
	    	$arID = User::where('email','=',$username)->select('*')->get();
	            $id = $arID[0]['id'];
	            $picture = $arID[0]['picture'];
	            $gmail = $arID[0]['email'];
	            $request->session()->put('USERNAME',$arID[0]['name']);
	            $request->session()->put('PASSWORD', $password);
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
