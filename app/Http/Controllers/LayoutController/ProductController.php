<?php

namespace App\Http\Controllers\LayoutController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Product;
use App\Category;
use App\Parameter_detail;
use App\Parameter;
use App\Comment;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::where('active','=',1)->orderby('id','DESC')->paginate(10);
        return view('layout.product.index',['products'=>$products]);
    }

    public function Product_Cate($slug, $id)
    {
        $arproducts = Product::where('category_id','=',$id)->paginate(10);
        $arname     = Category::where('id','=',$id)->select('name')->get();
        $name = $arname[0]->name;
        // dd($name);
        return view('layout.product.product',['name'=>$name,'products'=> $arproducts]);
    }

    public function product_detail($slug,$id)
    {
        $arproduct = Product::find($id);
        $arparameters = $arproduct->parameter_details;
        return view('layout.product.product_detail',['product'=>$arproduct, 'parameters'=>$arparameters]);
    }

    public function ajaxComment(Request $request)
    {
        $id_product = $request->aid_product;
        $id_user = $request->aid_user;
        $content = trim($request->acontent);
        if ($content != "") {
            $date = date('Y-m-d');
            $arcomment = array(
                        'product_id' => $id_product,
                        'user_id'    => 1,
                        'contents'   => $content,
                        'created_at' => $date
                    );

            Comment::insert($arcomment);

            return "Bình luận thành công !";
        }

        return "Dữ liệu nhập trống !";
    }

    public function ajaxGetComment(Request $request)
    {
        function ham_dao_nguoc_chuoi($str)
        {
            //tách mảng bằng dấu cách
            $arStr = explode(' ',$str);
            $arNgay = explode('-', $arStr[0]);
            return  $arStr[1].' '.$arNgay[2].'-'.$arNgay[1].'-'.$arNgay[0];
        }
        $id = $request->aid;
        $array = Comment::where('product_id','=',$id)->orderby('id','DESC')->get();
        // dd($array);
        $str ="";
        foreach ($array as $key => $value) {
            $str .= '<div class="form-group " >
                        <hr style="color: #bbb;">
                        <div class="row">
                            <div class="col-xs-1">
                                <img src="'.asset('images/logo/avata.png').'" alt="" style="width: 50px ; height: 50px;" />
                            </div>
                            <div class="col-xs-11">
                                <span>Time: '.ham_dao_nguoc_chuoi($value->created_at).'</span> <br/>
                                <span>'.$value->contents.'</span>
                            </div>
                        </div>

                    </div>';
        }
        return $str;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
