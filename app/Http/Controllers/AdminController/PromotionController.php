<?php

namespace App\Http\Controllers\AdminController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use App\Calculation;
use App\Promotion;
use App\Promotion_product;
use Illuminate\Support\Facades\DB;
use Validator;
use Toastr;

class PromotionController extends Controller
{
    public function index()
    {
    	$arpromotions = DB::table('promotions')->join('calculations','promotions.calculation_id','=','calculations.id')->select(['calculations.name as namecalcu','promotions.*'])->get();
    	return view('admin.promotion.index',['arPromotion'=>$arpromotions]);
    }

    public function show($id)
    {
        $arpromotions = DB::table('promotions')->join('calculations','promotions.calculation_id','=','calculations.id')->select(['calculations.name as namecalcu','calculations.id as calculation_id','promotions.*'])->where('promotions.id',$id)->get();

        $promotions = DB::table('promo_products')->join('products','promo_products.product_id','=','products.id')->select('products.*')->where('promo_products.promotion_id',$id)->get();
        return view('admin.promotion.view',['arpromotions'=>$arpromotions, 'product_promotion'=>$promotions]);
    }

    public function create()
    {
    	return view('admin.promotion.create');
    }

    public function getproduct(Request $request)
    {
        $str = ""; 
        $ids = $request->aid;
        foreach ($ids as $key => $id) {
            $arProducts = Product::where('category_id',$id)->get();
        
            foreach ($arProducts as $key => $value) {
                $str.= '<tr>
                          <td><input type="checkbox" id="" class="check" name="checkall[]" value="'.$value->id.'"/></td>
                          <td>'.$value->code.'</td>
                          <td>'.$value->name.'</td>
                          <td>'.$value->price.'</td>
                          <td>'.$value->quantity.'</td>
                        </tr>';
            }
        }
        
        
    	if ($str == "") {
    		return '<tr>
				<td colspan="5">Không có sản phẩm</td>
    		</tr>';
    	}
    	return $str;
    }
    public function saveSp(Request $request)
    {
    	$str = "";
    	$ar = $request->aid;
    	if ($ar == "") {
    		return '<tr>
				<td colspan="5">Không có sản phẩm</td>
    		</tr>';
    	}
    	$arid = explode('-',$ar);
    	foreach ($arid as $key => $value) {
    		$arproduct = Product::where('id',$value)->get();
    		foreach ($arproduct as $keys => $values) {
    			$str .= '<tr>
	                      <td>'.$values->code.'<input type="hidden" name="saveproduct[]" value="'.$values->id.'" /></td>
	                      <td>'.$values->name.'</td>
	                      <td>'.$values->price.'</td>
	                      <td>'.$values->quantity.'</td>
	                    </tr>';
    		}
    	}
    	return $str;
    }

    public function store(Request $req)
    {
    	function date_formats($str)
        {
            $arNgay = explode('/', $str);
            return  $arNgay[2].'-'.$arNgay[0].'-'.$arNgay[1];
        }
    	$name = $req->name;
    	$radio_km = $req->radio_km;
    	$gt_pro = $req->gt_pro;
    	$dates = $req->date;
    	$radio_active = $req->radio_active;
    	$idproduct = $req->saveproduct;
    	$date = explode(' ',$dates);
    	$date_begin = date_formats($date[0]);
    	$date_end = date_formats($date[2]);

    	$arpromotion = Promotion::create(['name'=>$name,'value_km'=>$gt_pro,'date_begin'=>$date_begin,'date_end'=>$date_end,'active'=>$radio_active,'calculation_id'=>$radio_km]);
    	for ($i=0; $i < count($idproduct) ; $i++) { 
    		$id = $idproduct[$i];
    		Promotion_product::create(['product_id'=>$id,'promotion_id'=>$arpromotion->id]);
    	}
    	return redirect()->route('promotion.index');
    }

    public function edit($id)
    {
    	$arpromotions = DB::table('promotions')->join('calculations','promotions.calculation_id','=','calculations.id')->select(['calculations.name as namecalcu','calculations.id as calculation_id','promotions.*'])->where('promotions.id',$id)->get();

    	$promotions = DB::table('promo_products')->join('products','promo_products.product_id','=','products.id')->select('products.*')->where('promo_products.promotion_id',$id)->get();
    	// dd($promotions);
    	return view('admin.promotion.edit',['arpromotions'=>$arpromotions, 'product_promotion'=>$promotions]);
    }

    public function update(Request $request)
    {
    	function date_formats($str)
        {
            $arNgay = explode('/', $str);
            return  $arNgay[2].'-'.$arNgay[0].'-'.$arNgay[1];
        }
    	$inputs = $request->all();
        $rules = array(
            'name' 	=> 'required|min:5',
            'gt_pro'=> 'required',
            );
        $message = array(
            'required' => 'Xin mời nhập !',
            'min'      => 'Nhỏ nhất là 5 kí tự',
            );
        $validator = Validator::make($inputs, $rules, $message);
        if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput();
        }
        $id = $request->id;
        $arpromotion = Promotion::find($id);
    	$arpromotion->name = trim($request->name);
        $arpromotion->value_km = $request->gt_pro;
    	$arpromotion->calculation_id = $request->radio_km;
    	$dates = $request->date;
    	$date = explode(' ',$dates);
    	$arpromotion->date_begin = date_formats($date[0]);
    	$arpromotion->date_end = date_formats($date[2]);
    	$arpromotion->active   = $request->radio_active;

    	$idproduct = $request->saveproduct;
    	if ($idproduct != null) {
    		Promotion_product::where('promotion_id',$id)->delete();
    		for ($i=0; $i < count($idproduct) ; $i++) { 
	    		$idpro = $idproduct[$i];
	    		Promotion_product::create(['product_id'=>$idpro,'promotion_id'=>$id]);
	    	}
    	}
    	$arpromotion->update();
    	Toastr::success("update success !");
    	return redirect()->route('promotion.index');

    }

    public function destroy(Request $request)
    {
    	$id = $request->aid;
    	Promotion_product::where('promotion_id',$id)->delete();
    	Promotion::where('id',$id)->delete();
    	return "Xóa thành công !";
    }
}

