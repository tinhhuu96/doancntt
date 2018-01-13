@extends('templates.admin.template')
@section('content')
<div class="row">
  <div class="col-xs-11">
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Thêm Sản Phẩm</h3>
      </div>
      <!-- /.box-header -->
      <!-- form start -->
      <form action="{{ route('admin.addproduct.store') }}" role="form" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <input type="hidden" name="user_id" value="{{ Session::get('ID') }}">
        <div class="box-body">
          <div class="row">
            <div class="col-xs-6">
              <div class="form-group">
                <label>Hiện đang Chọn danh mục</label>
                <input class="form-control" id="disabledTextInput" type="text" value="{{ $category->name }}" readonly>
                <input type="hidden" name="idcate" value="{{ $category->id }}">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-3">
              <div class="form-group">
                <label for="">Mã Sản Phẩm</label>
                <input type="text" name="code" class="form-control" placeholder="Enter code product" >
                @if ($errors->has('code'))
                    <span class="help-block">
                        <strong class="text-danger">{{ $errors->first('code') }}</strong>
                    </span>
                @endif
              </div>
              <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                <label for="">Tên Sản Phẩm</label>
                <input type="text" id="name" class="form-control" name="name" autofocus placeholder="Enter name product">
                @if ($errors->has('name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
              </div>
            </div>
            <div class="col-xs-4">
              <div class="form-group">
                <label>Nhà cung cấp</label>
                <select class="select2 form-control" name="provider" style="width: 100%;">
                  <option selected="selected" value="0">---mời chọn---</option>
                  @foreach( $providers as $ProValue)
                  <option value="{{ $ProValue->id }}">{{ $ProValue->name }}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label>Trạng thái hiển thị</label>
                <select name="display" class="form-control" style="width: 100%;">
                  <option selected="selected" value="1">Có</option>
                  <option value="0">Không</option>
                </select>
              </div>
            </div>
            <div class="col-xs-2">
              <div class="form-group">
                  <label for="">Chọn Avatar</label> <br>
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
          </div>
          <div class="row">
            <div class="col-xs-12">
              <div class="form-group">
                <label for="">Chi Tiết Sản Phẩm</label>
                  @if ($errors->has('detail'))
                      <span class="help-block">
                          <strong>{{ $errors->first('detail') }}</strong>
                      </span>
                  @endif
                  <textarea class="ckeditor form-control" rows="3" name="detail" ></textarea>
              </div>
            </div>
          </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer text-left">
          <div class="row col-xs-offset-7">
            <div class="col-xs-4">
              <button type="submit" class="btn btn-primary">Add Product</button>
            </div>
            <div class="col-xs-3">
              <a href="{{ route('admin.listproduct') }}" class="btn btn-default">Cancel</a>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
@stop