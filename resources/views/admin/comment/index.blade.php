@extends('templates.admin.template')
@section('content')
<!-- <div class="row">
  <div class="col-md-5">
      @if(Session::has('msg-s'))
          <div class="alert alert-success alert-dismissable">{{ Session::get('msg-s') }}</div>
      @endif
      @if(Session::has('msg-e'))
          <div class="alert alert-danger alert-dismissable">{{ Session::get('msg-e') }}</div>
      @endif
    </div>
</div> -->
<div class="row text-center">
  <div class="col-xs-12">
    <div class="box box-success">
      <div class="box-header with-border">
        <h3 class="box-title">Danh sách danh mục</h3>
        <!-- /.box-tools -->
      </div>
      <!-- /.box-header -->
      <style type="text/css" media="screen">
        img{
          width: 100px;
          height: 50px;
          display: inline !important;
          margin: 0 !important;
        }
      </style>
      <div class="box-body">
        <form action="{{ route('admin.destroy.comment') }}" method="post">
          {{ csrf_field() }}
          <table id="" class="table table-bordered table-hover text-center">
            <thead>
            <tr class="">
              <th>.#</th>
              <th>Avatar</th>
              <th>Sản Phẩm</th>
              <th>Content</th>
              <th colspan="1">Chức Năng</th>
              <th>
                <button onclick="var tb=confirm('Bạn có muốn xóa không ?');if(tb==true){return true;}else{return false;};" class="btn btn-danger" type="submit" name="delete">Xóa</button><br />
                <input type="checkbox" class="" id="check_all" />
              </th>
            </tr>
            </thead>
            <tbody>
            @foreach($comments as $key => $value)
              <tr id="comment-{{ $value->id }}">
                <td>{{ $key }}</td>
                <td class="text-center">
                  <img src="{{ asset('storage/products/'.$value->picture) }}" title="hình ảnh" class="thumbnail" />
                </td>
                <td>{{ $value->name }}</td>
                <td>{{ $value->contents}}</td>
                <td>
                  <a href="javascript:void(0)" class="text-red" onclick="delComment({{ $value->id}})"><i class="fa fa-trash-o"> Delete</i></a>
                </td>
                <td>
                  <input type="checkbox" value="{{$value->id}}" name="checkall[]" class="check">
                </td>
              </tr>
            @endforeach
            </tbody>
          </table>
        </form>
      </div>
      <div class="box-footer">
        {{ $comments->links() }}
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
  </div>
</div>
@section('script')
<script type="text/javascript">
  function delComment(id)
{
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  $.ajax({
    url: "{{route('admin.ajax.delete')}}",
    type: 'post',
    data: {aid: id},
    success: function(data){
      $('#comment-'+data).fadeOut(1000);
      $('#alertprovider-e').html("Xóa Thành công");
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
@stop
