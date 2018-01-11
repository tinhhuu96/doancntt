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
          <li><a href="{{ url('/carts/manage') }}">Order</a></li>
				  <li><a href="#">Order Details</a></li>
				</ol>
		</div>

		 <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title" style="float: left;">Order Details </h3>
            </div>

            <!-- /.box-header -->
           <div class="box-body">
           	<table  id="example2" class="table table-striped table-hover">
                <thead>
                <tr>
                  <th>ID Order</th>
                  <th>Quanlity</th>
                  <th>Price</th>
                  <th>Subtotal</th>
                  <th>Product Name</th>
                </tr>
                </thead>
                <tbody>
                	<?php  $total = 0; ?>
	                @foreach ($items as $item)
		             <tr>
		                  <td>{{ $item ->id}}</td>
		                  <td>{{ $item ->quantity}}</td>
		                  <td>{{ $item ->price}}$</td>
		                  <td>{{ $item ->quantity * $item ->price}}$</td>
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
             <p style="float: right;"><b>Total: {{ $total}}$</b></p>
            </div>
            <!-- /.box-body -->
          </div>
         </div>
         <a href="{{ url('carts/manage/'. $item->order_id. '/detail/export')}}" class="btn btn-success" style="float: right;"> Export PDF</a>
		</div>

	</section>
@stop
