<?php 
	use App\Category;
	$categories = Category::where('id','>',1)->get();
?>

<h2>Category</h2>
	<div class="panel-group category-products" id="accordian"><!--category-productsr-->
		@foreach($categories as $key => $value)
			@if($value->parent == 0)
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
						<a data-toggle="collapse" data-parent="#accordian" href="#sportswear-{{ $value->id }}"><i class="fa fa-long-arrow-right"></i>
							<span class="badge pull-right"><i class="fa fa-plus"></i></span>
							{{ $value->name }}
						</a>
					</h4>
				</div>
				@foreach( $categories as $keys => $values)
					@if( $values->parent == $value->id)
					<div id="sportswear-{{ $value->id }}" class="panel-collapse collapse">
						<div class="panel-body">
							<ul>
								<li><i class="fa fa-long-arrow-right"></i> <a href="{{ route('public.Product_Cate',['slug'=>str_slug($values->name),'id'=>$values->id]) }}">{{ $values->name }} </a></li>
							</ul>
						</div>
					</div>
					@endif
				@endforeach
			</div>
			@else
			@endif
		@endforeach
	</div><!--/category-products-->
	<div class="price-range"><!--price-range-->
		<h2>Price Range</h2>
		<div class="well text-center">
			 <input type="text" class="span2" onchange="" value="" data-slider-min="0" data-slider-max="600" data-slider-step="5" data-slider-value="[250,450]" id="sl2" ><br />
			 <b class="pull-left">$ 0</b> <b class="pull-right">$ 600</b>
		</div>
	</div><!--/price-range-->

	<div class="shipping text-center"><!--shipping-->
		<img src="{{ asset('images/home/shipping.jpg') }}" alt="" />
	</div><!--/shipping-->

	@section('script')
		
		<script type="text/javascript">
			function price_range()
			{
				alert(123);
			}
		</script>
	@stop
