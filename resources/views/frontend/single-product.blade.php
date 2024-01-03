@extends('frontend.layout.main')
@section('main-section')

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="../assets/img/breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>{{$product->pro_name ?? ''}}</h2>
                        <div class="breadcrumb__option">
                            <a href="{{route('Home')}}">Home</a>
                            <a href="./index.html">Vegetables</a>
                            <span>{{$product->pro_name ?? ''}}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->
        <br>
        @include('frontend.layout.message')
    <!-- Product Details Section Begin -->
    <section class="product-details spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__pic">
                        <div class="product__details__pic__item">
                            <img class="product__details__pic__item--large"
                                src="../../{{$product->image_path ?? ''}}" alt="">
                        </div>
                        <div class="product__details__pic__slider owl-carousel">
                            <img data-imgbigurl="../assets/img/product/details/product-details-2.jpg"
                                src="../assets/img/product/details/thumb-1.jpg" alt="">
                            <img data-imgbigurl="../assets/img/product/details/product-details-3.jpg"
                                src="../assets/img/product/details/thumb-2.jpg" alt="">
                            <img data-imgbigurl="../assets/img/product/details/product-details-5.jpg"
                                src="../assets/img/product/details/thumb-3.jpg" alt="">
                            <img data-imgbigurl="../assets/img/product/details/product-details-4.jpg"
                                src="../assets/img/product/details/thumb-4.jpg" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__text">
                        <h3>{{$product->pro_name ?? ''}}</h3>
                        <div class="product__details__rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star-half-o"></i>
                            <span>(18 reviews)</span>
                        </div>
                        <div class="product__details__price">{{$product->discount_price ?? $product->orginal_price}} BDT</div>
                        <p>@php echo Str::words($product->content,50);; @endphp </p>
                        <div class="product__details__quantity">
                            <form action="{{route('Single Cart')}}" method="post">
                                @csrf
                                <div class="quantity">
                                    <div class="pro-qty">
                                        <input name="quantity" type="text" value="1">
                                    </div>
                                </div>
                            </div>
                            <input name="product_id" type="number" value="{{$product->id}}" hidden>
                            <input name="pro_name" type="text" value="{{$product->pro_name}}" hidden>
                            <input name="price" type="number" value="{{$product->discount_price ?? $product->orginal_price}}" hidden>
                            <input type="submit" class="primary-btn" value="ADD TO CART">
                            </form>
                        <a href="#" class="heart-icon"><span class="icon_heart_alt"></span></a>
                        <ul>
                            <li><b>Availability</b> <span>{{$product->availability ?? ''}}</span></li>
                            <li><b>Shipping</b> <span>{{$product->shipping ?? ''}} days</span></li>
                            <li><b>Weight</b> <span>{{$product->weight ?? ''}} kg</span></li>
                            <li><b>Share on {{$product->id}}</b>
                                <div class="share">
                                    <a href="#"><i class="fa fa-facebook"></i></a>
                                    <a href="#"><i class="fa fa-twitter"></i></a>
                                    <a href="#"><i class="fa fa-instagram"></i></a>
                                    <a href="#"><i class="fa fa-pinterest"></i></a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="product__details__tab">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab"
                                    aria-selected="true">Description</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab"
                                    aria-selected="false">Information</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab"
                                    aria-selected="false">Reviews <span>(1)</span></a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tabs-1" role="tabpanel">
                                <div class="product__details__tab__desc">
                                    <h6>Products Description</h6>
                                    <p>@php echo Str::words($product->description);; @endphp </p>
                                </div>
                            </div>
                            <div class="tab-pane" id="tabs-2" role="tabpanel">
                                <div class="product__details__tab__desc">
                                    <h6>Products Infomation</h6>
                                    <p>@php echo Str::words($product->information,15);; @endphp </p>
                                </div>
                            </div>
                            <div class="tab-pane" id="tabs-3" role="tabpanel">
                                <div class="product__details__tab__desc">
                                    <h6>Reviews</h6>
                                    <p>No Reviews yet</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Product Details Section End -->

    <!-- Related Product Section Begin -->
    <section class="related-product">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title related__product__title">
                        <h2>Related Product</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @if ($products->count() > 0)
                    @foreach ($products as $product)
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="product__item">
                            <div class="product__item__pic set-bg" data-setbg="../../{{$product->image_path}}">
                                <ul class="product__item__pic__hover">
                                    <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                    <li><a href="../product/{{$product->slug}}"><i class="fa fa-retweet"></i></a></li>
                                    <li><a href="../add-cart/{{$product->id}}"><i class="fa fa-shopping-cart"></i></a></li>
                                </ul>
                            </div>
                            <div class="product__item__text">
                                <h6><a href="#">{{$product->pro_name}}</a></h6>
                                <h5>{{$product->discount_price ?? $product->orginal_price}} BDT</h5>
                            </div>
                        </div>
                    </div>
                    @endforeach
                @endif
            </div>
        </div>
    </section>
    <!-- Related Product Section End -->

@endsection
