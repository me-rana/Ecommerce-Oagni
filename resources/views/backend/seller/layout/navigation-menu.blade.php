  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link @if(Request::route()->getName() != 'Dashboard (Seller)')) collapsed  @endif" href="{{route('Dashboard (Seller)')}}">
            <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#product-cat" data-bs-toggle="collapse" href="#">
          <i class="bi bi-menu-button-wide"></i><span>Product Categories</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="product-cat" class="nav-content @if (Request::route()->getName() != 'Product Categories (Seller)' && Request::route()->getName() != 'Product New Category (Seller)') collapse @endif" data-bs-parent="#sidebar-nav">
          <li>
            <a class="@if(Request::route()->getName() == 'Product Categories (Seller)')) active  @endif" href="{{route('Product Categories (Seller)')}}">
              <i class="bi bi-circle"></i><span>Categories</span>
            </a>
          </li>
          <li>
            <a class="@if(Request::route()->getName() == 'Product New Category (Seller)')) active  @endif" href="{{route('Product New Category (Seller)')}}">
            <i class="bi bi-circle"></i><span>Request Category</span>
            </a>
          </li>
        </ul>
      </li><!-- End Components Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#products" data-bs-toggle="collapse" href="#">
          <i class="bi bi-journal-text"></i><span>Products</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="products" class="nav-content @if (Request::route()->getName() != 'Products (Seller)' && Request::route()->getName() != 'New Product (Seller)') collapse @endif " data-bs-parent="#sidebar-nav">
          <li>
            <a class="@if(Request::route()->getName() == 'Products (Seller)')) active  @endif" href="{{route('Products (Seller)')}}">
              <i class="bi bi-circle"></i><span>Products</span>
            </a>
          </li>
          <li>
            <a class="@if(Request::route()->getName() == 'New Product (Seller)')) active  @endif" href="{{route('New Product (Seller)')}}">
              <i class="bi bi-circle"></i><span>Add Product</span>
            </a>
          </li>

        </ul>
      </li><!-- End Forms Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{route('Orders (Seller)')}}">
        <i class="bi bi-circle"></i>
          <span>Orders</span>
        </a>
      </li><!-- End Profile Page Nav -->



      <li class="nav-item">
        <a class="nav-link @if(Request::route()->getName() != 'My Info (Seller)')) collapsed  @endif" href="{{route('My Info (Seller)')}}">
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
