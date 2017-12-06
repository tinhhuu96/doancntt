@extends('templates.public.templates_no_lestbar')
@Section('title')
    Checkout | E-Shopper
@stop
@section('content')
	@if(count($orders) > 0)
	<section id="cart_items" style="margin-bottom: 50px !important">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li class="active">Manage Basket</li>
				</ol>
		</div>

		 <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title" style="float: left;">Danh Sách Đơn Hàng Gần Đây</h3>
              <a href="{{ url('carts/manage/export')}}" class="btn btn-success" style="float: right;"> Export Excel</a>
            </div>
            <!-- /.box-header -->
           <div class="box-body">
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
                  <th>Hủy Đơn Đặt Hàng</th>
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
		                  @if( $order->status == 1)
		                  <td style="text-align: center;">
			                  <a href="{{ url('carts/manage/' . $order->id . '/cancel')}}">
			                  	Hủy
			                  </a>
			              </td>
		                  @else
		                  <td style="text-align: center; vertical-align: middle;">Không khả dụng</td>
		                  @endif
		                  <td><a href="{{ url('carts/manage/' . $order->id .'/detail') }}">Xem chi tiết</a></td>
	                </tr>
	                @endforeach
                </tbody>
             </table>
            </div>
            <!-- /.box-body -->
          </div>
         </div>
		</div>

	</section>
	@else
	<section>
		<div class="container">
			<div class="" style="text-align: center; margin: 10px">
	        <h3 class="">Không Tìm Thấy Đơn Hàng</h3>
		        <a href="{{ url('/')}}" class="btn btn-primary btn-lg active" role="button">Tiếp tục mua hàng</a>
	    </div>
		</div>
	</section>
	@endif
@stop
