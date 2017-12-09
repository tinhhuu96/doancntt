@extends('templates.admin.template')
@section('content')
<div class="row">
  <div class="col-md-5">
    <div class="box box-primary box-solid ">
      <div class="box-header with-border">
        <h3 class="box-title text-white">Edit {{ $provider->name}}</h3>
        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
          </button>
        </div>
        <!-- /.box-tools -->
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <form action="{{route('provider.update')}}" enctype="multipart/form-data" method="post">
          {{ csrf_field() }}
          <input type="hidden" name="id" id="id" value="{{ $provider->id }}">
          <div class="form-group">
            <label for="">Name</label>
            <input type="text" name="name" id="name" value="{{ $provider->name}}" placeholder="nhập..." class="form-control" >
            @if ($errors->has('name'))
                <span class="help-block">
                    <strong class="text-danger">{{ $errors->first('name') }}</strong>
                </span>
            @endif
          </div>
          <div class="form-group">
            <label for="">phone</label>
            <input type="text" name="phone" id="phone" value="{{ $provider->phone}}" placeholder="nhập..." class="form-control" >
            @if ($errors->has('phone'))
                <span class="help-block">
                    <strong class="text-danger">{{ $errors->first('phone') }}</strong>
                </span>
            @endif
          </div>
          <div class="form-group">
            <label for="">Address</label>
            <input type="text" name="address" id="address" value="{{ $provider->address}}" placeholder="nhập..." class="form-control" >
            @if ($errors->has('address'))
                <span class="help-block">
                    <strong class="text-danger">{{ $errors->first('address') }}</strong>
                </span>
            @endif
          </div>
          <div class="form-group">
            <label for="">Email</label>
            <input type="text" name="email" id="email" value="{{ $provider->email}}" placeholder="nhập..." class="form-control" >
            @if ($errors->has('email'))
                <span class="help-block">
                    <strong class="text-danger">{{ $errors->first('email') }}</strong>
                </span>
            @endif
          </div>
          <div class="form-group">
            <div class="col-xs-3">
              <input type="submit" value="Update" class="btn btn-success">
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
    <div class="col-md-5">
      @if(Session::has('msg-s'))
          <div class="alert alert-success alert-dismissable">{{ Session::get('msg-s') }}</div>
        @endif
        @if(Session::has('msg-e'))
          <div class="alert alert-danger alert-dismissable">{{ Session::get('msg-e') }}</div>
        @endif
    </div>
</div>

@stop