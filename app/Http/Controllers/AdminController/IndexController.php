<?php

namespace App\Http\Controllers\AdminController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use App\Order;
use App\User;
use App\product;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $members = DB::table('users')->count();
        $orders = DB::table('orders')->count();
        $products = DB::table('products')->count();
        $shipped = DB::table('orders')->where('status', 'shipped')->count();
        $delivered = DB::table('orders')->where('status','delivered')->count();

        return view('admin.index',['members' => $members, 'orders' => $orders,
            'products' => $products, 'shipped' => $shipped, 'delivered' => $delivered]);
    }
}
