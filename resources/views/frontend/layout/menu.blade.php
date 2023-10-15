
<nav class="header__menu">
    <ul>
        <li class="@if(Request::route()->getName() == 'home')) active  @endif"><a href="../">Home</a></li>
        <li class="@if(Request::route()->getName() == 'shop')) active  @endif"><a href="../shop">Shop</a></li>
        <li class="@if(Request::route()->getName() == 'singlePost' || Request::route()->getName() == 'singleProduct' || Request::route()->getName() == 'checkout' ||Request::route()->getName() == 'shopingCart') active  @endif"><a href="#">Pages</a>
            <ul class="header__menu__dropdown">
                <li><a href="../shoping-cart">Shoping Cart</a></li>
                <li><a href="../checkout">Check Out</a></li>
            </ul>
        </li>
        <li class="@if (Request::route()->getName() == 'blog') active @endif"><a href="../blog">Blog</a></li>
        <li class=" @if(Request::route()->getName() == 'contact') active @endif"><a href="../contact">Contact</a></li>
    </ul>
</nav>
