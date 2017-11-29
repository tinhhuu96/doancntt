<?php

namespace App\Http\Controllers\LayoutController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Product;

class SearchController extends Controller
{
    public function search_product(Request $req)
    {
    	$pricefirst = $req->price_first;
    	$pricelast = $req->price_last;
    	// dd($pricelast);
    	$product = DB::table('products')->where([
								    ['price', '>=', $pricefirst],['price', '=<', $pricelast]
                                ])->get();
    	dd($product);
    }
}
