@extends('templates.admin.template')
@section('content')
             <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Danh Sách Đơn Hàng</h3>
            </div>
            <!-- /.box-header -->
           <div class="box-body">
              <div class="form-inline" style="margin-bottom: 10px; float: left;">
              {!! Form::open(['url' => 'adminpc/orders/search', 'enctype' => 'multipart/form-data', 'method' => 'GET']) !!}
              {!! Form::select('status', array('2' => 'All', '0' => 'not avalible', '1' => 'avalible'),['class' => 'form-control'],['class' => 'form-control']) !!}
              {!! Form::date('date_start', null, ['class' => 'form-control']) !!}
              {!! Form::date('date_end', null, ['class' => 'form-control']) !!}
              {!! Form::submit('Search ', ['class' => 'btn btn-primary'])!!}
              {!! Form::close() !!}

             </div>
             @if(isset($date_start) and isset($date_end) or isset($status))
             <a href="{{url('/adminpc/orders/export?status='. $status .'&date_start='. $date_start . '&date_end='. $date_end)}}" class="btn btn-success" style="float: right;"> Export Order</a>
             @else
             <a href="{{url('/adminpc/orders/export?status=2')}}" class="btn btn-success" style="float: right;"> Export Order</a>
             @endif

              <table  id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Ngày Đặt Hàng</th>
                  <th>Trạng Thái</th>
                  <th>Địa Chỉ Giao Hàng</th>
                  <th>Tình Trạng Giao Hàng</th>
                  <th>Số Điện Thoại</th>
                  <th>Tên Người Nhận</th>
                  <th>Người Đặt Hàng</th>
                  <th>Sửa</th>
                  <th>Xem Chi Tiết</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($orders as $order)
	               <tr>
                  <td>{{ $order ->id}}</td>
                  <td>{{ $order ->created_at}}</td>
                  <td><?php if ($order->status == 0) echo "not avalible"; else echo "avalible"; ?></td>
                  <td>{{ $order ->address}}</td>
                  <td><?php if ($order->shipping_status ==0) echo "Waiting"; elseif ($order->shipping_status ==1) echo "Done"; else echo "Cancel" ?></td>
                  <td>{{ $order ->phone}}</td>
                  <td>{{ $order ->name}}</td>
                  <td>{{ App\User::find($order->user_id)->name}}</td>
                  <td><a href="{{ url('adminpc/orders/'. $order->id . '/edit')}}"><span class="glyphicon glyphicon-pencil"></span></a></td>
                  <td><a href="{{ url('adminpc/' . $order->id .'/orderdetails') }}">Xem chi tiết</a></td>

                </tr>
                @endforeach
                </tbody>

              </table>
            </div>
            <!-- /.box-body -->
          </div>
         </div>
@stop
