<?php

namespace App\Http\Controllers\AdminController;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Provider;
class ProviderController extends Controller
{
    public function index()
    {
    	$providers = Provider::paginate(10);
    	return view('admin.provider.index',['providers'=>$providers]);
    }

    public function store(Request $req)
    {
    	Provider::create([
    			'name' => $req->aname,
    			'phone' => $req->aphone,
    			'address' => $req->aaddress,
    			'email' => $req->aemail
    		]);
    	return "Thêm thành công ";
    }

    public function edit($slug, $id)
    {
    	$provider = Provider::find($id);
    	if ($provider == "") {
    		session()->flash('msg-r','Update thất bại ');
    		return redirect()->route('provider.index');
    	}
    	return view('admin.provider.edit',['provider'=>$provider]);
    }
    public function update(Request $request)
    {
    	$id = $request->id;
    	$provi = Provider::find($id);
    	$inputs = $request->all();
        $rules = array(
            'name' => 'required|min:5',
            'phone' => 'required|min:5',
            'address' => 'required|min:5',
            'email' => 'required|min:5',
            );
        $message = array(
            'required' => 'Xin mời nhập !',
            'min'      => 'Nhỏ nhất là 5 kí tự',
            );
        $validator = Validator::make($inputs, $rules, $message);
        if ($validator->fails()) {
            return redirect()->route('provider.edit',['slug'=>str_slug($provi->name), 'id'=>$id])
                        ->withErrors($validator)
                        ->withInput();
        }
		$provi->name    = $request->name;
		$provi->phone   = $request->phone;
		$provi->address = $request->address;
		$provi->email   = $request->email;
		$provi->update();
    	$request->session()->flash('msg-s','Update thành công');
    	return redirect()->route('provider.index');
    }

    public function destroy(Request $request)
    {
    	Provider::where('id','=',$request->aid)->delete();
    	return "Xóa thành công ";
    }
}
