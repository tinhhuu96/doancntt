<?php

namespace App\Http\Controllers\AdminController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Excel;
use PDF;
use App\transInput_order;
use App\Product;

class EcxelController extends Controller
{

    public function ExportAddOrder(Request $req)
    {
    	$date = $req->adate;
    	$export = DB::table('products')->join('traninput_orders','products.id','=','traninput_orders.id_product')->where('traninput_orders.created_at','like',''.$date.'%')->select('products.code','products.name','traninput_orders.quantity','traninput_orders.price','traninput_orders.total','traninput_orders.created_at')->get();
    	$pdf = PDF::loadView('pdf.export-order', ['items' => $export]);
   //  	Excel::create('Xuất đơn hàng đã nhập', function($excel) use ($export){
		 //    	$excel->sheet('Sheet 1', function($sheet) use ($export){
			// 		$sheet->fromArray($export);
			// 	});
			// })->download('xls');
    	return $pdf->stream('export-order.pdf');
	}

}
