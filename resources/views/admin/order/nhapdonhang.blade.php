@extends('templates.admin.template')
@section('content')
<div class="row">
  <div class="col-xs-11">
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Nhập Đơn Hàng</h3>
      </div>
      <!-- /.box-header -->
      <!-- form start -->
      <br>
      <style>
        .search{
          position: absolute;
          z-index: 9;
          top: 40px;
          width: 100%;height: 200px;
          background: #bbb;
          border: solid 1px #bbb;
          transition: all 0.3s;
          display: none;
          overflow-y: scroll;
        }
      </style>
      <div class="row">
          <div class="col-xs-offset-1 col-xs-10">
            <div class="form-group">
              <div class="form-group" style="position: relative;">
                <input type="text" id="txtSearch" class="form-control" placeholder="search......">
                <div class="search">
                </div>
              </div>
            </div>
          </div>
        </div>
      <form action="{{ route('admin.inputOrder') }}" role="form" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <input type="hidden" value="{{ Session::get('ID') }}" name="user_id">
        <div class="box-body">

          <div class="row">
            <div class="col-xs-6">
              <div class="form-group">
                <label>Chọn Danh mục sản phẩm</label>
                <select name="idcate" class="form-control select2 disable" style="width: 100%;">
                  <option value="0">--- mời chọn ---</option>
                  @foreach( $categories as $key => $value)
                    <option value="{{ $value->id }}">{{ $value->name }}</option>
                  @endforeach
                </select>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-4">
              <div class="form-group">
                <label for=" ">Mã Sản Phẩm</label>
                <input type="text" name="code" class="form-control" placeholder="Enter code">
              </div>
              <div class="form-group">
                <label for=" ">Tên Sản Phẩm</label>
                <input type="text" name="name" class="form-control" placeholder="Enter name product">
              </div>
            </div>
            <div class="col-xs-3">
              <div class="form-group">
                <label for=" ">Giá Nhập Vào</label>
                <input type="number" name="price" class="form-control" id="" placeholder="">
              </div>
            </div>
            <div class="col-xs-2">
             <div class="form-group">
               <label for=" ">Số lượng</label>
                <input type="number" name="quantity" class="form-control" id="" placeholder="">
             </div>
             <div class="form-group">
               <label for=" ">Hiển thị sản phẩm</label>
                <select name="display" id="" class="form-control">
                  <option value="1">có</option>
                  <option value="0">không</option>
                </select>
             </div>
            </div>

            <div class="col-xs-2">
              <div class="form-group">
                  <label>Chọn avata sản phẩm</label> <br>
                    <div id="myfileupload">
                        <input type="file" name="avata" id="uploadfile" onchange="readURL(this);">
                    </div>
                    <div id="thumbbox">
                        <img height="100" class="thumbnail" src="{{ asset('images/logo/avata.png') }}" width="100" alt="Thumb image" id="thumbimage">
                        <a class="removeimg" href="javascript:"></a>
                     </div>
                     <div id="boxchoice">
                        <a href="javascript:" class="Choicefile">Browser</a>
                        <p style="clear:both"></p>
                     </div>
                      <label class="filename"></label>
                </div>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-12">
              <div class="form-group">
                <label for=" ">Chi Tiết Sản Phẩm</label>
                <textarea name="detail" class="ckeditor form-control" rows="3"></textarea>
              </div>
            </div>
          </div>
          <div class="">
            <div class="col-xs-12">
              <div class="col-xs-6">

              </div>
            </div>
          <div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer text-right">
          <button type="submit" class="btn btn-success">Nhập Đơn Hàng</button>
        </div>
      </form>
    </div>
  </div>
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
            <table id="example2" class="table table-bordered table-hover text-center">
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
@section('jquery')
  <script type="text/javascript">

    $(function(){

      $('#txtSearch').on('keyup', function(){
          var name = $(this).val();
            $.ajaxSetup({
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
            });
            $.ajax({
              url: "{{route('admin.ajaxsearch')}}",
              type: 'post',
              data: {aname: name},
              success: function(data){
                if (data == 0 ) {
                  $('.search').css({display:'none', transition:'0.3s all'});
                }else{
                  $('.search').html(data);
                  $('.search').css({display:'block', transition:'0.3s all'});
                }

              },
              error: function (){

              }
            });
      });



    })

  </script>
@stop
@stop
