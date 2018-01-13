<?php

namespace App\Http\Controllers;
use App\Order;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Excel;
use Illuminate\Support\Facades\Mail;
use App\Mail\ChangeStatusOrder;

class AdminOrderController extends Controller
{
    public function index()
    {
        $orders = Order::all();
        return view('auth.order.index')->with('orders', $orders);

    }

    public function edit($id)
    {
        $order = Order::find($id);
        return view('auth.order.edit')->with('order', $order);
    }

    public function update(Request $request, $id)
    {
        $order = Order::find($id);
        $status = $order->status;
        $order->update(['address' => $request->Input('address'), 'phone' => $request->Input('phone'), 'name' => $request->Input('name'), 'status' => $request->Input('status')]);
        if ($status != $order->status) {
            Mail::to($order)->send(new ChangeStatusOrder($order));
        }

        return redirect('adminpc/orders');
    }

    public function search(Request $request)
    {
        $date_start = $request->Input('date_start');
        $date_end = $request->Input('date_end');
        $status = $request->Input('status');
        $orders = Order::status($status)->datefrom($date_start)->dateto($date_end)->get();
        return view('auth.order.index')->with(['orders' => $orders, 'date_start' => $date_start, 'date_end' => $date_end, 'status' => $status]);
    }

    public function export_order(Request $request)
    {
        $date_start = $request->Input('date_start');
        $date_end = $request->Input('date_end');
        $status = $request->Input('status');
        $orders = Order::status($status)->datefrom($date_start)->dateto($date_end)->get();
        Excel::create('Orders Excel', function($excel) use($orders) {
            $excel->sheet('Excel sheet', function($sheet) use($orders) {
                $sheet->fromArray($orders);
            });
        })->export('xls');
        return redirect('admin/orders');
    }

    public function export_order_summary(Request $request)
    {
        $date_start = $request->Input('date_start');
        $date_end = $request->Input('date_end');
        $orders = Order::datefrom($date_start)->dateto($date_end)->where('status', 'shipped')->get();
        Excel::create('Orders Excel', function($excel) use($orders) {
            $excel->sheet('Excel sheet', function($sheet) use($orders) {
                $sheet->fromArray($orders);
            });
        })->export('xls');
        return redirect('admin/orders');
    }

    public function report()
    {
        $orders = Order::where('status', 'shipped')->get();
        return view('auth.order.report')->with('orders', $orders);

    }
    public function report_search (Request $request)
    {
        $date_start = $request->Input('date_start');
        $date_end = $request->Input('date_end');
        $orders = Order::datefrom($date_start)->dateto($date_end)->where('status', 'shipped')->get();
        return view('auth.order.report')->with(['orders' => $orders, 'date_start' => $date_start, 'date_end' => $date_end]);
    }

    public function total_summary($id)
    {
        return $id;
    }
}
