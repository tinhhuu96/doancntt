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
			<form action="{{ route('public.search.product') }}" method="post">
				{{ csrf_field() }}
				<div class="form-group">
					<label for="">Giá Từ</label>
					<?php 
						$ar = range( 1000 ,10000, 500)
					?>
					<select name="price_first" class="form-control">
						@foreach($ar as $value)
							<option value="{{ $value }}"><?php echo number_format ( $value , 3 , '.' ,"." ).' vnđ' ?></option>
						@endforeach
					</select>
				</div>
				<div class="form-group">
					<label for="">Giá Từ</label>
					<select name="price_last" class="form-control">
						@foreach($ar as $value)
							<option value="{{$value}}"><?php echo number_format ( $value , 3 , '.' ,"." ).' vnđ' ?></option>
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