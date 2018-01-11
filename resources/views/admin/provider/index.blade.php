@extends('templates.admin.template')
@section('content')

<div class="row">
  <div class="col-md-5">
    <div class="box box-primary box-solid collapsed-box">
      <div class="box-header with-border">
        <h3 class="box-title text-white">Thêm danh mục</h3>
        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
          </button>
        </div>
        <!-- /.box-tools -->
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <form action="" enctype="multipart/form-data" method="post">
          {{ csrf_field() }}
          <div class="form-group">
            <label for="">Name</label>
            <input type="text" name="name" id="name" value="" placeholder="nhập..." class="form-control" required="">
            @if ($errors->has('name'))
                <span class="help-block">
                    <strong class="text-danger">{{ $errors->first('name') }}</strong>
                </span>
            @endif
          </div>
          <div class="form-group">
            <label for="">phone</label>
            <input type="number" name="phone" id="phone" value="" placeholder="nhập..." class="form-control"  required="">
            @if ($errors->has('phone'))
                <span class="help-block">
                    <strong class="text-danger">{{ $errors->first('phone') }}</strong>
                </span>
            @endif
          </div>
          <div class="form-group">
            <label for="">Address</label>
            <input type="text" name="address" id="address" value="" placeholder="nhập..." class="form-control"  required="">
            @if ($errors->has('address'))
                <span class="help-block">
                    <strong class="text-danger">{{ $errors->first('address') }}</strong>
                </span>
            @endif
          </div>
          <div class="form-group">
            <label for="">Email</label>
            <input type="email" name="email" id="email" value="" placeholder="nhập..." class="form-control"  required="">
            @if ($errors->has('email'))
                <span class="help-block">
                    <strong class="text-danger">{{ $errors->first('email') }}</strong>
                </span>
            @endif
          </div>
          <div class="form-group">
            <div class="col-xs-3">
              <a  value="Add New" onclick="addProvider()" class="btn btn-success">Add new</a>
            </div>
            <div class="col-xs-3">
                <button type="button" class="btn btn-default text-right" data-widget="collapse"><i class="fa fa-arrow-circle-up ">Close</i>
              </button>
            </div>
          </div>
        </form>
        </div>
      </div>
    </div>
    <!-- <div class="col-md-5">
      @if(Session::has('msg-s'))
          <div class="alert alert-success alert-dismissable">{{ Session::get('msg-s') }}</div>
        @endif
        @if(Session::has('msg-e'))
          <div class="alert alert-danger alert-dismissable">{{ Session::get('msg-e') }}</div>
        @endif
    </div> -->
</div>
<div class="row text-center">
  <div class="col-xs-offset-1 col-xs-10">
    <div class="box box-success">
      <div class="box-header with-border">
        <h3 class="box-title">List providers</h3>
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
        <form action="">
          <table id="" class="table table-bordered table-hover text-center">
            <thead>
            <tr class="">
              <th>.#</th>
              <th>Name</th>
              <th>phone</th>
              <th>address</th>
              <th>email</th>
              <th colspan="2">Chức Năng</th>
            </tr>
            </thead>
            <tbody>
              <?php
                $i =0;
                foreach ($providers as $key => $value) {
                  $i++;
                  $id          = $value->id;
                  $name        = $value->name;
                  $slug        = str_slug($name);
                  $phone      = $value->phone;
                  $address      = $value->address;
                  $email      = $value->email;
                  $urledit     = route('provider.edit',['slug'=>$slug, 'id'=>$id]);
                  $urldelete   = route('provider.destroy',['id'=>$id]);
              ?>
            <tr id="provider-{{$id}}">
              <td>{{ $i }}</td>
              <td><a href="#" title="xem chi tiết">{{ $name }}</a>
              </td>
              <td>{{ $phone }}</td>
              <td>{{ $address }}</td>
              <td>{{ $email }}</td>
              <td>
                <a href="{{ $urledit }}" class="text-yellow" ><i class="fa fa-edit"></i> Edit</a>
              </td>
              <td>
                <a href="javascript:void(0)" onclick="var tb=confirm('Bạn có muốn xóa không ?');if(tb==true){return destroyProvide({{$id}});}else{return false;};" class="text-red"><i class="fa fa-trash-o"> Delete</i></a>
              </td>
            </tr>
            <?php } ?>
            </tbody>
          </table>
        </form>
      </div>
      <!-- /.box-body -->
      <div class="box-footer text-right">
          {{ $providers->links() }}
      </div>
    </div>
    <!-- /.box -->
  </div>
</div>
<script type="text/javascript">
  function addProvider()
  {
    var name = $('#name').val();
    var phone = $('#phone').val();
    var address = $('#address').val();
    var email = $('#email').val();
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
      url: "{{route('provider.store')}}",
      type: 'post',
      data: {aname: name,aphone:phone,aaddress:address,aemail:email},
      success: function(data){
        $('#alertprovider').html(data);
        $('#mes-provider').css({display:'block', transition:'0.3 all'});
        setTimeout(function(){ $('#mes-provider').fadeOut() }, 2000);
        setTimeout(function(){ window.location ="{{ route('provider.index') }}" }, 2000);
      },
      error: function (){
        alert('Có lỗi xảy ra');
      }
    });
  }

  function destroyProvide(id)
  {
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
      url: "{{route('provider.destroy')}}",
      type: 'post',
      data: {aid: id},
      success: function(data){
        $('#provider-'+id).fadeOut(500);
        $('#alertprovider-s').html(data);
        $('#mes-provider-s').css({display:'block', transition:'0.3 all'});
        setTimeout(function(){ $('#mes-provider-s').fadeOut() }, 1000);
      },
      error: function (){
        alert('Có lỗi xảy ra');
      }
    });
  }
</script>
@stop
