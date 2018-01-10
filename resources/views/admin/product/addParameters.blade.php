@extends('templates.admin.template')
@section('content')
<?php 
  use App\Product;
  use App\Category;
  use App\Paracatedetail;
  use Illuminate\Support\Facades\DB;
  $idcate = Session::get('IDCate');
  $parameters = DB::table('paracatedetails')->join('parameters', 'paracatedetails.parameter_id','=','parameters.id')->join('categories','paracatedetails.category_id','=','categories.id')->select('parameters.*')->where('paracatedetails.category_id','=',$idcate)->get();
  $category = Category::where('id',$idcate)->get();
  $arProduct = Product::where('id','=',$id)->get();
  
  // dd($parameters);
?>
<div class="container" style="background: #fff;">
  <div class="row">
  <div class="col-xs-12">
    <h2 class="label-success">
      Nhập thông số cho sản phẩm : {{ $arProduct[0]->name}}
    </h2>
  </div>
</div>
<div class="row">
  <div class="col-xs-6">
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
                <h3 class="box-title">add new parameter {{$category[0]->name}}</h3>
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
                            <option value="{{ $category[0]->id }}">{{ $category[0]->name }}</option>
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
          <form action="{{route('admin.ajaxAddPara.product')}}" method="post" accept-charset="utf-8" name="abc">
            {{ csrf_field()}}
            <div  id="setParameters">
              @foreach( $parameters as $key => $value)
              <div class="row">
                <div class="col-xs-12">
                  <div class="col-xs-3">
                    <label for="" class="form-control">{{ $value->name }}</label>
                  </div>
                  <div class="col-xs-6">
                    <input type="hidden" id="namePara" name="idpara[]" value="{{ $value->id }}">
                    <input type="text" name="content[]" value="" id="valuePara" placeholder="nhập giá trị..." class="form-control">
                  </div>
                </div>
              </div>
            @endforeach
            </div>
            
            </br>
            <div class="form-group">
              <input type="hidden" name="id_product" id="id_product" class="form-control" value="{{ $id }}">
              <input type="hidden" name="id_cate" id="id_cate" class="form-control" value="{{ $idcate }}">
              <div>
                <!-- <a href="javascript:void(0)" onclick="addParaProduct()" class="btn btn-primary">Add Parameter</a> -->
                <input type="submit" name="" value="Add" class="btn btn-success">
              </div>
            </div>
          </form>
          
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
</div>

@section('script')
  <script type="text/javascript">
    function getListPara(name){
      var idcate = $('#id_cate').val();
      $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
      $.ajax({
          url: "{{route('admin.ajax.listPara')}}",
          type: 'post',
          data: {aid:idcate, aname:name},
          success: function(data){
             $('#setParameters').append(data);
          },
          complete: getListPara
      });
    };

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
                    $('#name').val("");
                    $('#alertprovider-s').html(data.txt);
                    $('#mes-provider-s').css({display:'block', transition:'0.3 all'});
                    setTimeout(function(){ $('#mes-provider-s').fadeOut() }, 1000);
                    if (data.so == 0) {
                      getListPara(aname);
                    }
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
                $('#alertprovider-s').html(data);
                $('#mes-provider-s').css({display:'block', transition:'0.3 all'});
                setTimeout(function(){ $('#mes-provider-s').fadeOut() }, 1000);
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
              $('#alertprovider-e').html(data);
              $('#mes-provider-e').css({display:'block', transition:'0.3 all'});
              setTimeout(function(){ $('#mes-provider-e').fadeOut() }, 1000);
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