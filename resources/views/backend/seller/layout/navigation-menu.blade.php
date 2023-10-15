  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link @if(Request::route()->getName() != 'seller.dashboard')) collapsed  @endif" href="{{route('seller.dashboard')}}">
            <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#product-cat" data-bs-toggle="collapse" href="#">
          <i class="bi bi-menu-button-wide"></i><span>Product Categories</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="product-cat" class="nav-content @if (Request::route()->getName() != 'seller.categories' && Request::route()->getName() != 'seller.addCategory') collapse @endif" data-bs-parent="#sidebar-nav">
          <li>
            <a class="@if(Request::route()->getName() == 'seller.categories')) active  @endif" href="{{route('seller.categories')}}">
              <i class="bi bi-circle"></i><span>Categories</span>
            </a>
          </li>
          <li>
            <a class="@if(Request::route()->getName() == 'seller.addCategory')) active  @endif" href="{{route('seller.addCategory')}}">
            <i class="bi bi-circle"></i><span>Request Category</span>
            </a>
          </li>
        </ul>
      </li><!-- End Components Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#products" data-bs-toggle="collapse" href="#">
          <i class="bi bi-journal-text"></i><span>Products</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="products" class="nav-content @if (Request::route()->getName() != 'seller.products' && Request::route()->getName() != 'seller.addProduct') collapse @endif " data-bs-parent="#sidebar-nav">
          <li>
            <a class="@if(Request::route()->getName() == 'seller.products')) active  @endif" href="{{route('seller.products')}}">
              <i class="bi bi-circle"></i><span>Products</span>
            </a>
          </li>
          <li>
            <a class="@if(Request::route()->getName() == 'seller.addProduct')) active  @endif" href="{{route('seller.addProduct')}}">
              <i class="bi bi-circle"></i><span>Add Product</span>
            </a>
          </li>

        </ul>
      </li><!-- End Forms Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{route('seller.orders')}}">
        <i class="bi bi-circle"></i>
          <span>Orders</span>
        </a>
      </li><!-- End Profile Page Nav -->



      <li class="nav-item">
        <a class="nav-link @if(Request::route()->getName() != 'seller.myinfo')) collapsed  @endif" href="{{route('seller.myinfo')}}">
            <i class="bi bi-grid"></i>
          <span>My Info</span>
        </a>
      </li><!-- End Dashboard Page Nav -->


      <li class="nav-item">
        <a class="nav-link collapsed" href="../../../user/profile">
          <i class="bi bi-person"></i>
          <span>Profile</span>
        </a>
      </li><!-- End Profile Page Nav -->




      <li class="nav-item">
        <a class="nav-link collapsed" href="../seller/faq">
          <i class="bi bi-question-circle"></i>
          <span>F.A.Q</span>
        </a>
      </li><!-- End F.A.Q Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="../seller/contact">
          <i class="bi bi-envelope"></i>
          <span>Contact</span>
        </a>
      </li><!-- End Contact Page Nav -->

    </ul>

  </aside><!-- End Sidebar-->
