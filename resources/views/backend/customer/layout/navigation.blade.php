    <style>
        .custom:hover{
            color: rgb(179, 68, 253);
        }
        .custom-active{
            color: rgb(179, 68, 253);;
        }
    </style>
    <div class="border bg-light py-3 ps-5"><a class="px-3 link-dark link-offset-2 custom @if(Request::route()->getName() == 'customer.dashboard')) custom-active  @endif" style="text-decoration: none;" href="{{route('customer.dashboard')}}">Dashboard</a></div>
    <div class="border bg-light py-3 ps-5"><a class="px-3 link-dark link-offset-2 custom @if(Request::route()->getName() == 'customer.myorder')) custom-active  @endif" style="text-decoration: none;" href="{{route('customer.myorder')}}">My Order</a></div>
    <div class="border bg-light py-3 ps-5"><a class="px-3 link-dark link-offset-2 custom " style="text-decoration: none;" href="../../../user/profile">Profile</a></div>
    <div class="border bg-light py-3 ps-5"><a class="px-3 link-dark link-offset-2 custom " style="text-decoration: none;" href="../../../shopping-cart">My Cart</a></div>
    <div class="border bg-light py-3 ps-5"><a class="px-3 link-dark link-offset-2 custom " style="text-decoration: none;" href="../../../checkout">My Checkout</a></div>
    <div class="border bg-light py-3 ps-5"><a class="px-3 link-dark link-offset-2 custom @if(Request::route()->getName() == 'customer.myinfo')) custom-active  @endif" style="text-decoration: none;" href="{{route('customer.myinfo')}}">My Info</a></div>
    <div class="border bg-light py-3 ps-5"><form method="POST" action="{{ route('logout') }}" x-data>@csrf <input class="btn btn-link-secondary custom" type="submit" value='Logout'></form></div>
