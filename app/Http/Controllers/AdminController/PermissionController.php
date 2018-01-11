<?php

namespace App\Http\Controllers\AdminController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Validator;
use App\Permission;
use App\User;

class PermissionController extends Controller
{
    public function index()
    {
        if (Session::get('USERNAME') == 'admin') {
            $arpermis = Permission::all();
            $arUser = User::all();
            return view('admin.user.permission', [ 'arpermis'=>$arpermis, 'aruser'=>$arUser]);
        }else{
            return view('error.404');
        }
    	
    }

    public function store(Request $request)
    {
        if ($request->aname == "") {
            return response()->json(['alert'=>'Lỗi nhập rỗng !', 'a'=>'e']) ;
        }
        $ar = count(Permission::where('name','=',$request->aname)->get());
        if ($ar > 0) {
            return response()->json(['alert'=>'Nhập vào tồn tại !', 'a'=>'e']) ;
        }
        Permission::create(['name'=>$request->aname]);
        return response()->json(['alert'=>'Thêm thành công !', 'a'=>'s']) ;
    }

    public function setPermission(Request $request)
    {
    	$iduser = $request->auser;
    	$idpermis= $request->apermis;
    	$idperuser = $request->aidperuser;
    	if($idpermis == 1){
    		return 0;
    	}
    	if ($idperuser > 0 ) {
    		DB::table('permission_users')->where('id', $idperuser)->update(['permission_id' => $idpermis]);
    		return 1;
    	}
    }

    public function update(Request $request)
    {
    	$id = $request->aid;
    	$name = trim($request->aname);
		$objper = Permission::find($id);
    	$objper->name = $name;
    	$objper->update();
    	return $name;
    }



    public function destroy(Request $request)
    {
        $id = $request->aid;
    	// dd('chạy');
    	Permission::where('id',$id)->delete();

    	return "Xóa thành công";
    }
}
