@extends('templates.admin.template')
@section('content')
<div class="row">
  <div class="col-xs-offset-1 col-xs-10">
    <div class="form-group">
      <div class="input-group">
        <input type="text" class="form-control" placeholder="Search Category......">
        <span class="input-group-btn">
          <button class="btn btn-success" type="button">Tìm Kiếm !</button>
        </span>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-xs-12">
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Chọn Danh Mục Thêm Sản Phẩm</h3>
      </div>
      <!-- /.box-header -->
      <!-- form start -->
        <div class="box-body">
          <div class="row">
            <div class="col-xs-12">
              <style>
                .thumbnail{
                  margin-right:5px;
                }
              </style>
              @foreach( $category as $key => $value)
              <?php  
                $url = route('admin.add.product',['id'=> $value->id]);
              ?>
              <div class="col-xs-2 thumbnail img-thumbnail text-center btn btn-success " >
                <a href="{{ $url }}" class="btn btn-default btn-lg active" role="button">
                  <label class="control-label " for="">{{ $value->name }}</label>
                </a>
              </div>
              @endforeach
            </div>
          </div>
        </div>
    </div>
  </div>
  
</div>
@stop