@extends('templates.admin.template')
@section('content')
<style type="text/css" media="screen">
  img{
    width: 100px;
    height: 50px;
    display: inline !important;
    margin: 0 !important;
  }
</style>
<div class="row">
  <div class="col-md-6">
    <div class="box box-primary  box-solid">
      <div class="box-header with-border">
        <h3 class="box-title text-white">Chỉnh sửa danh mục</h3>
        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
          </button>
        </div>
        <!-- /.box-tools -->
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <form action="{{ route('admin.updateCate',['slug'=>str_slug($arcate->name),'id'=>$arcate->id]) }}" method="post" enctype="multipart/form-data">
          {{ csrf_field() }}
          <input type="hidden" name="id" value="{{ $arcate->id }}">
          <div class="form-group">
            <label for="">Name Category</label>
            <input type="text" name="name" required="" value="{{ $arcate->name }}" placeholder="" class="form-control">
          </div>
          <div class="container row">
            <div class="form-group">
              <label for="">Chọn Parent</label> <br>
              <select name="parent" class="form-control select2" style="width: 200px !important;">
                <option value="0">-- not parent --</option>
                  <?php 
                    foreach ($category as $key => $value) {
                  ?>
                    @if($value->id == $arcate->parent)
                    <option selected="selected" value="{{ $value->id}}">{{$value->name}}</option>
                    @else
                    <option value="{{ $value->id}}">{{ $value->name}}</option>
                    @endif
                  <?php
                    }
                  ?>
              </select>
            </div>
          </div>
          <div>
            <input type="submit" name="" value="Update" class="btn btn-success">
          </div>
        </form>
        </div>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
  </div>
@stop