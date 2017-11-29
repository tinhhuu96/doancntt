@extends('templates.public.templates_no_lestbar')
@Section('title')
    Checkout | E-Shopper
@stop
@section('content')
<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs" >
            <ol class="breadcrumb" style="margin-bottom: 40px !important">
              <li><a href="#">Home</a></li>
              <li class="active">Check out</li>
            </ol>
        </div><!--/breadcrums-->

        <div class="shopper-informations" >
            <div class="row" style=" margin-bottom: 15px; ">
                <div class="col-sm-6">
                    <div class="shopper-info">
                        <p>Thông tin đặt hàng: </p>
                        <form class="form-horizontal" action="{{ url('carts')}}" method="POST">
                         {{ csrf_field() }}
                            <label for="name_receiver"> Tên </label>
                            <input type="text" id="name_receiver" name="name_receiver" value="{{ Auth::user()->name}}" required>
                            <label for="email">Email </label>
                            <input type="text" id="email" name="email" value="{{ Auth::user()->email}}" required>
                            <label for="address_order"> Địa chỉ</label>
                            <input type="address" id="address_order" name="address_order" value="{{ Auth::user()->address}}" required>
                            <label for="phone"> Điện thoại</label>
                            <input type="tel" id="phone" name="phone"  value="{{ Auth::user()->phone}}" required>
                            <button type="button" class="btn btn-primary"> <a href="{{ url('carts') }}" style="color: #fff">Hủy</a> </button>
                            <button type="submit" class="btn btn-primary"> Đặt hàng </button>
                        </form>

                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
@stop
