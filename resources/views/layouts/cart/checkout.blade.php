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
        <div class="shopper-informations">
            <div class="row" style=" margin-bottom: 15px; ">
                <div class="col-sm-6">
                    <div class="shopper-info">
                        <label>chọn cách mua hàng</label>
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
        <hr>
        <div class="card-header btn" style="background-color: #FE980F; width: 300px;" role="tab" id="headingThree">
          <h5 class="mb-0">
            <a class="collapsed" data-toggle="collapse" href="#collapseThree" role="button" aria-expanded="false" aria-controls="collapseThree" style="color: #fff;">
              Đăng nhập mua hàng
            </a>
          </h5>
        </div>
        <br>
        <div id="collapseThree" class="collapse" role="tabpanel" aria-labelledby="headingThree" data-parent="#accordion">
           <div class="row">
                <div class="col-md-10 col-md-offset-2" style="margin-left: 0px !important">
                    <div class="panel panel-default">
                        <div class="panel-heading">Login</div>

                        <div class="panel-body">
                            <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                                {{ csrf_field() }}

                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                                    <div class="col-md-6">
                                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                        @if ($errors->has('email'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                    <label for="password" class="col-md-4 control-label">Password</label>

                                    <div class="col-md-6">
                                        <input id="password" type="password" class="form-control" name="password" required>

                                        @if ($errors->has('password'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-4">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-8 col-md-offset-4">
                                        <button type="submit" class="btn btn-primary">
                                            Login
                                        </button>

                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            Forgot Your Password?
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
      </div>
      <br>
    </div>
</section>
@stop
