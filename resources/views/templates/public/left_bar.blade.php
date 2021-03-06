<?php 
	use App\Category;
	$categories = Category::all();
?>

<h2>Category</h2>
	<div class="panel-group category-products" id="accordian"><!--category-productsr-->
		@foreach($categories as $key => $value)
			@if($value->parent == 0)
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
						<a data-toggle="collapse" data-parent="#accordian" href="#sportswear-{{ $value->id }}">
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
								<li> <a href="{{ route('public.Product_Cate',['slug'=>str_slug($values->name), 'id'=>$values->id]) }}">{{ $values->name }} </a></li>
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
			<form action="{{ route('public.search.product') }}" method="post">
				{{ csrf_field() }}
				<div class="form-group">
					<label for="">Giá bắt đầu</label>
					<?php 
						$ar = range( 100 ,10000, 100);
					?>
					<select name="price_first" class="form-control" id="pricefirst" onchange="validate1()">
						@foreach($ar as $value)
							<option value="{{ $value }}">{{$value}} $</option>
						@endforeach
					</select>
				</div>
				<div class="form-group">
					<label for="">Đến</label>
					<select name="price_last" class="form-control" id="dateend" onchange="validate2()">
						<option value="0">-- Tất cả ------</option>
						@foreach($ar as $value)
							<option value="{{$value}}">{{$value}} $</option>
						@endforeach
					</select>
				</div>
				<div>
					<button type="submit" class="btn btn-warning">Tìm Kiếm</button>
				</div>
			</form>
		</div>
	</div><!--/price-range-->

	<div class="shipping text-center"><!--shipping-->
		<img src="{{ asset('images/home/shipping.jpg') }}" alt="" />
	</div><!--/shipping-->
	<script type="text/javascript">
		
	</script>