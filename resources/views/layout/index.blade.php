@extends('templates.public.templates_index')
@Section('title')
	Home | E-Shopper
@stop
@section('content')
<div class="features_items"><!--features_items-->
	<h2 class="title text-center">Features Items</h2>
	<?php $date = date('Y-m-d');$chieckhau=0;
		function date_formats($str)
        {
            $arNgay = explode(' ', $str);
            $arNgay = explode('-', $arNgay[0]);
            return  $arNgay[0].'-'.$arNgay[1].'-'.$arNgay[2];
        }
	?>
	@foreach( $products as $key => $value )
	<?php
		$discount = 0; 
		$arProduct = DB::table('promo_products')->join('promotions','promo_products.promotion_id','=','promotions.id')->join('products','products.id','=','promo_products.product_id')->select(['promotions.value_km'])->where('promo_products.product_id',$value->id)->get();
		$so = count($arProduct);
		$price = $value->price;
		$slug = str_slug($value->name);
		$created_at = date_formats($value->created_at,'Y-m-d');
		$dates = ( strtotime($date)-strtotime($created_at) );

		
	?>
		@if($value->picture != "")
	    <div class="col-sm-4">
	        <div class="product-image-wrapper">
	            <div class="single-products">
	                <div class="productinfo text-center">
	                    <img src="{{ asset('storage/products/'.$value->picture) }}" style="height: 250px" />
	                    @if( $so >0 )
							<?php 
								$discount = $arProduct[0]->value_km;
								$phantram = 100 - $discount;
								$chieckhau =$phantram/100;
								$chieckhau = $price*$chieckhau;
								$chieckhau = number_format($chieckhau,0,'.','.');
							?>
							<i><strike>$<?php echo number_format($price,0,'.','.') ?></strike></i>
							<h2 style="display: inline;">${{$chieckhau}}</h2>
						@else
							<h2 style="display: inline;">$<?php echo number_format($price,0,'.','.') ?></h2>
	                    @endif
	                    <p>{{ $value->name }}</p>
	                    <a href="javascript:void(0)"  class="btn btn-default add-to-cart add_product" onclick="addCart({{$value->id}})"><i class="fa fa-shopping-cart"></i>Add to cart</a>
	                </div>
	                <div class="product-overlay">
	                    <div class="overlay-content">
	                        @if( $so >0 )
								<?php 
									$discount = $arProduct[0]->value_km;
									$phantram = 100 - $discount;
									$chieckhau =$phantram/100;
									$chieckhau = $price*$chieckhau;
									$chieckhau = number_format($chieckhau,0,'.','.');
								?>
								<i><strike>$<?php echo number_format($price,0,'.','.') ?></strike></i>
								<h2 style="display: inline;">${{$chieckhau}}</h2>
							@else
								<h2 style="display: inline;">$<?php echo number_format($price,0,'.','.') ?></h2>
		                    @endif
	                        <p>{{ $value->name }}</p>
	                        <a href="javascript:void(0)"  class="btn btn-default add-to-cart add_product" onclick="addCart({{$value->id}})"><i class="fa fa-shopping-cart"></i>Add to cart</a>
	                    </div>
	                </div>
	                @if( $dates < 432000)
	                <img src="{{ asset('images/home/new.png') }}" class="new" alt="" />

	                @endif
	                @if( $so > 0)
	                	<img src="{{ asset('images/home/sale.png') }}" class="new" alt="" />
	                @endif
	            </div>
	            <div class="choose">
	                <ul class="nav nav-pills nav-justified">
	                    <li><a href="{{ route('public.product_detail',['slug'=>$slug,'id'=>$value->id]) }}" class="btn btn-yellow"><i class="fa fa-list"></i>View detail</a></li>
	                </ul>
	            </div>
	        </div>
	    </div>
		@endif
    @endforeach
</div><!--features_items-->
<div class="">
	<div class="text-center">
		{{ $products->links() }}
	</div>
	<?php $date = date('Y-m-d'); ?>
	<input type="hidden" id="date" value="{{ $date }}">
</div>
<script type="text/javascript">
	setTimeout(function(){
     	date = $('#date').val();
     	$.ajaxSetup({
	        headers: {
	          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        }
	      });
	      $.ajax({
	        url: "{{route('promotion.disable')}}",
	        type: 'post',
	        data: {date:date},
	        success: function(data){
	         console.log(data);
	       },
	     });
	}, 100);
</script>
@stop
