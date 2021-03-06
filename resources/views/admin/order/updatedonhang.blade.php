@extends('templates.admin.template')
@section('content')
<div class="row">
  <div class="col-xs-11">
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Nhập Đơn Hàng</h3>
      </div>
      <form action="{{ route('admin.upadte.inputorder') }}" role="form" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <input type="hidden" value="{{ Session::get('ID') }}" name="user_id">
        <div class="box-body">
          <div class="row">
            <div class="col-xs-4">
              <div class="form-group">
                <label for=" ">Mã Sản Phẩm</label>
                <input type="text" name="code" class="form-control" value="{{ $arProduct->code }}" placeholder="Enter code" readonly="">
              </div>
              <div class="form-group">
                <label for=" ">Tên Sản Phẩm</label>
                <input type="text" name="name" value="{{ $arProduct->name }}" class="form-control" placeholder="Enter name product" readonly="">
              </div>
            </div>
            <div class="col-xs-2">
              <div class="form-group">
                <label for=" ">Giá Bán</label>
                <input type="number" name="price" value="" class="form-control" id="" placeholder="<?php echo number_format($arProduct->price,0,'.','.') ?>">
              </div>
            </div>
            <div class="col-xs-2">
             <div class="form-group">
               <label for=" ">Số lượng</label>
                <input type="number" name="quantity" value="" class="form-control" id="" placeholder="{{ $arProduct->quantity }}">
             </div>
            </div>
            <div class="col-xs-2">
              <div class="form-group">
                  <label>avata sản phẩm</label> <br>
                    <div id="myfileupload">
                        <input type="file" name="avata" id="uploadfile" onchange="readURL(this);">
                    </div>
                    <div id="thumbbox">
                        <img height="100" class="thumbnail" src="{{ asset('storage/products/'.$arProduct->picture) }}" width="100" alt="Thumb image" id="thumbimage">
                     </div>
                </div>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-12">
              <div class="form-group">
                <label for=" ">Chi Tiết Sản Phẩm</label>
                <textarea name="detail" class="ckeditor form-control" rows="3">{{ $arProduct->detail }}</textarea>
              </div>
            </div>
          </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer text-right">
          <button type="submit" class="btn btn-primary">Nhập Đơn Hàng</button>
        </div>
      </form>
    </div>
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <div class="col-xs-5 text-left">
              <h3 class="box-title">Danh Sách Đơn Hàng Đã Nhập</h3>
            </div>
            <div class="col-xs-2 pull-right">
              <h3 class="box-title">
                <?php $date = date("Y-m-d"); ?>
                <form action="{{ route('admin.excel.addorder') }}" method="post">
                  {{ csrf_field() }}
                  <input type="hidden" value="{{ $date }}" name="date">
                  <button type="submit" class="btn btn-primary">Xuất file Excels</button>
                </form>
              </h3>
            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body">

            <input type="hidden" value="{{ $date }}" id="datetime">
            <table id="example2" class="table table-bordered table-hover text-center ">
              <thead>
              <tr">
                <th>Stt</th>
                <th>Sản phẩm</th>
                <th>Số Lượng</th>
                <th>Giá bán </th>
                <th>Tổng tiền</th>
              </tr>
              </thead>
              <tbody id="getValueInOrder">
              </tbody>
            </table>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
    <!-- /.col -->
  </div>
</div>
@stop
