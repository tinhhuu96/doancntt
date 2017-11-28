<?php

namespace App\Http\Controllers\AdminController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Comment;
use App\Product;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $arComment = DB::table('comments')->join('products','comments.product_id','=','products.id')->select('comments.*', 'products.name','products.picture')->paginate(10);
        // dd($arComment);
        return view('admin.comment.index',['comments'=>$arComment]);
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
    public function Ajaxdestroy(Request $request)
    {
        $id = $request->aid;
        DB::table('comments')->where('id', '=', $id)->delete();
        return $id;
    }

    public function destroy(Request $request)
    {
        $listComment = $request->checkall;
        if ($listComment == null) {
            $request->session()->flash('msg-e','Mời chọn để xóa !');
            return redirect()->route('admin.comment');
        }
        // dd($listComment);
        for ($i=0; $i < count($listComment); $i++) { 
            DB::table('comments')->where('id', '=', $listComment[$i])->delete();
        }
        $request->session()->flash('msg-s','Xóa thành công');
        return redirect()->route('admin.comment');
    }
}
