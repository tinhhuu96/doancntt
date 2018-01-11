<?php

namespace App\Http\Controllers\AdminController;

use Illuminate\Http\Request;
use App\Http\Requests\cateRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Validator;
use App\Product;
use App\Category;
use App\Parameter;
use App\Paracatedetail;
use App\Parameter_detail;


class CateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $arCate = Category::all();
        $categories = Category::orderby('id','DESC')->paginate(10);
        return view('admin.category.index', ['arcate'=>$arCate, 'categories'=>$categories]);
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
    public function store(cateRequest $request)
    {

        $arCate = Category::create(['name'=>trim($request->name), 'parent'=>$request->parent]);
            if ($arCate) {
                $request->session()->flash('msg-s','Thêm thành công');
            }else{
                $request->session()->flash('msg-e','Thêm thất bại');
            }
        return redirect()->route('admin.category');
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
    public function edit($slug,$id)
    {
        $arcate = Category::find($id);
        $category = Category::all();
        // dd($arcate);
        return view('admin.category.edit', ['arcate'=>$arcate,'category'=>$category]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$slug,$id)
    {
        $idcat = $request->id;
        $arcate = Category::find($id);
        if ($idcat == $id) {
            $arcate->name   = $request->name;
            $arcate->parent   = $request->parent;
            $arcate->update();
            $request->session()->flash('msg-s', 'Update thành công');
            return redirect()->route('admin.category');
        }else{
            $request->session()->flash('msg-e','Update thất bại');
            return redirect()->route('admin.category');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //-------------------------------------------------
    public function ajaxdestroy(Request $request)
    {
        $id = $request->aid;
        if (count(Category::where('parent','=',$id)->get() ) > 0 ) {
            $arParent = Category::where('parent','=',$id)->get();
            foreach ($arParent as $value) {

                if(count( Product::where('category_id','=',$value->id)->get() ) > 0 ) {
                    $product = Product::where('category_id','=',$value->id)->get();
                    foreach ($product as $value_product) {
                        if (count(Parameter_detail::where('product_id','=',$value_product->id)->get() ) > 0 ) {
                            $parameters = Parameter_detail::where('product_id','=',$value_product->id)->get();

                            foreach ($parameters as $value_para) {
                                Parameter_detail::where('id','=',$value_para->id)->delete();
                            }
                        }

                    }
                    $product->delete();
                }
                if (count(Paracatedetail::where('category_id','=', $value->id)->get() ) > 0 ) {
                    $paracates = Paracatedetail::where('category_id','=', $value->id)->get();
                    foreach ($paracates as $value_paracate) {
                        Paracatedetail::where('category_id','=',$value_paracate->category_id)->delete();
                    }
                }

                Category::where('id','=',$value->id)->delete();
            }

            Category::where('parent','=',$id)->delete();
            if(count( Product::where('category_id','=',$id)->get() ) > 0 ) {
                    $products = Product::where('category_id','=',$id)->get();
                    foreach($products as $value_product) {
                        if (count(Parameter_detail::where('product_id','=',$value_product->id)->get() ) > 0 ) {
                            $parameters = Parameter_detail::where('product_id','=',$value_product->id)->get();
                            foreach ($parameters as $value_para) {
                                Parameter_detail::where('product_id','=',$value_product->id)->delete();
                            }
                        }
                        Product::where('id',$value_product->id)->delete();
                    }
                }
                if (count(Paracatedetail::where('category_id','=', $id)->get() ) > 0 ) {
                    $paracates = Paracatedetail::where('category_id','=', $id)->delete();
                }
            Category::where('id','=',$id)->delete();
            return  "Xóa Thành Công ";
        }else{
            if (count( Product::where('category_id','=',$id)->get()) > 0 ) {
                $product = Product::where('category_id','=',$id)->get();
                foreach ($product as $value_product) {
                    if (count(Parameter_detail::where('product_id','=',$value_product->id)->get() ) > 0 ) {
                        $parameters = Parameter_detail::where('product_id','=',$value_product->id)->get();

                        foreach ($parameters as $value_para) {
                            Parameter_detail::where('product_id','=',$value_product->id)->delete();
                        }
                    }
                    Product::where('id','=',$value_product->id)->delete();
                }

            }
            if (count(Paracatedetail::where('category_id','=', $id)->get() ) > 0 ) {
                $paracates = Paracatedetail::where('category_id','=', $id)->get();
                foreach ($paracates as $value_paracate) {
                    Paracatedetail::where('category_id','=',$value_paracate->category_id)->delete();
                }
            }
            Category::where('id','=',$id)->delete();
            return "Xóa Thành công ";
        }

    }
}
