@extends('frontend.layout.main')
@section('main-section')

    <!-- Categories Section Begin -->
    <section class="categories">
        <div class="container">
            <div class="row">
                <div class="categories__slider owl-carousel">
                    @if (count($productCategories) > 0)
                        @foreach ($productCategories as $productCategory)
                        <div class="col-lg-3">
                            <div class="categories__item set-bg" data-setbg="../storage/image/{{$productCategory->pimage_path}}">
                                <h5><a href="../catgory/{{$productCategory->purl}}">{{$productCategory->pname}}</a></h5>
                            </div>
                        </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </section>
    <!-- Categories Section End -->

    <!-- Featured Section Begin -->
    <section class="featured spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Featured Product</h2>
                    </div>
                    <div class="featured__controls">
                        <ul>
                            <li class="active" data-filter="*">All</li>
                            <li data-filter=".oranges">Oranges</li>
                            <li data-filter=".fresh-meat">Fresh Meat</li>
                            <li data-filter=".vegetables">Vegetables</li>
                            <li data-filter=".fastfood">Fastfood</li>
                        </ul>
                    </div>
                </div>
            </div>
            @include('frontend.layout.message')
            <div class="row featured__filter">

            @if (count($products) > 0)
            @foreach ($products as $product)

            <div class="col-lg-3 col-md-4 col-sm-6 mix oranges fresh-meat">
                <div class="featured__item">
                    <div class="featured__item__pic set-bg" data-setbg="../storage/image/{{$product->image_path}}">
                        <ul class="featured__item__pic__hover">
                            <li><a href="#"><i class="fa fa-heart"></i></a></li>
                            <li><a href="../product/{{$product->slug}}"><i class="fa fa-retweet"></i></a></li>
                            <li><a href="../add-cart/{{$product->id}}"><i class="fa fa-shopping-cart"></i></a></li>
                        </ul>
                    </div>
                    <div class="featured__item__text">
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
    <!-- Featured Section End -->

    <!-- Banner Begin -->
    <div class="banner">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="banner__pic">
                        <img src="../assets/img/banner/banner-1.jpg" alt="">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="banner__pic">
                        <img src="../assets/img/banner/banner-2.jpg" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Banner End -->
    @php $i = 1; @endphp

    <!-- Latest Product Section Begin -->
    <section class="latest-product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="latest-product__text">
                        <h4>Latest Products</h4> @php $counter = 0; @endphp
                        <div class="latest-product__slider owl-carousel">
                                @if (count($latest_Products) > 0)
                                <div class="latest-prdouct__slider__item">
                                     @foreach ($latest_Products as $latest_Product)
                                        <a href="../product/{{$latest_Product->slug}}" class="latest-product__item">
                                            <div class="latest-product__item__pic">
                                                <img src="../storage/image/{{$latest_Product->image_path}}" alt="">
                                            </div>
                                            <div class="latest-product__item__text">
                                                <h6>{{$latest_Product->pro_name}}</h6>
                                                <span>{{$latest_Product->discount_price ?? $latest_Product->orginal_price}} BDT</span>
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                                @endif
                                @if (count($latest_Productsx) > 0)
                                <div class="latest-prdouct__slider__item">
                                     @foreach ($latest_Productsx as $latest_Productx)
                                        <a href="../product/{{$latest_Productx->slug}}" class="latest-product__item">
                                            <div class="latest-product__item__pic">
                                                <img src="../storage/image/{{$latest_Productx->image_path}}" alt="">
                                            </div>
                                            <div class="latest-product__item__text">
                                                <h6>{{$latest_Productx->pro_name}}</h6>
                                                <span>{{$latest_Productx->discount_price ?? $latest_Productx->orginal_price}} BDT</span>
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                                @endif
                                @if (count($latest_Productsy) > 0)
                                <div class="latest-prdouct__slider__item">
                                     @foreach ($latest_Productsy as $latest_Productx)
                                        <a href="../product/{{$latest_Productx->slug}}" class="latest-product__item">
                                            <div class="latest-product__item__pic">
                                                <img src="../storage/image/{{$latest_Productx->image_path}}" alt="">
                                            </div>
                                            <div class="latest-product__item__text">
                                                <h6>{{$latest_Productx->pro_name}}</h6>
                                                <span>{{$latest_Productx->discount_price ?? $latest_Productx->orginal_price}} BDT</span>
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                                @endif


                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="latest-product__text">
                        <h4>Top Rated Products</h4>
                        <div class="latest-product__slider owl-carousel">
                            @if (count($latest_Products) > 0)
                            <div class="latest-prdouct__slider__item">
                                 @foreach ($latest_Products as $latest_Product)
                                    <a href="../product/{{$latest_Product->slug}}" class="latest-product__item">
                                        <div class="latest-product__item__pic">
                                            <img src="../storage/image/{{$latest_Product->image_path}}" alt="">
                                        </div>
                                        <div class="latest-product__item__text">
                                            <h6>{{$latest_Product->pro_name}}</h6>
                                            <span>{{$latest_Product->discount_price ?? $latest_Product->orginal_price}} BDT</span>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                            @endif
                            @if (count($latest_Productsx) > 0)
                            <div class="latest-prdouct__slider__item">
                                 @foreach ($latest_Productsx as $latest_Productx)
                                    <a href="../product/{{$latest_Productx->slug}}" class="latest-product__item">
                                        <div class="latest-product__item__pic">
                                            <img src="../storage/image/{{$latest_Productx->image_path}}" alt="">
                                        </div>
                                        <div class="latest-product__item__text">
                                            <h6>{{$latest_Productx->pro_name}}</h6>
                                            <span>{{$latest_Productx->discount_price ?? $latest_Productx->orginal_price}} BDT</span>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                            @endif
                            @if (count($latest_Productsy) > 0)
                            <div class="latest-prdouct__slider__item">
                                 @foreach ($latest_Productsy as $latest_Productx)
                                    <a href="../product/{{$latest_Productx->slug}}" class="latest-product__item">
                                        <div class="latest-product__item__pic">
                                            <img src="../storage/image/{{$latest_Productx->image_path}}" alt="">
                                        </div>
                                        <div class="latest-product__item__text">
                                            <h6>{{$latest_Productx->pro_name}}</h6>
                                            <span>{{$latest_Productx->discount_price ?? $latest_Productx->orginal_price}} BDT</span>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                            @endif

                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="latest-product__text">
                        <h4>Review Products</h4>
                        <div class="latest-product__slider owl-carousel">
                            @if (count($latest_Products) > 0)
                            <div class="latest-prdouct__slider__item">
                                 @foreach ($latest_Products as $latest_Product)
                                    <a href="../product/{{$latest_Product->slug}}" class="latest-product__item">
                                        <div class="latest-product__item__pic">
                                            <img src="../storage/image/{{$latest_Product->image_path}}" alt="">
                                        </div>
                                        <div class="latest-product__item__text">
                                            <h6>{{$latest_Product->pro_name}}</h6>
                                            <span>{{$latest_Product->discount_price ?? $latest_Product->orginal_price}} BDT</span>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                            @endif
                            @if (count($latest_Productsx) > 0)
                            <div class="latest-prdouct__slider__item">
                                 @foreach ($latest_Productsx as $latest_Productx)
                                    <a href="../product/{{$latest_Productx->slug}}" class="latest-product__item">
                                        <div class="latest-product__item__pic">
                                            <img src="../storage/image/{{$latest_Productx->image_path}}" alt="">
                                        </div>
                                        <div class="latest-product__item__text">
                                            <h6>{{$latest_Productx->pro_name}}</h6>
                                            <span>{{$latest_Productx->discount_price ?? $latest_Productx->orginal_price}} BDT</span>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                            @endif
                            @if (count($latest_Productsy) > 0)
                            <div class="latest-prdouct__slider__item">
                                 @foreach ($latest_Productsy as $latest_Productx)
                                    <a href="../product/{{$latest_Productx->slug}}" class="latest-product__item">
                                        <div class="latest-product__item__pic">
                                            <img src="../storage/image/{{$latest_Productx->image_path}}" alt="">
                                        </div>
                                        <div class="latest-product__item__text">
                                            <h6>{{$latest_Productx->pro_name}}</h6>
                                            <span>{{$latest_Productx->discount_price ?? $latest_Productx->orginal_price}} BDT</span>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                            @endif

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Latest Product Section End -->

    <!-- Blog Section Begin -->
    <section class="from-blog spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title from-blog__title">
                        <h2>From The Blog</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @if (count($posts_latest) > 0)
                    @foreach ($posts_latest as $post_latest)
                    <div class="col-lg-4 col-md-4 col-sm-6">
                        <div class="blog__item">
                            <div class="blog__item__pic">
                                <img src="../storage/image/{{$post_latest->image_path}}" alt="" height="200px">
                            </div>
                            <div class="blog__item__text">
                                <ul>
                                    <li><i class="fa fa-calendar-o"></i>{{$post_latest->created_at->format('j F, Y')}}</li>
                                    <li><i class="fa fa-comment-o"></i> 5</li>
                                </ul>
                                <h5><a href="../blog/{{$post_latest->slug}}">{{$post_latest->title}}</a></h5>
                                <p>@php echo Str::words($post_latest->content,15); @endphp  </p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                @endif

            </div>
        </div>
    </section>
    <!-- Blog Section End -->

@endsection
