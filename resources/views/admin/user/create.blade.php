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
        {!! Form::open(['url' => route('admin.user.store') ]) !!}
        <div class="box-body">
            <div class="col-xs-6">
                <div class="form-group">
                    <label for="">Name</label>
                    <input type="text" name="name" value="" class="form-control" value="{{ old('name') }}"  autofocus>
                     @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                      @endif
                </div>
            </div>
            <div class="col-xs-4" style="float: right;">
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
            <div class="col-xs-6">
                <div class="form-group">
                    <label for="">Password</label>
                    <input type="password" name="password" value="" class="form-control">
                    @if ($errors->has('password'))
                      <span class="help-block">
                          <strong>{{ $errors->first('password') }}</strong>
                      </span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="">password_confirmation</label>
                    <input type="password" name="password_confirmation" value="" class="form-control">
                    @if ($errors->has('password_confirmation'))
                      <span class="help-block">
                          <strong>{{ $errors->first('password_confirmation') }}</strong>
                      </span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="">Permission</label>
                    <?php $permission = App\Permission::pluck('name', 'id') ?>
                    {!! Form::select('permission', $permission,['class' => 'form-control'],['class' => 'form-control']) !!}
                </div>
            </div>

            <div class="col-xs-8">
              <div class="form-group">
                    <label for="">Phone</label>
                    <input type="tel" name="phone" value="" class="form-control" value="{{ old('phone') }}"  autofocus>
                    @if ($errors->has('phone'))
                      <span class="help-block">
                          <strong>{{ $errors->first('phone') }}</strong>
                      </span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="">Email</label>
                    <input type="email" name="email" value="" class="form-control" value="{{ old('email') }}"  autofocus>
                    @if ($errors->has('email'))
                      <span class="help-block">
                          <strong>{{ $errors->first('email') }}</strong>
                      </span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="">Địa Chỉ</label>
                    <input type="text" name="address" value="" class="form-control" value="{{ old('address') }}"  autofocus>
                </div>
            </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer text-center">
          {!! Form::submit('Search ', ['Register' => 'btn btn-primary'])!!}
        </div>
      {{!! Form::close() !!}}
    </div>
  </div>
</div>
@stop
