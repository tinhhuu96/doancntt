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
        $name    = trim($request->name);
        $parent  = $request->parent;
        if ($name == "") {
            $request->session()->flash('msg-e','Nhập rỗng !');
            return redirect()->route('admin.category');
        }
        $name_olds = Category::select('name')->where('name','=',$name)->get();
        $name_old ="";
        foreach ($name_olds as $key => $value) {
            $name_old = $value->name;
        }

        if ($name_old != '') {
            $request->session()->flash('msg-e','Thêm thất bại, tên danh mục đã tồn tại');
            return redirect()->route('admin.category');
        }else{

            $arCate = Category::create(['name'=>$name, 'parent'=>$parent]);
        }
        if ($arCate) {
            $request->session()->flash('msg-s','Thêm thành công');
            return redirect()->route('admin.category');
        }else{
            $request->session()->flash('msg-e','Thêm thất bại');
            return redirect()->route('admin.category');
        }
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

    public function destroy(Request $request,$id)
    {

        $arcate = Category::find($id);
        if ($id == $arcate->id) {
            if (count(Category::where('parent','=',$id)->get()) > 0) {
                $idparent = Category::where('parent','=',$id)->get();
                dd($idparent[0]->id);
                    if (count( Paracatedetail::where('categories_id','=',$idparent[0]->id)->get()) > 0) {
                     Paracatedetail::where('categories_id','=',$idparent[0]->id)->delete();
                }

                if (count(Product::where('category_id','=',$idparent[0]->id)->get()) > 0) {
                    $idspparent = Product::select('id')->where('category_id','=',$idparent[0]->id)->get();
                    if (count(Paracatedetail::where('product_id','=',$idspparent[0]->id)->get()) > 0 ) {
                       Paracatedetail::where('product_id','=',$idspparent[0]->id)->delete();
                    }
                    Product::where('category_id','=',$idparent)->delete();
                }
                Category::where('parent','=',$id)->delete();
            }
            if (count( Paracatedetail::where('categories_id','=',$id)->get()) > 0) {
                 Paracatedetail::where('categories_id','=',$id)->delete();
            }

            if (count(Product::where('category_id','=',$id)->get()) > 0) {
                $idsp = Product::select('id')->where('category_id','=',$id)->get();
                if (count(Paracatedetail::where('product_id','=',$idsp[0]->id)->get()) > 0 ) {
                   Paracatedetail::where('product_id','=',$idsp[0]->id)->delete();
                }
                Product::where('category_id','=',$id)->delete();
            }

            $arcate->delete();
            $request->session()->flash('msg-s', 'Delete thành công');
            return redirect()->route('admin.category');
        }else{
            $request->session()->flash('msg-e','Delete thất bại');
            return redirect()->route('admin.category');
        }

    }
}
