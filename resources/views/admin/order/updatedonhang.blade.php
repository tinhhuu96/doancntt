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
            <div class="col-xs-offset-1 col-xs-10">
              <div class="form-group">
                <div class="input-group">
                  <input type="text" class="form-control" placeholder="search......">
                  <span class="input-group-btn">
                    <button class="btn btn-default" type="button">Go!</button>
                  </span>
                </div>
              </div>
            </div>
          </div>
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
                <label for=" ">Giá Nhập Vào</label>
                <input type="number" name="price_old" value="" class="form-control" id="" placeholder="{{ $arProduct->price_old }}">
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
                        <!-- <a class="removeimg" href="javascript:"></a> -->
                     </div>
                     <!-- <div id="boxchoice">
                        <a href="javascript:" class="Choicefile">Browser</a>
                        <p style="clear:both"></p>
                     </div>
                      <label class="filename"></label> -->
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
                  <button type="submit" onclick="" class="btn btn-primary">Xuất file Excels</button>
                </form>
              </h3>
            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            
            <input type="hidden" value="{{ $date }}" id="datetime">
            <table id="example2" class="table table-bordered table-hover">
              <thead>
              <tr>
                <th>Stt</th>
                <th>id_Code</th>
                <th>Số Lượng</th>
                <th>Giá nhập vào</th>
                <th>Giá bán ra </th>
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