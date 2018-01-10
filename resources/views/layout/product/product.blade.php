@extends('templates.public.templates_index')
@Section('title')
    sản phẩm - {{ $name }}
@stop
@section('content')
<?php $date = date('Y-m-d');$chieckhau=0;
    function date_formats($str)
        {
            $arNgay = explode(' ', $str);
            $arNgay = explode('-', $arNgay[0]);
            return  $arNgay[0].'-'.$arNgay[1].'-'.$arNgay[2];
        }
    ?>
<div class="features_items"><!--features_items-->
    <h2 class="title text-center">Features Items</h2>
    @foreach( $products as $key => $value )
    <?php
        $discount = 0;
        $arProduct = DB::table('promo_products')->join('promotions','promo_products.promotion_id','=','promotions.id')->join('products','products.id','=','promo_products.product_id')->select(['promotions.value_km','promotions.active'])->where('promo_products.product_id',$value->id)->get();
        $so = count($arProduct);
        if ($so > 0) {
            $active = $arProduct[0]->active;
        }else{
            $active = 0;
        }
        $price = $value->price;
        $slug = str_slug($value->name);
        $created_at = date_formats($value->created_at,"Y-m-d");
        $dates = ( strtotime($date)-strtotime($created_at) );

    ?>
        @if($value->picture != "")
        <div class="col-sm-4">
            <div class="product-image-wrapper">
                <div class="single-products">
                    <div class="productinfo text-center">
                        <img src="{{ asset('storage/products/'.$value->picture) }}" style="height: 250px" />
                        @if( $active == 1 )
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
                            @if( $active == 1 )
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
                    @if( $active == 1)
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
<div class="row text-center">
    <ul class="pagination">
       {{ $products->links() }}
    </ul>
</div>


@stop
