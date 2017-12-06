<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/prettyPhoto.css') }}" rel="stylesheet">
    <link href="{{ asset('css/price-range.css') }}" rel="stylesheet">
    <link href="{{ asset('css/animate.css') }}" rel="stylesheet">
		<link href="{{ asset('css/main.css') }}" rel="stylesheet">
		<link href="{{ asset('css/responsive.css') }}" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
    <link rel="shortcut icon" href="{{ asset('public') }}/images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{ $publicurl }}/images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{ $publicurl }}/images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{ $publicurl }}/images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="{{ $publicurl }}/images/ico/apple-touch-icon-57-precomposed.png">
    <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
</head><!--/head-->

<body>
  {!! Toastr::render() !!}
	<?php
		use App\Category;
		$category = Category::where('parent','=',0)->get();
	?>
  <div class="btn btn-default"  style="position: fixed; top: 70px; right: 5px; background-color: #FE980F">
  @if ( Cart::count() > 0 )
    <a id="cart" href="{{ url('carts')}}"><i class="fa fa-shopping-cart"></i><span id="count"> ({{ Cart::count() }})</span></a>
  @else
    <a id="cart" href="{{ url('carts')}}" ><i class="fa fa-shopping-cart"></i><span id="count"></span></a>
  @endif
</div>
	<header id="header"><!--header-->
		<div class="header_top"><!--header_top-->
			<div class="container">
				<div class="row">
					<div class="col-sm-6">
						<div class="contactinfo">
							<ul class="nav nav-pills">
								<li><a href="#"><i class="fa fa-phone"></i> +841675259202</a></li>
								<li><a href="#"><i class="fa fa-envelope"></i> Shops@gmail.com</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="social-icons pull-right">
							<ul class="nav navbar-nav">
								<li><a href="#"><i class="fa fa-facebook"></i></a></li>
								<li><a href="#"><i class="fa fa-twitter"></i></a></li>
								<li><a href="#"><i class="fa fa-linkedin"></i></a></li>
								<li><a href="#"><i class="fa fa-dribbble"></i></a></li>
								<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header_top-->

		<div class="header-middle"><!--header-middle-->
			<div class="container">
				<div class="row">
					<div class="col-sm-4">
						<div class="logo pull-left">
							<a href="{{ route('public.index') }}"><img src="{{ asset('images/home/logo.png') }}" alt="" /></a>
						</div>
					</div>
					<div class="col-sm-8">
						<div class="shop-menu pull-right">
							<ul class="nav navbar-nav">
								@if (Auth::check())
                  @if(Auth::user()->is_admin == 1)
                  <li>
                    <a href="{{url('/admin')}}"><i class="fa fa-unlock-alt" aria-hidden="true"></i> Admin</a>
                  </li>
                  @endif
                <li>
                  <a href="{{ url('carts/manage')}}"><i class="fa fa-check-square-o" aria-hidden="true"></i> Quản lý đơn hàng</a>
                </li>
                <li>
                  <a href="#" ></a>
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-user"></i>
                                      {{ Auth::user()->name }} <span class="caret"></span>
                                  </a>
                                  <ul class="dropdown-menu" style="min-width: 110px;">
                                    <li><a href="{{ url('/user')}}">Xem Profile</li></a>
                                    <li><a href="{{ url('/change-password')}}">Đổi mật khẩu</a></li>
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                      </li>
                                    </ul>
                </li>

                @else
                <li><a href="{{ url('login') }}"><i class="fa fa-user" aria-hidden="true"></i> Đăng Nhập</a></li>
                <li><a href="{{ url('register') }}"><i class="fa fa-lock"></i> Đăng Ký</a></li>
                @endif
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-middle-->

		<div class="header-bottom"><!--header-bottom-->
			<div class="container">
				<div class="row">
					<div class="col-sm-9">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>
						<div class="mainmenu pull-left">
							<ul class="nav navbar-nav collapse navbar-collapse">
								<li><a href="{{ route('public.index') }}" class="active">Home</a></li>

								@foreach( $category as $key => $value)
									@if( $value->parent == 0 )
									<li><a href="{{ route('public.Product_Cate',['slug'=>str_slug($value->name),'id'=>$value->id]) }}">{{ $value->name }}</a></li>
									@endif
								@endforeach
								<li><a href="{{ route('public.products') }}">Products News </a></li>
								<li><a href="{{ route('public.contact') }}">Contact</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="search_box pull-right">
							<input type="text" placeholder="Search"/>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-bottom-->
	</header><!--/header-->
