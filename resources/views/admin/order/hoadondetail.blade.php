@extends('templates.admin.template')
@section('content')
<div class="row text-center">
  <div class="col-xs-12">
    <div class="box box-success">
      <div class="box-header with-border">
        <h3 class="box-title">Hóa Đơn của khách hàng <span><strong>Trần Quốc Thiên</strong></span></h3>
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
              <th>Sản phẩm</th>
              <th>Số lượng</th>
              <th>Đơn giá</th>
              <th>Thành tiền</th>
              <th>Trạng thái</th>
              <th colspan="1">Chức Năng</th>
              <th><button type="submit" class="btn btn-success">Xóa</button></th>
            </tr>
            </thead>
            <tbody>
            <tr>
              <td>1</td>
              <td>HD12172017</td>
              <td><a href="#" title="xem chi tiết">Iphone 7 plus</a>
              </td>
              <td><input type="number" name="" value="1" class="form-control" disabled></td>
              <td><strong>1.320.000 VNĐ</strong></td>
              <td><strong>1.320.000 VNĐ</strong></td>
              <td>
                <select class="form-control" disabled>
                  <option value="" selected="selected">Đã thanh toán</option>
                  <option value="">Chưa thanh toán</option>
                </select>
              </td>
              <td>
                <a href="#" class="text-success"><i class="fa fa-refresh"> Edit</i></a>
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
              <th colspan="9" rowspan="" headers="" scope=""></th>
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