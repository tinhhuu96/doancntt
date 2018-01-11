@extends('templates.admin.template')
@section('content')
<!-- <div class="row">
    <div class="col-md-5">
        <div id="alertajax"></div>
        @if(Session::has('msg-s'))
            <div class="alert alert-success alert-dismissable">{{ Session::get('msg-s') }}</div>
        @endif
        @if(Session::has('msg-e'))
            <div class="alert alert-danger alert-dismissable">{{ Session::get('msg-e') }}</div>
        @endif
      </div>
</div> -->
<div class="row">
    <div class="col-md-4">
        <div class="box box-danger collapsed-box">
            <div class="box-header with-border">
                <h3 class="box-title">Add News Parameters</h3>
                <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                </button>
                </div>
                <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <form action="" method="">
                    <div class="form-group">
                        <label for="">Parameter Name</label>
                        <input type="text" name="name" id="name" value="" placeholder="nhập..." class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Chọn danh mục</label> <br>
                        <select id="parameters" name="category" class="form-control select2" style="width: 250px;">
                            @foreach( $categories as $key => $value )
                            <option value="{{ $value->id }}">{{ $value->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <input type="button" onclick="addPara()" value="Thêm Mới" class="btn btn-success">
                    </div>
                </form>
            </div>
        <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>

    <div class="col-md-8">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Danh Sách Parameters</h3>
            </div>
        <!-- /.box-header -->
            <div class="box-body">
                <table class="table table-bordered text-center">
                    <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Name</th>
                            <th colspan="2">chức năng</th>
                        </tr>
                    </thead>
                    <tbody id=getparameters>

                    </tbody>
                    <tfoot>
                        <tr></tr>
                    </tfoot>
                </table>
            </div>
        </div>

    </div>
</div>
</div>

@stop
