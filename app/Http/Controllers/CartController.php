<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cart;
use User;
use Auth;
use Excel;
use PDF;
use App\Order;
use App\OrderDetail;
use DateTime;
use App\Product;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderShipped;
use Toastr;
class CartController extends Controller
{
	public function index(){
		// if (Auth::check())
		// {
		return view('layouts.cart.index');
		// }
		// return view('auth.login');
	}

    public function add($id, $price){
        $product = Product::find($id);
        Cart::add($product->id, $product->name, 1, $price, ['images' => $product->picture]);
        $count = Cart::count();
        return response(['count' => $count], 200);
    }

    public function delete($rowId)
    {
    	Cart::remove($rowId);
    	return redirect('/carts');
    }


    public function checkout()
    {
        $content = Cart::content();
        foreach ($content as $item) {
            $product = Product::findOrFail($item->id);
            if ($product->quantity < $item->qty){
                Toastr::warning("Not enough quantity. " . $product->name);
                return redirect('/carts');
            }
        }
        return view('layouts.cart.checkout');
    }

    public function store_order(Request $request)
    {
        if (Auth::check()) {
            $order = Order::create(['email' => $request->Input('email'),
                'address' => $request->Input('address_order'), 'phone' => $request->Input('phone'),
                'name' => $request->Input('name_receiver'), 'user_id' => Auth::user()->id]);
        }
        else{
             $order = Order::create(['email' => $request->Input('email'),
                'address' => $request->Input('address_order'), 'phone' => $request->Input('phone'),
                'name' => $request->Input('name_receiver')]);
        }
        if ($order) {
            $content = Cart::content();
            foreach ($content as $item) {
            OrderDetail::create(['product_id' => $item->id, 'quantity' => $item->qty, 'price' => $item->price, 'order_id' => $order->id]);
            $product = Product::find($item->id);
            if ($product->quantity < $item->qty){
                Toastr::success(" Cann't checkout, quanlity big! ");
                return redirect('/carts');}
            $product->quantity -= $item->qty;
            $product->save();
            }
            Cart::destroy();
            Mail::to($order)->send(new OrderShipped($order));
            Toastr::success("Checkout Completed, please check mail !");
            return redirect('/');
        }
        else
            Toastr::warning("error");
        return redirect('/carts/checkout');
    }

    public function manage()
    {
        // dd(auth::user()->id);
        $orders = Order::where('user_id', '=', auth::user()->id)->get();
        // dd($orders);
        return view('layouts.cart.manage')->with('orders', $orders);
    }

    public function cancel($id)
    {
        $order = Order::find($id);
        if ($order->status != 'pending' && $order->status != 'processing') {
            Toastr::warning("Can not cancel order !");
        }
        else{
            $order->update(['status' => 'delivered']);
            $items = $order->OrderDetails()->get();
            foreach ($items as $item) {
                $product = Product::find($item->product_id);
                $quantity = $product->quantity + $item->quantity;
                $product->update(['quantity' => $quantity]);
            }
            Toastr::success("Delivered Order " . $order->id);
        }
        return redirect('carts/manage');
    }

    public function detail($id)
    {
        $items = OrderDetail::where('order_id', '=', $id)->get();
        return view('layouts.cart.manage-detail')->with('items', $items);
    }

    public function down_count($rowId)
    {
        /*$product = Product::find($id);
        Cart::add($product->id, $product->name, 1, $product->cost, ['image' => 'this is link image']);
        $count = Cart::count();
        return response(['count' => $count], 200);*/
        $item = Cart::get($rowId);
        Cart::update($rowId, $item->qty - 1);
        return response(['qty' => $item->qty, 'subtotal' => $item->subtotal,
            'total' => Cart::total()], 200);
        // Cart::update($rowId, )
    }

    public function up_count($rowId)
    {
        $item = Cart::get($rowId);
        Cart::update($rowId, $item->qty + 1);
        return response(['qty' => $item->qty, 'subtotal' => $item->subtotal,
            'total' => Cart::total()], 200);
    }

    public function export_order()
    {
        $orders = Order::where('user_id', '=', auth::user()->id)->get();
        Excel::create('My Order', function($excel) use($orders) {
            $excel->sheet('Excel sheet', function($sheet) use($orders) {
                $sheet->fromArray($orders);
            });
        })->export('xls');
        return redirect('carts/manage');
    }

    public function export_order_detail($order)
    {
        $items = OrderDetail::where('order_id', '=', $order)->get();
        $pdf = PDF::loadView('pdf.order-detail', ['items' => $items]);
        return $pdf->stream('order-detail.pdf');
    }
}
