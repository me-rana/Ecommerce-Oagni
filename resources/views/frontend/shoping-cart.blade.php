@extends('frontend.layout.main')
@section('main-section')

     <!-- Breadcrumb Section Begin -->
     <section class="breadcrumb-section set-bg" data-setbg="../assets/img/breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Shopping Cart</h2>
                        <div class="breadcrumb__option">
                            <a href="./index.html">Home</a>
                            <span>Shopping Cart</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->
    <br>
    @include('frontend.layout.message')
    <!-- Shoping Cart Section Begin -->
    <section class="shoping-cart spad" id="cart">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__table">
                        <table>
                            <thead>
                                <tr>
                                    <th class="shoping__product">Products</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (is_countable($carts) && count($carts))
                                    @foreach ($carts as $cart)
                                    <tr>
                                        <td class="shoping__cart__item">
                                            <img src="../../{{$cart->getImage->image_path}}" height="80px" alt="">
                                            <h5>{{$cart->product_name}}</h5>
                                        </td>
                                        <td class="shoping__cart__price">
                                            <span id="price">{{$cart->price}}</span>
                                        </td>
                                        <td class="shoping__cart__quantity">
                                            <div class="quantity">
                                                <form action="{{route('Update Cart')}}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{$cart->id}}">
                                                    <div class="pro-qty">
                                                    <input name="quantity" data-rowid="{{$cart->id}}" type="number" onchange="updateQuantity(this)" value="{{$cart->quantity}}">
                                                    </div>
                                                    <button class="btn-success" type="submit"><i style="font-size:22px;" class="fa fa-check"></i></button>
                                                </form>
                                            </div>
                                        </td>
                                        <td class="shoping__cart__total">
                                            <span id="subtotal{{$cart->id}}" >{{$cart->quantity * $cart->price}} BDT</span>
                                        </td>
                                        <td class="shoping__cart__item__close">
                                            <a href="../delete-cart/{{$cart->id}}"><span class="icon_close"></span></a>
                                        </td>
                                    </tr>

                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__btns">
                        <a href="../shop" class="primary-btn cart-btn">CONTINUE SHOPPING</a>
                        <a href="#" class="primary-btn cart-btn cart-btn-right"><span class="icon_loading"></span>
                            Upadate Cart</a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="shoping__continue">
                        <div class="shoping__discount">
                            <h5>Discount Codes</h5>
                            <form action="#">
                                <input type="text" placeholder="Enter your coupon code">
                                <button type="submit" class="site-btn">APPLY COUPON</button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="shoping__checkout">
                        <h5>Cart Total</h5>
                        <ul>
                            <li>Subtotal <span>
                                @php
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
                                @endphp
                            </span></li>

                            <li>Vat <span>
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
                            </span></li>

                            <li>Total <span>@php
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
                                @endphp</span></li>
                        </ul>
                        <a href="../checkout" class="primary-btn">PROCEED TO CHECKOUT</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shoping Cart Section End -->

@endsection



