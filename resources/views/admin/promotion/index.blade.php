@extends('templates.admin.template')
@section('content')
<?php 
  function date_formats($str)
  {
      $arNgay = explode(' ', $str);
      $ardate = explode('-', $arNgay[0]);
      return  $ardate[2].'-'.$ardate[1].'-'.$ardate[0];
  }
?>
<div class="row">
  <div class="col-xs-11">
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Chương trình khuyến mãi KH</h3>
        <a href="{{ route('promotion.create') }}" class="pull-right btn btn-success"><i class="fa fa-plus-square" aria-hidden="true"></i> Thêm khuyến mãi</a>
      </div>
      <!-- /.box-header -->
        <div class="box-body">
          <table class="table table-bordered text-center">
            <thead>
              <tr>
              <th colspan="" rowspan="" headers="" scope="">Chương trình khuyến mãi</th>
                <th colspan="" rowspan="" headers="" scope="">Thời gian</th>
                <th colspan="" rowspan="" headers="" scope="">Nội dung</th>
                <th colspan="" rowspan="" headers="" scope="">Tình trạng</th>
                <th colspan="3" rowspan="" headers="" scope="">Chức năng</th>
              </tr>
            </thead>
            <tbody>
              @foreach( $arPromotion as $valuePromotion)
              <tr id="promotion-{{ $valuePromotion->id }}">
                <td colspan="" rowspan="" headers="">{{ $valuePromotion->name}}</td>
                <td colspan="" rowspan="" headers="">Bắt đầu: <?php echo date_formats($valuePromotion->date_begin); ?> <br> Hết hạn: <?php echo date_formats($valuePromotion->date_end); ?></td>
                <td colspan="" rowspan="" headers="">{{ $valuePromotion->namecalcu }}: {{ $valuePromotion->value_km }}</td>
                <td colspan="" rowspan="" headers="">
                  @if( $valuePromotion->active == 1)
                    <i class="btn btn-success">Đang hoạt động</i>
                  @else
                    <i class="btn btn-danger">Đã hết hạn</i>
                  @endif
                </td>
                <td>
                  <a href="{{ route('promotion.show',['id'=> $valuePromotion->id]) }}"><i>xem chi tiết</i></a>
                </td>
                <td>
                  <a href="{{ route('promotion.edit',['id'=> $valuePromotion->id]) }}" class="text-yellow" ><i class="fa fa-edit"></i> Edit</a>
                </td>
                <td>
                  <a href="javascript:void(0)" onclick="var tb=confirm('Bạn có muốn xóa không ?');if(tb==true){return destroypromotion({{$valuePromotion->id}});}else{return false;};" class="text-red"><i class="fa fa-trash-o"> Delete</i></a>
                </td>
              </tr>
              @endforeach
            </tbody>
            <tfoot>
              <tr></tr>
            </tfoot>
          </table>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          
        </div>
      </form>
    </div>
  </div>
</div>
<script type="text/javascript">
  function destroypromotion(id)
  {
    $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
      $.ajax({
          url: "{{route('promotion.destroy')}}",
          type: 'POST',
          data: { aid: id},
          success: function(data){
            $('#promotion-'+id).fadeOut(1000);
            $('#alertprovider-e').html(data);
            $('#mes-provider-e').css({display:'block', transition:'0.3 all'});
            setTimeout(function(){ $('#mes-provider-e').fadeOut() }, 2000);
          },
          error: function (){
              alert('Có lỗi xảy ra');
          }
      });
  }
</script>
@stop
