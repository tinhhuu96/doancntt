@extends('templates.admin.template')
@section('content')
<div class="row text-center">
  <div class="col-xs-12">
    <div class="box box-success">
      <div class="box-header with-border">
        <h3 class="box-title">Quản lý Hóa Đơn</h3>
        <!-- /.box-tools -->
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <form action="">
          <table id="" class="table table-bordered table-hover text-center">
            <thead>
            <tr class="">
              <th>.#</th>
              <th>Code</th>
              <th>Hoten</th>
              <th>Số lượng</th>
              <th>Tổng tiền</th>
              <th>Trạng thái</th>
              <th colspan="2">Chức Năng</th>
              <th><button type="submit" class="btn btn-success">Xóa</button></th>
            </tr>
            </thead>
            <tbody>
            <tr>
              <td>1</td>
              <td>HD12172017</td>
              <td><a href="#" title="xem chi tiết">Đỗ quang lai</a>
              </td>
              <td><input type="number" name="" value="1" class="form-control" disabled></td>
              <td>1.320.000 VNĐ</td>
              <td>
                <select class="form-control" disabled>
                  <option value="" selected="selected">Đã thanh toán</option>
                  <option value="">Chưa thanh toán</option>
                </select>
              </td>
              <td>
                <a href="{{ route('admin.detaiOrder') }}" class="text-yellow" ><i class="fa fa-link"></i> Xem chi tiết</a>
              </td>
              <td>
                <a href="#" class="text-red"><i class="fa fa-trash-o"> Delete</i></a>
              </td>
              <td>
                <input type="checkbox" class="minimal-red">
              </td>
            </tr>
            </tbody>
            <thead>
            <tr class="">
              <th colspan="8" rowspan="" headers="" scope=""></th>
              <th colspan="" class="text-right"><button type="submit" class="btn btn-success">Xóa</button></th>
            </tr>
            </thead>
          </table>
        </form>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
  </div>
</div>
@stop