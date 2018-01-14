@extends('templates.public.templates')
@section('title')
    view - {{ $product->name }}
@stop
@section('content')
<?php $date = date('Y-m-d');$chieckhau=0;
        function date_formats($str)
        {
            $arNgay = explode(' ', $str);
            $arNgay = explode('-', $arNgay[0]);
            return  $arNgay[0].'-'.$arNgay[1].'-'.$arNgay[2];
        }
        function ham_dao_nguoc_date($str)
        {
            //tách mảng bằng dấu cách
            $arStr = explode(' ',$str);
            $arNgay = explode('-', $arStr[0]);
            return  $arNgay[2].'-'.$arNgay[1].'-'.$arNgay[0];
        }


        $discount = 0;
        $arProduct = DB::table('promo_products')
        ->join('promotions','promo_products.promotion_id','=','promotions.id')
        ->join('products','products.id','=','promo_products.product_id')
        ->join('calculations','calculations.id','=','promotions.calculation_id')
        ->where('promo_products.product_id',$product->id)->get();
        $so = count($arProduct);
        if ($so > 0) {
            $active = $arProduct[0]->active;
            $unit   = $arProduct[0]->unit;
        }else{
            $active = 0;
        }
        $price = $product->price;

    ?>
<div class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Thông báo</h5>
      </div>
      <div class="modal-body bg-success">
        <p></p>
      </div>
    </div>
  </div>
</div>

<div class="product-details"><!--product-details-->
    <div class="col-sm-5">
        <div class="view-product">
            <img class="thumbnail" src="{{ asset('storage/products/'.$product->picture) }}" alt="" />
        </div>
    </div>
    <div class="col-sm-7">
        <div class="product-information"><!--/product-information-->
            <?php
                $created_at = date_formats($product->created_at,"Y-m-d");;
                $dates = ( strtotime($date)-strtotime($created_at) );
            ?>
             @if( $dates < 432000)
            <img src="{{ asset('images/product-details/new.jpg') }}" class="newarrival" alt="" />
            @endif
            <h2>{{ $product->name }}</h2>
            <p>Web ID: {{ $product->code}}</p>
            <span>
                @if( $active == 1 )
                    @if( $unit == '%')
                        <?php
                            $discount = $arProduct[0]->value_km;
                            $phantram = 100 - $discount;
                            $chieckhau =$phantram/100;
                            $chieckhau = $price*$chieckhau;
                            $chieckhau = number_format($chieckhau,0,'.','.');
                        ?>
                           <i><strike>$<?php echo number_format($price,0,'.','.') ?></strike></i> <br>
                           <span>${{$chieckhau}}</span>
                    @else
                        <?php
                            $chieckhau = $price-$arProduct[0]->value_km;
                            $chieckhau = number_format($chieckhau,0,'.','.');

                         ?>
                         <i><strike>$<?php echo number_format($price,0,'.','.') ?></strike></i> <br>
                           <span>${{$chieckhau}}</span>
                    @endif
                @else
                    <?php $chieckhau = $price  ?>
                    <span>$<?php echo number_format($price,0,'.','.') ?></span>
                @endif
                <label>Quantity:</label>
                <input type="text" value="1" />
                <button type="button" onclick="addCart({{$product->id}},{{$chieckhau}})" class="btn btn-fefault cart">
                    <i class="fa fa-shopping-cart"></i>
                    Add to cart
                </button>
            </span>
            <p><b>Availability:</b> In Stock</p>
            <p><b>Condition:</b> New</p>
            <p><b>Brand:</b> E-SHOPPER</p>
            <a href=""><img src="{{ asset('images/product-details/share.png') }}" class="share img-responsive"  alt="" /></a>
        </div><!--/product-information-->
    </div>
</div><!--/product-details-->

<div class="category-tab shop-details-tab"><!--category-tab-->
    <div class="col-sm-12">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#reviews" data-toggle="tab">Reviews</a></li>
            <li class=""><a href="#Comments" data-toggle="tab">Comments</a></li>
            <li><a href="#companyprofile" data-toggle="tab">Information product</a></li>
        </ul>
    </div>
    <div class="tab-content">
        <div class="tab-pane fade" id="companyprofile" >
            <div class="">
                {!! $product->detail !!}
            </div>

        </div>
        <div class="tab-pane fade" id="Comments" >
           <div class="">
                <div class="form-group">
                    <div class="col-xs-12" id="commentList">

                    </div>
                </div>
            </div>
            <input type="hidden" value="{{ $product->id }}" id="id_product">
            <input type="hidden" value="{{Auth::user()->id}}" id="id_user">
            @if(Auth::user() != "")
            <div class="table tabel-bordered">
                <hr style="color: #bbb;">
                <form action="javascript:void(0)" method="">
                <div class="row">
                    <div class="form-group">
                        <div class="col-xs-2" style="width: 10.666667% !important;">
                            <img src="{{ asset('images/logo/avata.png') }}" alt="" style="width: 80px ; height: 80px; display: inline;"/>
                        </div>
                        <div class="col-xs-8">
                            <label for="">Bình luận</label>
                            <input type="text" id="content" class="form-control" placeholder="comment..." style=""/>
                        </div>
                    </div>
                </div>
                <div class="row col-xs-10">
                    <div class="form-group text-right">
                        <a href="javascript:void(0)" onclick="addComment()" class="btn btn-success">Comment</a>
                    </div>
                </div>
            </form>
            </div>
            @else
            <div class="col-xs-offset-1">
                <label for=""> Mời bạn đăng nhập để được bình luận !</label>
            </div>
            @endif
        </div>
        <div class="tab-pane fade active in" id="reviews" >
            <div class="col-sm-12">
                <h4>Thông số</h4>
                <table class="table table-bordered">
                    <tr>
                        <th>
                            Tên Thông số
                        </th>
                        <th>
                            Giá Trị
                        </th>
                    </tr>
                    <tr>
                        @foreach( $parameters as $key => $value )
                            <tr>
                                <td>{{ $value->parameter->name}}</td>
                                <td>{{ $value->content}}</td>
                            </tr>
                        @endforeach
                    </tr>
                </table>
            </div>
        </div>

    </div>
</div><!--/category-tab-->

<div class="recommended_items"><!--recommended_items-->
    <h2 class="title text-center">recommended items</h2>

    <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="item active">
                @foreach( $products as $value )
                <?php
                    $price = number_format($value->price,0,'.','.');
                    $slug = str_slug($value->name);

                ?>
                @if($value->picture != "")
                <div class="col-sm-4">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <img src="{{ asset('storage/products/'.$value->picture) }}" alt="{{ $value->name}}" />
                                <h2>$ {{ $price }}</h2>
                                <a href="javascript:void(0)" onclick="addCart({{$value->id}})" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @endforeach
            </div>
            <div class="item">
                @foreach( $products as $value )
                <?php
                    $price = number_format($value->price,0,'.','.');
                    $slug = str_slug($value->name);

                ?>
                @if($value->picture != "")
                <div class="col-sm-4">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <img src="{{ asset('storage/products/'.$value->picture) }}" alt="{{ $value->name}}" />
                                <h2>$ {{ $price }}</h2>
                                <a href="javascript:void(0)" onclick="addCart({{$value->id}})" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @endforeach
            </div>
        </div>
            <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
            <i class="fa fa-angle-left"></i>
            </a>
            <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
            <i class="fa fa-angle-right"></i>
            </a>
    </div>
</div><!--/recommended_items-->
@section('script')
    <script type="text/javascript">
        function addComment()
        {
            var id_product = $('#id_product').val();
            var id_user = $('#id_user').val();
            var content = $('#content').val();
            $.ajaxSetup({
                headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{route('public.ajax.Addcomment')}}",
                type: 'post',
                data: {aid_product: id_product, aid_user:id_user, acontent:content},
                success: function(data){
                    $('.modal-body').html(data);
                    $('.modal').css({display:'block', transition:'0.3 all'});
                    setTimeout(function(){ $('.modal').fadeOut() }, 500);
                    $('#content').val("");
                },
                error: function (){
                    alert('Có lỗi xảy ra');
                }
            });
        }
        $(function(){
             function getComments(){
                setTimeout(function(){
                    var a = $('#id_product').val();
                    $.ajaxSetup({
                        headers: {
                          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                      });
                    $.ajax({
                        url: "{{route('public.ajax.getComment')}}",
                        type: 'post',
                        data: {aid:a},
                        success: function(data){
                           $('#commentList').html(data);
                        },
                        complete: getComments
                    });
                },50);
            };
            getComments();
        })
    </script>
@stop
@stop
