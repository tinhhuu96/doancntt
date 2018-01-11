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
				  <li><a href="{{ url('/carts/manage') }}">Order</a></li>
				</ol>
		</div>
		 <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title" style="float: left;">List Orders</h3>
              <a href="{{ url('carts/manage/export')}}" class="btn btn-success" style="float: right;"> Export Excel</a>
            </div>
            <!-- /.box-header -->
           <div class="box-body">
           	<table  id="example2" class="table table-striped table-hover">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Order Date</th>
                  <th>Status</th>
                  <th>Address</th>
                  <th>Phone</th>
                  <th>Recipient Name</th>
                  <th>Sender Name</th>
                  <th>Cancel Order</th>
                  <th>View Details</th>
                </tr>
                </thead>
                <tbody>
	                @foreach ($orders as $order)
		             <tr>
		                  <td>{{ $order ->id}}</td>
		                  <td>{{ $order ->created_at}}</td>
                      @if ($order->status == 'pending' || $order->status == 'processing')
                        <td><span class="label label-warning">{{ $order ->status }}</span></td>
                      @elseif ($order->status == 'shipping')
                        <td><span class="label label-primary">{{ $order ->status }}</span></td>
                      @elseif ($order->status == 'shipped')
                        <td><span class="label label-success">{{ $order ->status }}</span></td>
                      @else
		                    <td><span class="label label-danger">{{ $order ->status }}</span></td>
                      @endif
		                  <td>{{ $order ->address}}</td>
		                  <td>{{ $order ->phone}}</td>
		                  <td>{{ $order ->name}}</td>
		                  <td>
                        <?php $user = App\User::find($order->user_id); ?>
                        @if ($user)
                          {{ $user['name'] }}
                        @else
                          undefind
                        @endif
                      </td>
		                  @if( $order->status == 'pending' || $order->status == 'processing')
		                  <td style="text-align: center;">
			                  <a href="{{ url('carts/manage/' . $order->id . '/cancel')}}">
			                  	Hủy
			                  </a>
			              </td>
		                  @else
		                  <td style="text-align: center; vertical-align: middle; color: red">Undefind</td>
		                  @endif
		                  <td><a href="{{ url('carts/manage/' . $order->id .'/detail') }}">View Details</a></td>
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
