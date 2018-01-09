@extends('templates.admin.template')
@section('content')
<?php 
  use App\Calculation;
  $arcalcu    = Calculation::all();
?>

<div class="row">
  <div class="col-xs-11">
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Chi tiết Khuyến Mãi</h3>
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
                <input disabled="" type="text" name="name" value="{{ $arpromotions[0]->name }}" placeholder="nhập tên khuyến mãi..." class="form-control">    <br>
                <?php $c = "checked"; ?>
                @foreach($arcalcu as $valuecacul)
                  @if( $valuecacul->id == $arpromotions[0]->calculation_id)
                    <input type="radio" name="radio_km" class="flat-red" {{$c}} value="{{ $valuecacul->id}}">{{ $valuecacul->name }} &nbsp&nbsp
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
                <input disabled="" type="number" name="gt_pro" value="{{ $arpromotions[0]->value_km }}" placeholder="nhập % or $..." class="form-control">
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
                @else
                <input type="radio" name="radio_active" class="flat-red" checked value="2"> Không
                @endif
              </div>
            </div>
          </div>
          <br>
          <div class="row">
            <div class="col-xs-12">
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
@stop
