<?php

namespace App\Http\Controllers\AdminController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Validator;
use App\Product;
use App\Category;
use App\Parameter;
use App\Paracatedetail;
use App\Parameter_detail;
use App\TransInput_order;

class OrdermanageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function NhapDH()
    {
        $categories = Category::where('parent','=',0)->get();
        return view('admin.order.nhapdonhang',['categories'=>$categories]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function AddOrderInput($slug,$id)
    {
        $arProduct = Product::find($id);
        // dd($arProduct);
        return view('admin.order.updatedonhang',['arProduct'=>$arProduct]);
    }

    public function inputUpdateorder(Request $request)
    {
        $code = trim($request->code);
        $price_old= trim($request->price_old);
        $price= trim($request->price);
        $quantity= trim($request->quantity);
        $detail= trim($request->detail);

        $arhash = Product::where('code','=',$code)->get();
        $priceN = $arhash[0]->price;
        $price_oldN = $arhash[0]->price_old;
        $quantityN = $arhash[0]->quantity;
        $detailN = $arhash[0]->detail;
        if ($price != "") {
            $priceN = $price;
        }
        if ($price_old != "") {
            $price_oldN = $price_old;
        }
       
        if ($quantity != "") {
            $quantityN = $quantity + $quantityN;
        }
        if ($detail != "") {
            $detailN = $detail;
        }
        
        Product::where('code','=',$code)->update(['price_old'=>$price_oldN, 'price'=>$priceN,'quantity'=>$quantityN, 'detail'=> $detailN]);

        $arNewProduct = Product::where('code','=',$code)->get();

        $total = $arNewProduct[0]->price_old*$quantityN;
        // dd($total);
        $created_at = date("Y-m-d");
        // dd($date);
        $array = array(
            'id_product' => $arNewProduct[0]->id,
            'quantity' => $arNewProduct[0]->quantity,
            'price_old' => $arNewProduct[0]->price_old,
            'price' => $arNewProduct[0]->price,
            'total' => $total,
            'created_at' => $created_at
        );
        // dd($array);
        TransInput_order::insert($array);

        $request->session()->flash('msg-s', 'Nhập thành công !');
        return redirect()->route('admin.listproduct');
    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id = $request->idcate;
        $code= trim($request->code);
        $name= trim($request->name);
        $price_old= trim($request->price_old);
        $price= trim($request->price);
        $quantity= trim($request->quantity);
        $detail= trim($request->detail);
        $avata = $request->avata;
        $date  = date('Y-m-d H:i:s');
        $inputs = $request->all();
        $rules = array(
            'name' => 'required|min:5',
            'code' => 'required|min:5',
            'detail' => 'required|min:5',
            'price_old' => 'required',
            'price' => 'required',
            'quantity' => 'required',
            );
        $message = array(
            'required' => 'Xin mời nhập !',
            'min'      => 'Nhỏ nhất là 5 kí tự',
            );
        $validator = Validator::make($inputs, $rules, $message);
        if ($validator->fails()) {
            return redirect()->route('admin.OrderIn')
                        ->withErrors($validator)
                        ->withInput();
        }
        $arhash = Product::where('code','=',$code)->get();
        
        if (count($arhash) > 0 ) {
            $request->session()->flash('msg-e', 'Sản phẩm tồn tại !');
            return redirect()->route('admin.OrderIn');
        }else{
            $endPic="";
            if ($avata != "") {
                $path = $request->file('avata')->store('public/products');
                $tmp  = explode('/',$path);
                $endPic = end($tmp);
            }
            $arProduct = array(
                'code' => $code ,
                'name' => $name,
                'detail' => $detail,
                'picture'  => $endPic,
                'price' => $price,
                'price_old' =>$price_old,
                'quantity' => $quantity,
                'active'   => 1,
                'category_id' => $id,
                'user_id' => $request->user_id,
                'view' => 1,
                'created_at' => $date,
                );
            // dd($arProduct);
            if(Product::insert($arProduct)){
                $arNewProduct = Product::where('code','=',$code)->get();
                // dd($arNewProduct[0]->id);
                $quantity = $arNewProduct[0]->quantity;
                $price = $arNewProduct[0]->price_old;
                $total = $price_old*$quantity;
                // dd($total);
                $created_at = date("Y-m-d");
                // dd($date);
                $array = array(
                    'id_product' => $arNewProduct[0]->id,
                    'quantity' => $arNewProduct[0]->quantity,
                    'price_old' => $arNewProduct[0]->price_old,
                    'price' => $arNewProduct[0]->price,
                    'total' => $total,
                    'created_at' => $created_at
                );
                // dd($array);
                TransInput_order::insert($array);
                $request->session()->flash('msg-s', 'Nhập thành công !');
                return redirect()->route('admin.OrderIn');
            }else{
                $request->session()->flash('msg-e', 'Nhập thất bại !');
                return redirect()->route('admin.OrderIn');
            }
        }
    }

    public function ajaxGetInOrder(Request $request)
    {
        $date = $request->adate;
        $array = TransInput_order::where('created_at','=',$date)->get();
        // dd($array);
        $str = "";
        foreach ($array as $key => $value) {
            $str .= $value->id_product;
             $str .= '<tr>
                <td>'.$value->id.'</td>
                <td>'.$value->id_product.'</td>
                <td>'.$value->quantity.'</td>
                <td>'.$value->price.' vnđ</td>
                <td>'.$value->price_old.' vnđ </td>
                <td class="text-right">'.$value->total.' vnđ</td>
              </tr>';
        }
        return $str;
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return view('admin.order.qlhoadon');
    }
    public function detaiOrder(){
        return view('admin.order.hoadondetail');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
