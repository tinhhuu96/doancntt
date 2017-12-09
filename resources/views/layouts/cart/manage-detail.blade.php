@extends('templates.public.templates_no_lestbar')
@Section('title')
    Checkout | E-Shopper
@stop
@section('content')
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
              <h3 class="box-title" style="float: left;">Chi Tiết Đơn Hàng </h3>
            </div>

            <!-- /.box-header -->
           <div class="box-body">
           	<table  id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Số lượng</th>
                  <th>Đơn Giá</th>
                  <th>Thành Tiền</th>
                  <th>Mã Đơn Hàng</th>
                  <th>Tên Sản Phẩm</th>

                </tr>
                </thead>
                <tbody>
                	<?php  $total = 0; ?>
	                @foreach ($items as $item)
		             <tr>
		                  <td>{{ $item ->id}}</td>
		                  <td>{{ $item ->quantity}}</td>
		                  <td>{{ number_format($item ->price, '2', ',', '.') . ' VNĐ'}}</td>
		                  <td>{{ number_format($item ->quantity * $item ->price, '2', ',', '.') . ' VNĐ'}}</td>
		                  <td>{{ $item ->order_id}}</td>
		                  <?php $product = App\Product::find($item->product_id); ?>
		                  @if (empty($product))
		                  <td> Sản Phẩm đã xóa hoặc ngừng kinh doanh</td>
		                  @else
		                  <td>{{ $product->name}}</td>
		                  @endif
	                </tr>
	                <?php $total+=$item->quantity * $item->price ?>
	                @endforeach
                </tbody>
             </table>
             <p style="float: right;"><b>Tổng Tiền: {{ number_format($total, '2', ',', '.') . ' VNĐ' }}</b></p>
            </div>
            <!-- /.box-body -->
          </div>
         </div>
         <a href="{{ url('carts/manage/'. $item->order_id. '/detail/export')}}" class="btn btn-success" style="float: right;"> Export PDF</a>
		</div>

	</section>
@stop
