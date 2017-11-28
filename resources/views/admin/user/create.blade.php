@extends('templates.admin.template')
@section('content')
<div class="row">
  <div class="col-xs-offset-2 col-xs-8">
    <div class="box box-primary">
      <div class="box-header with-border text-center">
        <h3 class="box-title "><i class="fa fa-user"></i>Register Users</h3>
      </div>
      <!-- /.box-header -->
      <!-- form start -->
      <form action="{{ route('admin.user.store') }}" enctype="multipart/form-data" method="post" role="form">
        {{ csrf_field() }}
        <div class="box-body">
            <div class="col-xs-4">
                <div class="form-group">
                    <label for="">UserName</label>
                    <input type="text" name="username" value="" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Fullname</label>
                    <input type="text" name="fullname" value="" class="form-control">
                </div>
            </div>
            <div class="col-xs-4">
                <div class="form-group">
                    <label for="">Password</label>
                    <input type="password" name="password" value="" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">password_confirmation</label>
                    <input type="password" name="password_confirmation" value="" class="form-control">
                </div>
            </div>
            
            <div class="col-xs-4">
                <div class="form-group">
                    <label for="">avatar</label> <br>
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
            <div class="col-xs-8">
                <div class="form-group">
                    <label for="">Gmail</label>
                    <input type="email" name="gmail" value="" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Địa Chỉ</label>
                    <input type="text" name="address" value="" class="form-control">
                </div>
            </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer text-center">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>
@stop