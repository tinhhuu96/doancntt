@extends('templates.public.templates_no_lestbar')
@Section('title')
	Cart | E-Shopper
@stop
@section('content')
@if ( Cart::count() > 0)
	<section id="cart_items" style="margin-bottom: 50px">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li class="active">Shopping Cart</li>
				</ol>
			</div>
			 <a href="{{ url('/')}}" class="btn btn-primary btn-lg active" role="button" style="float: right; background-color: green">Tiếp tục mua hàng</a>
			 <br>
			 <br>
			 <br>
			<div class="table-responsive cart_info">

				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Item</td>
							<td class="description"></td>
							<td class="price">Price</td>
							<td class="quantity">Quantity</td>
							<td class="total">Total</td>
							<td></td>
						</tr>
					</thead>
					<tbody>
					<?php $content = Cart::content() ?>
					@foreach ($content as $item)
						<tr>
							<td class="cart_product">
								<a href=""><img src="{{ url('storage/products/'.$item->options->images) }}" style="width: 110px; margin-right: 25px" alt=""></a>
							</td>
							<td class="cart_description">
								<h4><a href="">{{$item->name}}</a></h4>
							</td>
							<td class="cart_price">
								<p style="margin-top: 20px">{{ number_format($item->price, 0, '.','.') . ' VNĐ'}}</p>
							</td>
							<td class="cart_quantity">
								<div class="cart_quantity_button">
								<?php $rowId = (string)$item->rowId ?>
								<form>
  									<input type="button" value=" - " onclick="down('{{$item->rowId}}')">
  									<input type="text" id="{{$item->rowId}}" name="quantity" value="{{$item->qty}}" size="2" style="text-align: center;">
  									<input type="button" value=" + " onclick="up('{{$item->rowId}}')" >
								</form>
							</td>
							<td class="cart_total">
								<p class="cart_total_price" style="margin-top: 20px"><span id="sub{{$item->rowId}}">{{ number_format($item->subtotal, 0, '.','.') . ' VNĐ' }}</span></p>
							</td>
							<td class="cart_delete">
								<a class="cart_quantity_delete delete" href="{{ url('carts/delete/' . $item->rowId) }}"><i class="fa fa-times"></i></a>
							</td>
						</tr>
					@endforeach
						<tr>
							<td class="cart_total" colspan="4" style="text-align: right !important;">
								<p class="cart_total_price" style="color: #666; font-weight: bold;"> Tổng Cộng: </p>
							</td>
							<td>
								<p id="total" class="cart_total_price">{{ Cart::total() . ' VNĐ' }}</p>
							</td>
						</tr>

					</tbody>
				</table>
			</div>
			<div class="total_area">
			<a class="btn btn-default update" href="{{ url('carts/checkout') }}" style="font-size: 150%; float: right; margin-top: 0px"> Check Out </a>
			<a class="btn btn-default check_out" href="" style="font-size: 150%; float: right;margin-top: 0px"> Update </a>
		</div>
		</div>

	</section> <!--/#cart_items-->


	@else
	<section>
		<div class="" style="text-align: center; margin: 10px">
	        <h3 class="">Không có sản phẩm nào trong giỏ hàng</h3>
		        <a href="{{ url('/')}}" class="btn btn-primary btn-lg active" role="button">Tiếp tục mua hàng</a>
	    </div>
	</section>
	@endif
@stop
