@include('templates.public.header')
	<section id="advertisement">
		<div class="container">
			<img src="{{ $publicurl }}/images/shop/advertisement.jpg" alt="" />
		</div>
	</section>
	<section>
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
					<div class="left-sidebar">
						@include('templates.public.left_bar')
					</div>
				</div>
				<div class="col-sm-9 padding-right">
					  @yield('content')
				</div>
			</div>
		</div>
	</section>
@include('templates.public.footer')