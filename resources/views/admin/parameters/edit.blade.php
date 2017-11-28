@extends('templates.admin.template')
@section('content')
<div class="row">
<div class="col-md-6">
        <div class="box box-danger">
            <div class="box-header with-border">
                <h3 class="box-title">Add News Parameters</h3>
                <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                </button>
                </div>
                <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <form action="{{ route('admin.update.parameters',[ 'id'=>$parameters['id'] ]) }}" method="POST" >
                {{ csrf_field() }}
                <div class="box-body">
                    <div class="form-group">
                        <label for="">Name Old</label>
                        <input type="text" name="" value="{{ $parameters['name'] }}" placeholder="" class="form-control" disabled>
                    </div>
                    <div class="form-group">
                        <label for="">New Name</label>
                        <input type="text" name="name" value="" placeholder="nhập..." class="form-control">
                    </div>
                </div>
                <div class="box-footer">
                    <div class="row">
                        <div class="col-xs-3">
                            <input type="submit" value="Update" class="btn btn-success">
                        </div>
                        <div class="col-xs-3">
                            <a href="" class="btn btn-default">Cancel</a>
                        </div>
                    </div>
                </div>
            </form>
        <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>    
</div>
@stop