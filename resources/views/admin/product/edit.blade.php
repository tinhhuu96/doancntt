@extends('templates.admin.template')
@section('content')
<div class="row">
  <div class="col-xs-11">
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Edit Sản Phẩm</h3>
      </div>
      <!-- /.box-header -->
      <!-- form start -->
      <form action="{{ route('admin.update.product',['id'=>$product[0]->id]) }}" method="post" role="form" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="box-body">
          <div class="row">
            <div class="col-xs-6">
              <div class="form-group">
                <label>Hiện đang chọn danh mục</label>
                <select class="form-control select2" style="width: 100%;">
                  <?php $selected=""; ?>
                  @foreach( $categories as $key => $value )
                    @if( $value->id == $product[0]->idCate)
                      <?php $selected="selected" ?>
                      <option selected="{{ $selected }}" value="{{ $value->id }}">{{ $value->name }}</option>
                    @else
                      <option selected="{{ $selected }}" value="{{ $value->id }}">{{ $value->name }}</option>
                    @endif
                  @endforeach
                </select>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-4">
              <div class="form-group">
                <label for="">Mã Sản Phẩm</label>
                <input type="text" name="code" class="form-control" value="{{ $product[0]->code }}" id="" placeholder="code...">
              </div>
            </div>
            <div class="col-xs-4">
              <div class="form-group">
                <label for="">Tên Sản Phẩm</label>
                <input type="text" name="name" value="{{ $product[0]->name }}" class="form-control" id="" placeholder="Enter name product">
              </div>
            </div>
            <div class="col-xs-4">
              <div class="form-group">
                <label for="">Giá bán</label>
                <input type="number" name="price" value="{{ $product[0]->price }}" class="form-control" id="" placeholder="price">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-12">
              <div class="table table-bordered form-group bg-success">
                <div class="panel-heading">
                  <h4 class="panel-title">
                    <a>
                      <i class="fa fa-list"></i>Thông số kỹ thuật
                    </a>
                  </h4>
                </div>
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>Tên Thông số</th>
                      <th>Giá Trị</th>
                      <th>Chức năng</th>
                    </tr>
                  </thead>
                  <tbody id="demo">
                    <tr>
                      <td colspan="2">------ Trống</td>
                    </tr>
                  </tbody>
                  <tfoot>
                    
                  </tfoot>
                </table>
              </div>
            </div>
          </div>
          <div class="row col-xs-12">
            <div class="panel-group" id="accordion">
              <div class="panel panel-primary">
                <div class="panel-heading">
                  <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                      <i class="fa fa-plus-square"></i> Thêm Mới Thông số kỹ thuật
                    </a>
                  </h4>
                </div>
                <div id="collapseOne" class="panel-collapse collapse">
                  <div class="panel-body">
                    <div class="form-group col-xs-4">
                        <div class="form-group">
                          <label for="">Tên Thông Số</label><br>
                          <select id="namePara" class="form-control select2" style="width:300px;">
                              <option value="0">---Chọn---</option>
                              @foreach($parameters as $key => $value)
                              <option value="{{ $value->id }}">{{ $value->name}}</option>
                              @endforeach
                          </select>
                      </div>
                    </div>
                    <div class="form-group col-xs-8">
                      <label for="">Giá Trị Thông Số</label>
                      <input type="text" id="valuePara" class="form-control" placeholder="">
                    </div>
                    </br>
                    <div class="form-group">
                      <input type="hidden" id="id_product" class="form-control" value="{{ $product[0]->id }}">
                      <div>
                        <a href="javascript:void(0)" onclick="addParaProduct()" class="btn btn-primary">Add Parameter</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-12">
              <div class="form-group">
                <label for="">Chi Tiết Sản Phẩm</label>
                <textarea name="detail" class="ckeditor form-control" rows="3">{{ $product[0]->detail }}</textarea>
              </div>
            </div>
          </div>
          <div class="">
            <div class="col-xs-12">
              <div class="col-xs-6">
                <div class="form-group">
                  <label for="">Chọn Avatar</label>
                  <input type="file" name="avata" id="">
                  <p class="help-block">Chỉ được chọn 1 ảnh Avatar</p>
                </div>
              </div>
              <!-- <div class="col-xs-6">
                <div class="form-group">
                  <label for="exampleInputFile">Chọn Ảnh về sản phẩm</label>
                  <input type="file" id="exampleInputFile">
                  <p class="help-block">chọn nhiều Hình ảnh về sản phẩm</p>
                </div>
              </div> -->
            </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer text-left">
          <button type="submit" class="btn btn-primary">Update Product</button>
        </div>
      </form>
    </div>
  </div>
</div>
@section('script')
  <script type="text/javascript">
    
    function addParaProduct(){

        var idPara = $('#namePara').val();
        var id_product = $('#id_product').val();
        var namePara = $('#namePara option:selected').html();
        var nameContent = $('#valuePara').val();
        
        $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{route('admin.ajaxAddPara.product')}}",
            type: 'post',
            data: {aidpara: idPara,aidproduct: id_product, anamePara:namePara, anameContent: nameContent},
            success: function(data){
                alert(data);
            },
            error: function (){
                alert('Có lỗi xảy ra');
            }
        });
    }

    function destroy(id)
    {
        $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{route('admin.ajax.destroyparameter')}}",
            type: 'post',
            data: {aid: id},
            success: function(data){
                alert(data);
            },
            error: function (){
                alert('Có lỗi xảy ra');
            }
        });
    }

    $( document ).ready(function() {
            function getParaAddnew(){
                setTimeout(function(){
                var id_product = $('#id_product').val();
                    $.ajaxSetup({
                        headers: {
                          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                      });
                    $.ajax({
                        url: "{{route('admin.ajaxParaNewAdd')}}",
                        type: 'post',
                        data: {aid:id_product},
                        success: function(data){
                           $('#demo').html(data);
                        },
                        complete: getParaAddnew
                    });
                },200);
            };
            getParaAddnew();
        });

  </script>
@stop
@stop