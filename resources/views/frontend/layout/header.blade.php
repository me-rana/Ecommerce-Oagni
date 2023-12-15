<!DOCTYPE html>
<html lang="en">
@php
    use Illuminate\Support\Facades\Route;
@endphp
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ Route::currentRouteName()." - " }} @php try { echo $settings->name;} catch (\Exception $e) {echo "Ogani";}@endphp</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="../assets/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="../assets/css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="../assets/css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="../assets/css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="../assets/css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="../assets/css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="../assets/css/style.css" type="text/css">


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"> </script>
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Humberger Begin -->
    <div class="humberger__menu__overlay"></div>
    <div class="humberger__menu__wrapper">
        <div class="humberger__menu__logo">
            <img src="../../{{ $settings->logo_path ??  'assets/img/logo.png'}}" width="120px" height="50px" alt="">
        </div>
        <div class="humberger__menu__cart">
            <ul>
                <li><a href="#"><i class="fa fa-heart"></i> <span>1</span></a></li>
                <li><a href="#"><i class="fa fa-shopping-bag"></i> <span>3</span></a></li>
            </ul>
            <div class="header__cart__price">item: <span>
                @php
                if(!is_null($carts)){
                    if(count($carts) > 0){
                    $price = 0;
                        $sum = 0;
                    foreach ($carts as $cart){
                        $price = $cart->price * $cart->quantity;
                        $sum += $price;
                }

                echo $sum.' BDT';
                }
                }

                @endphp
                </span></div>
        </div>
        <div class="humberger__menu__widget">
            <div class="header__top__right__language">
                <div>English</div>
                <span class="arrow_carrot-down"></span>
                <ul>
                    <li><a href="#">English</a></li>
                    <li><a href="#">English</a></li>
                </ul>
            </div>
            <div class="header__top__right__auth">
                <a href="../login"><i class="fa fa-user"></i> Login</a>
            </div>
        </div>
        <nav class="humberger__menu__nav mobile-menu">
            <ul>
                <li class="active"><a href="../">Home</a></li>
                <li><a href="../shop">Shop</a></li>
                <li><a href="#">Pages</a>
                    <ul class="header__menu__dropdown">
                        <li><a href="../shoping-cart">Shoping Cart</a></li>
                        <li><a href="../checkout">Check Out</a></li>
                    </ul>
                </li>
                <li><a href="../blog">Blog</a></li>
                <li><a href="../contact">Contact</a></li>
            </ul>
        </nav>
        <div id="mobile-menu-wrap"></div>
        <div class="header__top__right__social">
            @include('frontend.layout.social-links')
        </div>
        <div class="humberger__menu__contact">
            <ul>
                <li><i class="fa fa-envelope"></i> {{ $settings->email ?? 'contact@ranasvc.com' }} </li>
                <li>Free Shipping for all Order of $99</li>
            </ul>
        </div>
    </div>
    <!-- Humberger End -->

    <!-- Header Section Begin -->
    <header class="header">
        <div class="header__top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="header__top__left">
                            <ul>
                                <li><i class="fa fa-envelope"></i> {{ $settings->email ?? 'contact@ranasvcc.com' }} </li>
                                <li>Free Shipping for all Order of $99</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="header__top__right">
                            <div class="header__top__right__social">
                                @include('frontend.layout.social-links')
                            </div>
                            <div class="header__top__right__language">
                                <img src="../assets/img/language.png" alt="">
                                <div>English</div>
                                <span class="arrow_carrot-down"></span>
                                <ul>
                                    <li><a href="#">English</a></li>
                                    <li><a href="#">English</a></li>
                                </ul>
                            </div>
                            <div class="header__top__right__auth">
                                <a href="/login"><i class="fa fa-user"></i> Login</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="header__logo">
                        <img src="../../{{ $settings->logo_path ?? 'assets/img/logo.png' }}" width="120px" height="50px" alt="">
                    </div>
                </div>
                <div class="col-lg-6">
                    @include('frontend.layout.menu')
                </div>
                <div class="col-lg-3">
                    <div class="header__cart">
                        <ul>
                            <li><a href="#"><i class="fa fa-heart"></i> <span>0</span></a></li>
                            <li><a href="{{route('Shoping Cart')}}"><i class="fa fa-shopping-bag"></i> <span>@if (is_countable($carts) && count($carts) > 0){{count($carts)}} @else 0 @endif</span></a></li>
                        </ul>
                        <div class="header__cart__price">item: <span>@php
                            if(is_countable($carts) && count($carts) > 0 ){
                                $price = 0;
                                $sum = 0;
                                foreach ($carts as $cart){
                                    $price = $cart->price * $cart->quantity;
                                    $sum += $price;
                            }
                            echo $sum + ($sum - (($sum*99.5)/100) ).' BDT';
                            }
                            else {echo '0 BDT';};
                            @endphp</span></div>
                    </div>
                </div>
            </div>
            <div class="humberger__open">
                <i class="fa fa-bars"></i>
            </div>
        </div>
    </header>
    <!-- Header Section End -->

    {{-- Hero Controlled blade started --}}
    @include('frontend.layout.hero-support')
