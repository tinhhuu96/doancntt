@extends('templates.admin.template')
@section('content')
<div class="row">
  <div class="col-xs-12">
    <div class="box box-primary">
      <div class="box-header">
        <h3 class="box-title">View Products</h3>
        <a href="{{ route('admin.cate.add.product') }}" class="btn btn-success pull-right"> Add new product</a>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <form action="{{ route('admin.deleteMuch.product') }}" method="post">
          {{ csrf_field() }}
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th class="text-center">Mã sp</th>
                <th class="text-center">Name Product</th>
                <th class="text-center">Hình ảnh</th>
                <th class="text-center">Số lượng</th>
                <th class="text-center">Đơn giá</th>
                <th colspan="4" class="text-center">Chức Năng</th>
                <th class="text-center">
                  <button onclick="var tb=confirm('Bạn có muốn xóa không ?');if(tb==true){return true;}else{return false;};" class="btn btn-danger" type="submit" name="delete">Xóa</button><br />
                  <input type="checkbox" class="" id="check_all" />
                </th>
              </tr>
            </thead>
            <tbody>
              @foreach( $arProduct as $key => $value)
                <?php  
                ?>
                <tr>
                  <td>{{ $value->code }}</td>
                  <td><a href="#" title="xem chi tiết">{{ $value->name }}</a>
                  </td>
                  <td class="text-center">
                    @if( $value->picture != "" )
                      <img src="{{ asset('storage/products/'.$value->picture) }}" title="{{ $value->name}}" class="thumbnail" style="width: 100px; height: 50px; display: inline;" />
                    @else
                      <span>Đang cập nhật...</span>
                    @endif
                  </td>
                  <td>
                    <input type="number" name="" value="{{ $value->quantity }}" placeholder="" class="form-control" disabled="true">
                  </td>
                  <td>{{ $value->price }} vnđ</td>
                  <td><a href="{{ route('admin.Order.inputUpdate',['slug'=>str_slug($value->name), 'id'=> $value->id ]) }}">Nhập đơn hàng</a></td>
                  <td>
                    @if($value->active == 1)
                      <a href="javascript:void(0)" id="change-{{ $value->id }}" ><i class="fa fa-power-off text-green" onclick="changerActive({{ $value->id }},0)" aria-hidden="true"></i></a>
                    @else
                      <a href="javascript:void(0)" id="change-{{ $value->id }}" ><i class="fa fa-power-off text-red" onclick="changerActive({{ $value->id }},1)" aria-hidden="true"></i></a>
                    @endif
                  </td>
                  <td>
                    <a href="{{ route('admin.edit.product',['id'=>$value->id]) }}" class="text-yellow" ><i class="fa fa-edit"></i> Edit</a>
                  </td>
                  <td>
                    <a href="{{ route('admin.destroy.product',['id'=>$value->id]) }}" class="text-red"><i class="fa fa-trash-o"> Delete</i></a>
                  </td>
                  <td class="text-center">
                    <input type="checkbox" id="" class="check" name="checkall[]" value="{{$value->id}}"/>
                  </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
              <div class="text-right">
                {{ $arProduct->links() }}
              </div>
            </tfoot>
          </table>
        </form>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
  </div>
  <!-- /.col -->
</div>
@section('script')
<script type="text/javascript">
  

  function changerActive(id,so){
      $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
      $.ajax({
          url: "{{route('admin.ajax.changeActive')}}",
          type: 'POST',
          data: {aid: id, aso : so },
          success: function(data){
                  $('#change-'+id).html(data);
          },
          error: function (){
              alert('Có lỗi xảy ra');
          }
      });
  }
  $('#check_all').on('change', function() {
        var checkall = document.getElementById("check_all");
        var check    = document.getElementsByClassName("check");
        if (checkall.checked) {
            for (var i = 0; i < check.length; i++) {
                check[i].checked = true;
            }
        }else{
            for (var i = 0; i < check.length; i++) {
                check[i].checked = false;
            }
        }
      });
</script>
@stop
@stop
