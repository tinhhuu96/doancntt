@extends('templates.admin.template')
@section('content')
<?php 
  use App\Product;
  use App\Category;
  use App\Paracatedetail;
  use Illuminate\Support\Facades\DB;
  $idcate = Session::get('IDCate');
  $parameters = DB::table('paracatedetail')->join('parameters', 'paracatedetail.parameters_id','=','parameters.id')->join('categories','paracatedetail.categories_id','=','categories.id')->select('parameters.*')->where('paracatedetail.categories_id','=',$idcate)->get();
  $category = Category::all();
  $arProduct = Product::where('id','=',$id)->get();
  
  // dd($parameters);
?>
<div class="alert " id="alert-ajax">
    
</div>
<div class="row">
  <div class="col-xs-8">
    <h2 class="bg-success">
      Nhập thông số cho sản phẩm : {{ $arProduct[0]->name}}
    </h2>
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
<div class="row">
<div class="col-md-4">
  <div class="">
        <div class="box box-danger collapsed-box">
            <div class="box-header with-border">
                <h3 class="box-title">Add News Parameters</h3>
                <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                </button>
                </div>
                <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <form action="" method="">
                    <div class="form-group">
                        <label for="">Parameter Name</label>
                        <input type="text" name="name" id="name" value="" placeholder="nhập..." class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Chọn danh mục</label> <br>
                        <select id="parameters" name="category" class="form-control select2" style="width: 250px;">
                            @foreach( $category as $keys => $values )
                            <option value="{{ $values->id }}">{{ $values->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <input type="button" onclick="addPara()" value="Thêm Mới" class="btn btn-success">
                    </div>
                </form>
            </div>
        <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
</div>
<div class="col-md-8">
  <div class="panel-group" id="accordion">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
            <i class="fa fa-plus-square"></i> Thêm Mới Thông số kỹ thuật
          </a>
        </h4>
      </div>
      <div id="collapseOne" class="panel-collapse ">
        <div class="panel-body">
          <div class="form-group col-md-4">
              <div class="form-group">
                <label for="">Tên Thông Số</label><br>
                <select id="namePara" class="form-control select2" style="width:200px;">
                   @foreach( $parameters as $key => $value)
                      <option value="{{ $value->id }}">{{ $value->name }}</option>
                   @endforeach
                </select>
            </div>
          </div>
          <div class="form-group col-md-8">
            <label for="">Giá Trị Thông Số</label>
            <input type="text" id="valuePara" class="form-control" placeholder="">
          </div>
          </br>
          <div class="form-group">
            <input type="hidden" id="id_product" class="form-control" value="{{ $id }}">
            <input type="hidden" id="id_cate" class="form-control" value="{{ $idcate }}">
            <div>
              <a href="javascript:void(0)" onclick="addParaProduct()" class="btn btn-primary">Add Parameter</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
<div class="row">
  <div class="col-xs-offset-8 col-xs-3">
    <a href="{{ route('admin.listproduct') }}" class="btn btn-success">Hoàn Thành</a>
  </div>
</div>
@section('script')
  <script type="text/javascript">
    function addPara(){
            aname = $('#name').val();
            apara = $('#parameters').val();
            $.ajaxSetup({
                headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{route('admin.add.parameters')}}",
                type: 'post',
                data: {name: aname, para: apara},
                success: function(data){
                    $('#alert-ajax').html(data);
                },
                error: function (){
                    alert('Có lỗi xảy ra');
                }
            });
        }

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

            function getListPara(){
                setTimeout(function(){
                var idcate = $('#id_cate').val();
                    $.ajaxSetup({
                        headers: {
                          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                      });
                    $.ajax({
                        url: "{{route('admin.ajax.listPara')}}",
                        type: 'post',
                        data: {aid:idcate},
                        success: function(data){
                           $('#namePara').html(data);
                        },
                        complete: getListPara
                    });
                },10000);
            };
            getListPara();
        });

  </script>
@stop
@stop