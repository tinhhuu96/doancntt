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

        $array = TransInput_order::where('created_at','like',''.$date.'%')->get();
        $str = "";
        foreach ($array as $key => $value) {
            $str .= $value->id_product;
             $str .= '<tr>
                <td>'.$value->id.'</td>
                <td>'.$value->id_product.'</td>
                <td>'.$value->quantity.'</td>
                <td>'.$value->price.' vnđ</td>
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
