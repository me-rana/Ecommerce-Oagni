
<nav class="header__menu">
    <ul>
        <li class="@if(Request::route()->getName() == 'Home')) active  @endif"><a href="../">Home</a></li>
        <li class="@if(Request::route()->getName() == 'Shop')) active  @endif"><a href="../shop">Shop</a></li>
        <li class="@if(Request::route()->getName() == 'Single Post' || Request::route()->getName() == 'singleProduct' || Request::route()->getName() == 'Checkout' ||Request::route()->getName() == 'Shoping Cart') active  @endif"><a href="#">Pages</a>
            <ul class="header__menu__dropdown">
                <li><a href="../shoping-cart">Shoping Cart</a></li>
                <li><a href="../checkout">Check Out</a></li>
            </ul>
        </li>
        <li class="@if (Request::route()->getName() == 'Blog') active @endif"><a href="../blog">Blog</a></li>
        <li class=" @if(Request::route()->getName() == 'Contact') active @endif"><a href="../contact">Contact</a></li>
    </ul>
</nav>
