<?php

namespace App\Http\Controllers\LayoutController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Product;
use App\Promotion_product;
use App\Promotion;

class SearchController extends Controller
{
    public function search_product(Request $req)
    {
        if ($req->txt != "") {
            $count = count(DB::table('promo_products')->join('promotions','promo_products.promotion_id','=','promotions.id')->join('products','products.id','=','promo_products.product_id')->select(['products.*','promotions.value_km'])->where('products.name','like','%'.$req->txt.'%')->get());
            $product = DB::table('promo_products')->join('promotions','promo_products.promotion_id','=','promotions.id')->join('products','products.id','=','promo_products.product_id')->select(['products.*','promotions.value_km'])->where('products.name','like','%'.$req->txt.'%')->paginate(10);
            // dd($product);
            return view('layout.search.index',['count'=>$count,'products'=>$product,'name'=>$req->txt]);
        }else{
            $pricefirst = $req->price_first;
            $pricelast = $req->price_last;
            if ($pricefirst == "") {
                $txt = ' rỗng';
                $count = count(DB::table('promo_products')->join('promotions','promo_products.promotion_id','=','promotions.id')->join('products','products.id','=','promo_products.product_id')->select(['products.*','promotions.value_km'])->whereBetween('price', [$pricefirst, $pricelast])->get());
                $product = DB::table('promo_products')->join('promotions','promo_products.promotion_id','=','promotions.id')->join('products','products.id','=','promo_products.product_id')->select(['products.*','promotions.value_km'])->whereBetween('price', [$pricefirst, $pricelast])->paginate(10);
                return view('layout.search.index',['count'=>$count,'products'=>$product,'name'=>$txt]);
            }
            $txt = ' từ '.$pricefirst.' đến '.$pricelast;
            $count = count(DB::table('promo_products')->join('promotions','promo_products.promotion_id','=','promotions.id')->join('products','products.id','=','promo_products.product_id')->select(['products.*','promotions.value_km'])->whereBetween('price', [$pricefirst, $pricelast])->get());
            $product = DB::table('promo_products')->join('promotions','promo_products.promotion_id','=','promotions.id')->join('products','products.id','=','promo_products.product_id')->select(['products.*','promotions.value_km'])->whereBetween('price', [$pricefirst, $pricelast])->paginate(10);
            return view('layout.search.index',['count'=>$count,'products'=>$product,'name'=>$txt]);
        }
    	
    }
}
