 <!-- Hero Section Begin -->
 <section class="hero
 @if (Route::is('Home'))
        ''
     @else
         hero-normal
    @endif
 ">
     <div class="container">
         <div class="row">
             <div class="col-lg-3">
                 <div class="hero__categories">
                     <div class="hero__categories__all">
                         <i class="fa fa-bars"></i>
                         <span>All departments</span>
                     </div>
                     @if (count($productCategories) > 0)
                     <ul>
                        @foreach ($productCategories as $productCategory)
                        <li><a href="../category/{{$productCategory->purl}}">{{$productCategory->pname}}</a></li>
                        @endforeach

                     </ul>
                     @endif
                 </div>
             </div>
             <div class="col-lg-9">
                 <div class="hero__search">
                     <div class="hero__search__form">
                         <form action="{{route('Search Result')}}">
                             <div class="hero__search__categories">
                                 All Categories
                                 {{-- <span class="arrow_carrot-down"></span> --}}
                             </div>
                             <input type="text" name="product_name" placeholder="What do yo u need?">
                             <button type="submit" class="site-btn">SEARCH</button>
                         </form>
                     </div>
                     <div class="hero__search__phone">
                         <div class="hero__search__phone__icon">
                             <i class="fa fa-phone"></i>
                         </div>
                         <div class="hero__search__phone__text">
                             <h5>@php try { echo "+".$settings->phone_no;} catch (\Exception $e) {echo "+0123456789";}@endphp</h5>
                             <span>support 24/7 time</span>
                         </div>
                     </div>
                 </div>
                 @if (Route::is('Home'))
                 <div class="hero__item set-bg" data-setbg="../assets/img/hero/banner.jpg">
                     <div class="hero__text">
                         <span>FRUIT FRESH</span>
                         <h2>Vegetable <br />100% Organic</h2>
                         <p>Free Pickup and Delivery Available</p>
                         <a href="#" class="primary-btn">SHOP NOW</a>
                     </div>
                 </div>
                 @else

                 @endif
             </div>
         </div>
     </div>
 </section>
 <!-- Hero Section End -->

