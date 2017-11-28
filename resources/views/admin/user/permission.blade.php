@extends('templates.admin.template')
@section('content')
<style>
img{
    display: inline-block !important;
    width:100px; 
    height:50px;
}
</style>
<div class="row">
    <div class="col-xs-6">
        <div class="box box-danger ">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-address-card" aria-hidden="true"></i> Thêm Quyền vào hệ thống</h3>
                <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                </button>
                </div>
                <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <form action="{{ route('admin.permission.store')}}" method="post" accept-charset="utf-8">
                {{ csrf_field() }}
                <div class="box-body">
                    @if(Session::has('msg-s'))
                        <div class="alert alert-success alert-dismissable">{{ Session::get('msg-s') }}</div>
                      @endif
                      @if(Session::has('msg-e'))
                        <div class="alert alert-danger alert-dismissable">{{ Session::get('msg-e') }}</div>
                      @endif
                    <div class="form-group">
                        <label for="">Permission name</label>
                        <input type="text" name="name" value="" placeholder="nhập..." class="form-control" style="width:300px;">
                    </div>
                </div>
                <div class="box-footer">
                    <div class="form-group">
                        <input type="submit" value="Add" class="form-control btn btn-success" style="width:100px;">
                    </div>
                </div>
            </form>
        <!-- /.box-body -->
        </div>
    </div>
    <div class="col-xs-6">
        <div class="box box-success">
      <div class="box-header with-border bg-success">
        <h3 class="box-title"><i class="fa fa-users"></i>Permission</h3>
        <!-- /.box-tools -->
      </div>
      <!-- /.box-header -->
      
      <div class="box-body">
            <table id="" class="table table-bordered table-hover text-center">
                <thead>
                    <tr class="">
                        <th>.#</th>
                        <th>name</th>
                        <th colspan="2">Chức Năng</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($arpermis as $key => $value)
                <?php   
                    $id = $value->id;
                    $delete = route('admin.permission.destroy',['id'=>$id]);
                    $update = route('admin.permission.update',['id'=>$value->id]);
                ?>
                <tr>
                    <td>{{ $key}}</td>
                    <td>
                        <input type="hidden" id="Inputold-{{ $value->id}}" value="{{ $value->name }}">
                        <input type="text" class="form-control" value="{{ $value->name }}" disabled="true" id="Input-{{$value->id}}">
                    </td>
                    <td>
                        <a id="Edit-{{$value->id}}" style="display: inherit;" href="javascript:void(0)" class="text-yellow" onclick="EditEvent({{$value->id}})">
                            <i class="fa fa-edit">Edit</i>
                        </a>

                        <a id="Update-{{$value->id}}" style="display: none;" href="javascript:void(0)" class="text-yellow" onclick="Update({{$value->id}})"><i class="fa fa-refresh"> Update</i></a>

                    </td>
                    <td>
                        <a href="{{ $delete }}" class="text-red"><i class="fa fa-remove">Delete</i></a>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
      </div>
      <!-- /.box-body -->
    </div>
    </div>
  <div class="col-xs-8">
    <div class="box box-success">
      <div class="box-header with-border bg-success">
        <h3 class="box-title"><i class="fa fa-users"></i>Permission</h3>
        <!-- /.box-tools -->
      </div>
      <!-- /.box-header -->
      
      <div class="box-body">
        <form action="" method="post">
            <table id="" class="table table-bordered table-hover text-center">
                <thead>
                    <tr class="">
                        <th>.#</th>
                        <th>Username</th>
                        <th>Quyền truy cập</th>
                        <th colspan="2">Chức Năng</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $selected=""; ?>
                @foreach( $aruser as $key => $values)

                <input type="hidden" id="idperuser-{{ $key }}" value="{{ $values->idperuser }}">
                <tr>
                    <td>{{ $key }}</td>
                    <td><a href="javascript:void(0)" id="idusername-{{ $key }}" codeid="{{ $values->id }}" title="xem chi tiết">{{ $values->name}}</a>
                    </td>
                    <td>
                        <select class="form-control select2" id="permis-{{$key}}">
                            @foreach($arpermis as $k => $val)
                                @if($val->id == $values->permission_id)
                                    <?php 
                                        $selected = "selected";
                                    ?>
                                @endif
                                    <option selected="{{ $selected }}" value="{{ $val->id }}">{{ $val->name }}</option>
                                
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <a href="javascript:void(0)" onclick="setPermission({{ $key }})" class="text-yellow"><i class="fa fa-plus-square-o"> Chọn</i></a>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </form>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
  </div>
</div>
<script type="text/javascript">
    function EditEvent(id){
        $("#Input-"+id).attr("disabled", false);
        $("#Edit-"+id).css({'display': 'none'});
        $("#Update-"+id).css({'display': 'inherit'});
    }

    function Update(id)
    {
        var name = $("#Input-"+id).val();
        $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });
        $.ajax({
            url: "{{route('admin.permission.update')}}",
            type: 'POST',
            data: {aid: id, aname : name },
            success: function(data){
                $("#Update-"+id).css({'display': 'none'});
                $("#Edit-"+id).css({'display': 'inherit'});
                $("#Input-"+id).attr("disabled", true);
                $("#Input-"+id).attr('value').val(data);
            },
            error: function (){
                alert('Có lỗi xảy ra');
            }
        });
    }

    function setPermission(id){
        var idperuser = 0;
        var iduser = $("#idusername-"+id).attr('codeid');
        var idpermis = $("#permis-"+id).val();
        idperuser = $("#idperuser-"+id).val();
        $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });
        $.ajax({
            url: "{{route('admin.permission.set')}}",
            type: 'POST',
            data: {auser: iduser, apermis : idpermis , aidperuser:idperuser },
            success: function(data){
                if (data== 0) {
                    alert("Chọn thất bại ");
                }else{
                    alert("Chọn thành công");
                }
                
            },
            error: function (){
                alert('Có lỗi xảy ra');
            }
        });
    }
</script>
@stop