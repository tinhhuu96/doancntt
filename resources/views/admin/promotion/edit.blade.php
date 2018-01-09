@extends('templates.admin.template')
@section('content')
<?php 
  use App\Category;
  use App\Calculation;
  $arcalcu    = Calculation::all();
  $arcategory = Category::all();
?>

<div class="row">
  <div id="model-promotion" class="modal bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xs">
      <div class="modal-content alert" role="alert">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Chọn sản phẩm khuyến mãi</h5>
        </div>
        <div id="" class="modal-body">
          <div class="row">
            <div class="col-xs-12">
              <div class="form-group">
                <label for="">Chọn khuyến mãi</label>
                <select id="idCategories" class="select2 form-control" multiple="multiple" data-placeholder="Select a State" style="width: 200px;" onchange="changeSp()">
                  <option>--Chọn danh mục</option>
                  @foreach( $arcategory as $value)
                  <option value="{{ $value->id }}">{{ $value->name }}</option>
                  @endforeach
                </select>
              </div>
            </div>
          </div>
          <div class="row">
            <table class="table table-bordered">
              <caption>chọn sản phẩm</caption>
              <thead>
                <tr>
                  <th><input type="checkbox" class="" id="check_all" /></th>
                  <th>Mã Sp</th>
                  <th>Tên sản phẩm</th>
                  <th>Giá bán</th>
                  <th>Số lượng</th>
                </tr>
              </thead>
              <tbody class="setvalueproduct">
                <tr>
                  <td colspan="5">Chưa có sản phẩm</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-success pull-left" onclick="saveProduct()" >Hoàn thành</button>
          <button class="btn btn-danger pull-right" onclick="exit()" >Cancel</button>
        </div>
      </div>
    </div>
  </div>
</div>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="row">
  <div class="col-xs-11">
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Chỉnh sửa Khuyến Mãi</h3>
      </div>
      <!-- /.box-header -->
      <!-- form start -->
      <form role="form" action="{{ route('promotion.update') }}" method="post">
        {{ csrf_field() }}
        <input type="hidden" name="id" value="{{ $arpromotions[0]->id }}">
        <div class="box-body">
          <div class="row">
            <div class="col-xs-12">
              <div class="col-xs-2">
                <label for="">Tên chương trình</label>
              </div>
              <div class="col-xs-5">
                <input type="text" name="name" value="{{ $arpromotions[0]->name }}" placeholder="nhập tên khuyến mãi..." class="form-control">    <br>
                <?php $c = "checked"; ?>
                @foreach($arcalcu as $valuecacul)
                  @if( $valuecacul->id == $arpromotions[0]->calculation_id)
                    <input type="radio" name="radio_km" class="flat-red" {{$c}} value="{{ $valuecacul->id}}">{{ $valuecacul->name }} &nbsp&nbsp
                  @else
                    <input type="radio" name="radio_km" class="flat-red" value="{{ $valuecacul->id}}">{{ $valuecacul->name }} &nbsp&nbsp
                  @endif
                @endforeach
              </div>
            </div>
          </div>
          <br>
          <div class="row">
            <div class="col-xs-12">
              <div class="col-xs-2">
                <label for="">Giá trị</label>
              </div>
              <div class="col-xs-5">
                <input type="number" name="gt_pro" value="{{ $arpromotions[0]->value_km }}" placeholder="nhập % or $..." class="form-control">
              </div>
            </div>
          </div>
          <br>
          <div class="row">
            <div class="col-xs-12">
              <div class="col-xs-2">
                <label for="">Chọn ngày</label>
              </div>
              <div class="col-xs-5">
                <div>
                  Ngày bắt đầu: {{ $arpromotions[0]->date_begin }} <br>
                  Ngày hết hạn: {{ $arpromotions[0]->date_end }}
                </div>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right" name="date" id="reservation">
                </div>
              </div>
            </div>
          </div>
          <br>
          <div class="row">
            <div class="col-xs-12">
              <div class="col-xs-2">
                <label for="">Hiệu lực</label>
              </div>
              <div class="col-xs-5">
                @if( $arpromotions[0]->active == 1)
                <input type="radio" name="radio_active" checked class="flat-red" value="1"> Có &nbsp&nbsp
                <input type="radio" name="radio_active" class="flat-red" value="2"> Không
                @else
                <input type="radio" name="radio_active" class="flat-red" value="1"> Có &nbsp&nbsp
                <input type="radio" name="radio_active" class="flat-red" checked value="2"> Không
                @endif
              </div>
            </div>
          </div>
          <br>
          <div class="row">
            <div class="col-xs-12">
              <div class="row">
                <div class="col-xs-2">
                
                </div>
                <div class="col-xs-10">
                  <a onclick="addProduct()" class="btn btn-primary"><i class="fa fa-plus-square" aria-hidden="true"></i>Chọn sản phẩm</a>
                </div>
              </div>
              <div class="row">
                <div class="col-xs-12">
                  <table class="table tabel-bordered">
                  <caption>Sản phẩm đang được khuyến mãi</caption>
                  <thead>
                    <tr>
                      <th>Code</th>
                      <th>Tên sản phẩm</th>
                      <th>Giá bán</th>
                      <th>Số lượng</th>
                    </tr>
                  </thead>
                  <tbody id="setproductpromotion">
                    @foreach( $product_promotion as $valuePro )
                      <tr>
                        <td>{{ $valuePro->code }}</td>
                        <td>{{ $valuePro->name }}</td>
                        <td>{{ $valuePro->price }}</td>
                        <td>{{ $valuePro->quantity }}</td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          <div class="row">
            <div class="col-xs-12">
              <div class="col-xs-9">
                &nbsp
              </div>
              <div class="col-xs-1">
                <button type="submit" class="btn btn-primary ">Update</button>
              </div>
              <div class="col-xs-2">
                <a href="{{ route('promotion.index') }}" class="btn btn-danger pull-right">Cancel</a>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<script type="text/javascript">
  function addProduct()
  {
    $('#model-promotion').css('display','block');
  }
  function changeSp()
  {
    var id = $('#idCategories').val();
    $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
      $.ajax({
          url: "{{route('promotion.ajaxgetProduct')}}",
          type: 'POST',
          data: { aid: id },
          success: function(data){
            $('.setvalueproduct').html(data);
          },
          error: function (){
              alert('Có lỗi xảy ra');
          }
      });
    
  }
  function saveProduct()
  {
    var ar = "";
    $('input[name="checkall[]"]:checked:enabled').each(function() {
        ar = $(this).val()+'-'+ar;
    });
    $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
      $.ajax({
          url: "{{route('promotion.savesp')}}",
          type: 'POST',
          data: { aid: ar},
          success: function(data){
            $('#model-promotion').css('display','none');
            $('#setproductpromotion').html(data);
          },
          error: function (){
              alert('Có lỗi xảy ra');
          }
      });
  }
  function exit()
  {
    $('#model-promotion').css('display','none');
  }
</script>
@stop
