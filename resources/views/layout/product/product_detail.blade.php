@extends('templates.public.templates')
@section('title')
    {{ $product->name }}
@stop
@section('content')
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
            <img src="{{ asset('storage/products/'.$product->picture) }}" alt="" />
            <h3>ZOOM</h3>
        </div>
    </div>
    <div class="col-sm-7">
        <div class="product-information"><!--/product-information-->
            <img src="{{ asset('images/product-details/new.jpg') }}" class="newarrival" alt="" />
            <h2>{{ $product->name }}</h2>
            <p>Web ID: {{ $product->code}}</p>
            <span>
                <span> $ <?php echo number_format($product->price,0,',','.'); ?> </span>
                <label>Quantity:</label>
                <input type="text" value="0" />
                <button type="button" class="btn btn-fefault cart">
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
<div class="row">
    <div class="col-xs-6">

    </div>
    <div class="" id="" >
        <div class="col-sm-12">
            <ul>
                <li><a href=""><i class="fa fa-calendar-o"></i>{{ $product->created_at }}</a></li>
            </ul>
            <p><strong>Vài nét về sản phẩm:</strong></p>
            <p>{!! $product->detail !!}</p>
        </div>
    </div>
</div>
<div class="category-tab shop-details-tab"><!--category-tab-->
    <div class="col-sm-12">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#reviews" data-toggle="tab">Reviews</a></li>
            <li class=""><a href="#Comments" data-toggle="tab">Comments</a></li>
            <li><a href="#companyprofile" data-toggle="tab">Related products</a></li>
        </ul>
    </div>
    <div class="tab-content">
        <div class="tab-pane fade" id="companyprofile" >
            <div class="col-sm-3">
                <div class="product-image-wrapper">
                    <div class="single-products">
                        <div class="productinfo text-center">
                            <img src="{{ asset('images/home/gallery1.jpg') }}" alt="" />
                            <h2>$56</h2>
                            <p>Easy Polo Black Edition</p>
                            <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="product-image-wrapper">
                    <div class="single-products">
                        <div class="productinfo text-center">
                            <img src="{{ asset('images/home/gallery3.jpg') }}" alt="" />
                            <h2>$56</h2>
                            <p>Easy Polo Black Edition</p>
                            <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="product-image-wrapper">
                    <div class="single-products">
                        <div class="productinfo text-center">
                            <img src="{{ asset('images/home/gallery2.jpg') }}" alt="" />
                            <h2>$56</h2>
                            <p>Easy Polo Black Edition</p>
                            <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="product-image-wrapper">
                    <div class="single-products">
                        <div class="productinfo text-center">
                            <img src="{{ asset('images/home/gallery4.jpg') }}" alt="" />
                            <h2>$56</h2>
                            <p>Easy Polo Black Edition</p>
                            <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="Comments" >
           <div class="">
                <div class="form-group">
                    <label for="">Comment product</label>
                    <div class="col-xs-12" id="commentList">

                    </div>
                </div>
            </div>

            <div class="table tabel-bordered">
                <hr style="color: #bbb;">
                <form action="javascript:void(0)" method="">
                <input type="hidden" value="{{ $product->id }}" id="id_product">
                <input type="hidden" value="0" id="id_user">
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
        </div>
        <div class="tab-pane fade active in" id="reviews" >
            <div class="col-sm-12">
                <ul>
                    <li><a href=""><i class="fa fa-user"></i>EUGEN</a></li>
                    <li><a href=""><i class="fa fa-clock-o"></i>12:41 PM</a></li>
                    <li><a href=""><i class="fa fa-calendar-o"></i>31 DEC 2014</a></li>
                </ul>
                <p>{!! $product->detail !!}</p>
                <p><b>Write Your Review</b></p>
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
        <div class="tab-pane fade in" id="Comment" >
            <div class="col-sm-12">
                <div class="col-sm-offset-1">
                    <div class="form-group">
                        <label for="">Comment product</label>
                        <div class="col-xs-12" id="commentList">

                        </div>
                    </div>
                </div>
            <div class="table tabel-bordered">
                <hr style="color: #bbb;">
                <form action="javascript:void(0)" method="">
                    <input type="hidden" value="{{ $product->id }}" id="id_product">
                    <input type="hidden" value="0" id="id_user">
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
            </div>
        </div>

    </div>
</div><!--/category-tab-->

<div class="recommended_items"><!--recommended_items-->
    <h2 class="title text-center">recommended items</h2>

    <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="item active">
                <div class="col-sm-4">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <img src="{{ asset('images/home/recommend1.jpg') }}" alt="" />
                                <h2>$56</h2>
                                <p>Easy Polo Black Edition</p>
                                <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <img src="{{ asset('images/home/recommend2.jpg') }}" alt="" />
                                <h2>$56</h2>
                                <p>Easy Polo Black Edition</p>
                                <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <img src="{{ asset('images/home/recommend3.jpg') }}" alt="" />
                                <h2>$56</h2>
                                <p>Easy Polo Black Edition</p>
                                <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="col-sm-4">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <img src="{{ asset('images/home/recommend1.jpg') }}" alt="" />
                                <h2>$56</h2>
                                <p>Easy Polo Black Edition</p>
                                <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <img src="{{ asset('images/home/recommend2.jpg') }}" alt="" />
                                <h2>$56</h2>
                                <p>Easy Polo Black Edition</p>
                                <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <img src="{{ asset('images/home/recommend3.jpg') }}" alt="" />
                                <h2>$56</h2>
                                <p>Easy Polo Black Edition</p>
                                <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                            </div>
                        </div>
                    </div>
                </div>
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
