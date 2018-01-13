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
            $count = count(DB::table('products')->select(['products.*'])->where('products.name','like','%'.$req->txt.'%')->get());
            $product = DB::table('products')->select(['products.*'])->where('products.name','like','%'.$req->txt.'%')->paginate(10);
            return view('layout.search.index',['count'=>$count,'products'=>$product,'name'=>$req->txt]);
        }else{
            $pricefirst = $req->price_first;
            $pricelast = $req->price_last;
            if ($pricefirst == "") {
                $txt = ' rỗng';
                $count = count(DB::table('products')->select(['products.*'])->whereBetween('price', [$pricefirst, $pricelast])->get());
                $product = DB::table('products')->select(['products.*'])->whereBetween('price', [$pricefirst, $pricelast])->paginate(10);
                return view('layout.search.index',['count'=>$count,'products'=>$product,'name'=>$txt]);
            }
            $txt = ' từ '.number_format($pricefirst,0,'.','.').' đến '.number_format($pricelast,0,'.','.');
            $count = count(DB::table('products')->select(['products.*'])->whereBetween('price', [$pricefirst, $pricelast])->get());
            $product = DB::table('products')->select(['products.*'])->whereBetween('price', [$pricefirst, $pricelast])->paginate(10);
            return view('layout.search.index',['count'=>$count,'products'=>$product,'name'=>$txt]);
        }
    	
    }
}
