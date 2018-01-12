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
        return view('admin.order.updatedonhang',['arProduct'=>$arProduct]);
    }

    public function inputUpdateorder(Request $request)
    {
        $code = trim($request->code);
        $price= trim($request->price);
        $quantity= trim($request->quantity);
        $detail= trim($request->detail);

        $arhash = Product::where('code','=',$code)->get();
        $priceN = $arhash[0]->price;
        $quantityN = $arhash[0]->quantity;
        $detailN = $arhash[0]->detail;
        if ($price != "") {
            $priceN = $price;
        }

        if ($quantity != "") {
            $quantityN = $quantity + $quantityN;
        }
        if ($detail != "") {
            $detailN = $detail;
        }

        Product::where('code','=',$code)->update(['price'=>$priceN,'quantity'=>$quantityN, 'detail'=> $detailN]);

        $arNewProduct = Product::where('code','=',$code)->get();

        $total = $arNewProduct[0]->price*$quantityN;
        // dd($total);
        TransInput_order::create(['id_product'=> $arNewProduct[0]->id, 'quantity'=>$arNewProduct[0]->quantity, 'price'=>$arNewProduct[0]->price, 'total'=> $total ]);

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
        $price= trim($request->price);
        $quantity= trim($request->quantity);
        $detail= trim($request->detail);
        $avata = $request->avata;
        $inputs = $request->all();
        $rules = array(
            'name' => 'required|min:5',
            'code' => 'required|min:5',
            'detail' => 'required|min:5',
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
            $arProduct = Product::create(['code'=>$code, 'name'=>$name, 'detail'=>$detail,'picture'=>$endPic,'price'=>0,'quantity'=>0,'active'=>$request->display, 'category_id'=>$id,'provider_id'=>1,'view'=>1]);

            if($arProduct){
                $arNewProduct = Product::where('code','=',$code)->get();
                // dd($arNewProduct[0]->id);
                $quantity = $arNewProduct[0]->quantity;
                $price = $arNewProduct[0]->price;
                $total = $price*$quantity;

                TransInput_order::create(['id_product'=> $arNewProduct[0]->id, 'quantity'=>$arNewProduct[0]->quantity, 'price'=>$arNewProduct[0]->price, 'total'=> $total ]);

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
        $array = DB::table('products')->join('traninput_orders','products.id','=','traninput_orders.id_product')->where('traninput_orders.created_at','like',''.$date.'%')->get();
        $str = "";
        foreach ($array as $key => $value) {
            $str .= $value->id_product;
             $str .= '<tr>
                <td>'.$value->id.'</td>
                <td>'.$value->name.'</td>
                <td>'.$value->quantity.'</td>
                <td>'.number_format($value->price,0,'.','.').' vnđ</td>
                <td class="text-right">'.number_format($value->total,0,'.','.').' vnđ</td>
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

    public function ajaxsearch(Request $request)
    {
        $name = $request->aname;
        $products = Product::where('name','like','%'.$name.'%')->get();
        $str ="";
        if ($name != "") {
            if (count(Product::where('name','like','%'.$name.'%')->get()) > 0) {
                foreach ($products as $key => $value) {
                    $str .= '<div class="col-xs-12" style="background: white; border-bottom: solid 1px #bbb;">
                                <a href="'.route('admin.Order.inputUpdate',['slug'=>str_slug($value->name), 'id'=> $value->id ]).'" >
                                    <div class="col-xs-1">
                                        <img class="thumbnail" src="'.asset('storage/products/'.$value->picture).'" alt="'.$value->name.'" style="width:50px; height:50px;">
                                    </div>
                                    <div class="col-xs-11">
                                        <i>'.$value->name.'</i>
                                        <p> số lượng: '.$value->quantity.'</p>
                                    </div>
                                    </a>
                            </div>';
                }
                return $str;
            }else{
                return $str .= "không tìm thấy !";
            }

        }else{
            return 0;
        }
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
