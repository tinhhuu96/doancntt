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
        @if (Auth::check())
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
        @else
            <div class="shopper-informations">
                <div class="row" style=" margin-bottom: 15px; ">
                    <div class="col-sm-6">
                        <div class="shopper-info">
                            <div id="accordion" role="tablist">
                              <div class="card">
                                <div class="card-header btn" style="background-color: #FE980F; width: 300px;" role="tab" id="headingTwo">
                                  <h5 class="mb-0">
                                    <a class="collapsed" data-toggle="collapse" href="#collapseTwo" role="button" aria-expanded="false" aria-controls="collapseTwo" style="color: #fff;">
                                      Mua hàng không qua đăng nhập
                                    </a>
                                  </h5>
                                </div>
                              </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="shopper-informations collapse" id="collapseTwo" role="tabpanel" aria-labelledby="headingTwo" data-parent="#accordion" >
                <div class="row" style=" margin-bottom: 15px; ">
                    <div class="col-sm-6">
                        <div class="shopper-info">
                            <p>Thông tin đặt hàng: </p>
                            <form class="form-horizontal" action="{{ url('carts')}}" method="POST">
                             {{ csrf_field() }}
                                <label for="name_receiver"> Tên </label>
                                <input type="text" id="name_receiver" name="name_receiver" required>
                                <label for="email">Email </label>
                                <input type="text" id="email" name="email" required>
                                <label for="address_order"> Địa chỉ</label>
                                <input type="address" id="address_order" name="address_order" required>
                                <label for="phone"> Điện thoại</label>
                                <input type="tel" id="phone" name="phone" required>
                                <button type="button" class="btn btn-primary"> <a href="{{ url('carts') }}" style="color: #fff">Hủy</a> </button>
                                <button type="submit" class="btn btn-primary"> Đặt hàng </button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="card-header btn" style="background-color: #FE980F; width: 300px;" role="tab" id="headingThree">
              <h5 class="mb-0">
                <a class="collapsed" href="{{ url('/login') }}" style="color: #fff;">
                  Đăng nhập mua hàng
                </a>
              </h5>
            </div>
            <br>
        @endif
      <br>
    </div>
</section>
@stop
