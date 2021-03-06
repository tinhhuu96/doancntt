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
use App\Promotion_product;
use App\Promotion;
use Carbon\Carbon;
use App\User;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products =  Product::where('active',1)->where('price','>',0)->paginate(12);
        return view('layout.product.index',['products'=>$products]);
    }

    public function Product_Cate($slug, $id)
    {
        $arproducts = Product::where([['category_id','=',$id],['active','=',1],['price','>',0]])->paginate(10);
        $arname     = Category::where('id','=',$id)->select('name')->get();
        $name = $arname[0]->name;
        // dd($name);
        return view('layout.product.product',['name'=>$name,'products'=> $arproducts]);
    }

    public function product_detail($slug,$id)
    {
        $arproduct = Product::find($id);
        $arparameters = $arproduct->parameter_details;
        $arcategory = $arproduct->Category;
        $arproducts = Product::where('category_id','=',$arcategory->id)->where('id','<>',$id)->get();
        // dd($arproducts);
        return view('layout.product.product_detail',['products'=>$arproducts,'product'=>$arproduct, 'parameters'=>$arparameters]);
    }

    public function ajaxComment(Request $request)
    {
        $id_product = $request->aid_product;
        $id_user = $request->aid_user;
        $content = trim($request->acontent);
        if ($content != "") {
            Comment::create(['product_id'=>$id_product, 'user_id'=>$id_user, 'contents'=> $content]);
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
            $time = Carbon::parse($value->created_at)->diffForHumans();
            $arimg = User::where('id',$value->user_id)->get();
            if ($arimg[0]->picture == "") {
                $img = 'avata.png';
            }else{
                $img   = $arimg[0]->picture;
            }
            $str .= '<div class="form-group " >
                        <hr style="color: #bbb;">
                        <div class="row">
                            <div class="col-xs-1">
                                <img src="'.asset('storage/admins/'.$img).'" class="thumbnail" alt="" style="width: 50px ; height: 50px;" />
                            </div>
                            <div class="col-xs-11">
                                <span>Time: '.$time.'</span> <br/>
                                <span>'.$value->contents.'</span>
                            </div>
                        </div>

                    </div>';
        }
        return $str;
    }


    public function disablePromotion(Request $request)
    {
        $adate = $request->date;
        $arpromotion = Promotion::all();
        foreach ($arpromotion as $key => $value) {            
            Promotion::where('date_end','<', $adate)->update(['active'=>0]);
        }
        return 200;
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
