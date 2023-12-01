@extends('frontend.layout.main')
@section('main-section')

     <!-- Breadcrumb Section Begin -->
     <section class="breadcrumb-section set-bg" data-setbg="../assets/img/breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Checkout</h2>
                        <div class="breadcrumb__option">
                            <a href="./index.html">Home</a>
                            <span>Checkout</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Checkout Section Begin -->
    <section class="checkout spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h6><span class="icon_tag_alt"></span> Have a coupon? <a href="#">Click here</a> to enter your code
                    </h6>
                </div>
            </div>
            <div class="checkout__form">
                <h4>Billing Details</h4>
                <form method="post" action="{{route('order')}}">
                    @csrf
                    <div class="row">
                        <div class="col-lg-8 col-md-6">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        @php $name = explode(" ", $user->name); @endphp
                                        <p>Fist Name<span>*</span></p>
                                        <input name="first_name" type="text" value="{{$name[0] ?? ''}}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Last Name<span>*</span></p>
                                        <input type="text" name="last_name" value="{{$name[1] ?? ''}}">
                                    </div>
                                </div>
                            </div>
                            <div class="checkout__input">
                                <p>Country<span>*</span></p>
                                <input name="country" type="text" value="{{$user->country ?? ''}}">
                            </div>
                            <div class="checkout__input">
                                <p>Address<span>*</span></p>
                                <input name="shipping_address" type="text" placeholder="Street Address" value="{{$user->shipping_address ?? ''}}" class="checkout__input__add">
                            </div>
                            <div class="checkout__input">
                                <p>Town/City<span>*</span></p>
                                <input name="city" type="text" value="{{$user->city ?? ''}}">
                            </div>
                            <div class="checkout__input">
                                <p>State<span>*</span></p>
                                <input name="state" type="text" value="{{$user->state ?? ''}}">
                            </div>
                            <div class="checkout__input">
                                <p>Postcode / ZIP<span>*</span></p>
                                <input name="postcode" type="number" value="{{$user->postcode ?? ''}}">
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Phone<span>*</span></p>
                                        <input name="phone_no" type="text" value="{{$user->phone ?? ''}}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Email<span>*</span></p>
                                        <input name="email" type="text" value="{{$user->email ?? ''}}" disabled>
                                    </div>
                                </div>
                            </div>

                            <input type="hidden" name="seller" value="">
                            <div class="checkout__input">
                                <p>Order notes<span>*</span></p>
                                <input name="note" type="text" placeholder="Notes about your order, e.g. special notes for delivery.">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="checkout__order">
                                <h4>Your Order</h4>
                                <div class="checkout__order__products">Products <span>Total</span></div>
                                <ul>
                                    @if(is_countable($carts) && $carts->count() > 0)
                                        @foreach ($carts as $cart)
                                            <li>{{$cart->product_name}} x {{$cart->quantity}}<span>{{($cart->price * $cart->quantity)}} BDT</span></li>
                                        @endforeach
                                    @endif

                                </ul>
                                <div class="checkout__order__subtotal">Subtotal <span>@php
                                    if(is_countable($carts) && count($carts) > 0){
                                        $price = 0;
                                            $sum = 0;
                                        foreach ($carts as $cart){
                                            $price = $cart->price * $cart->quantity;
                                            $sum += $price;
                                    }
                                    echo $sum .' BDT';
                                    }
                                    else{
                                        echo "0 BDT";
                                    }
                                    @endphp</span>
                                <br>
                                <div> Vat
                                    <span>
                                        @php
                                        if(is_countable($carts) && count($carts) > 0){
                                            $price = 0;
                                                $sum = 0;
                                            foreach ($carts as $cart){
                                                $price = $cart->price * $cart->quantity;
                                                $sum += $price;
                                        }
                                        echo ($sum - (($sum*99.5)/100) ).' BDT';
                                        }
                                        else{
                                            echo "0 BDT";
                                        }
                                        @endphp
                                    </span>
                                </div>
                                </div>


                                <div class="checkout__order__total">Total <span>@php
                                    if(is_countable($carts) && count($carts) > 0){
                                        $price = 0;
                                            $sum = 0;
                                        foreach ($carts as $cart){
                                            $price = $cart->price * $cart->quantity;
                                            $sum += $price;
                                    }
                                    echo $sum + ($sum - (($sum*99.5)/100) ).' BDT';
                                    }
                                    else{
                                        echo '0 BDT';
                                    }
                                    @endphp</span></div>

                                <p>Purchase product from us. Get the best products with cheap price</p>
                                <div>
                                    <label for="payment">
                                        Payment Method
                                        <div class="mb-3">
                                            <select name="payment" id="">
                                                <option value="Cash on Delivery" selected>Cash On Delivery</option>
                                                <option value="BKash">BKash</option>
                                                <option value="Nagad">Nagad</option>
                                            </select>
                                        </div>
                                    </label>
                                </div>
                                <button type="submit" class="site-btn">PLACE ORDER</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- Checkout Section End -->

@endsection
