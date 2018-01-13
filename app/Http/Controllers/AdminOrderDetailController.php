<?php

namespace App\Http\Controllers;
use App\OrderDetail;
use Illuminate\Http\Request;

class AdminOrderDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $orderdetails = OrderDetail::where('order_id', '=', $id)->get();
        // dd($orderdetails);
        return view('auth.orderdetail.index')->with('orderdetails', $orderdetails);
    }
}
