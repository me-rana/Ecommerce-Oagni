  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link @if(Request::route()->getName() != 'Dashboard (Admin)')) collapsed  @endif" href="{{route('Dashboard (Admin)')}}">
            <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#product-cat" data-bs-toggle="collapse" href="#">
          <i class="bi bi-menu-button-wide"></i><span>Product Categories</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="product-cat" class="nav-content @if (Request::route()->getName() != 'Product Categories (Admin)' && Request::route()->getName() != 'Product New Categories (Admin)') collapse @endif" data-bs-parent="#sidebar-nav">
          <li>
            <a class="@if(Request::route()->getName() == 'Product Categories (Admin)')) active  @endif" href="{{route('Product Categories (Admin)')}}">
              <i class="bi bi-circle"></i><span>Categories</span>
            </a>
          </li>
          <li>
            <a class="@if(Request::route()->getName() == 'Product New Category (Admin)')) active  @endif" href="{{route('Product New Category (Admin)')}}">
            <i class="bi bi-circle"></i><span>Add category</span>
            </a>
          </li>
        </ul>
      </li><!-- End Components Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#products" data-bs-toggle="collapse" href="#">
          <i class="bi bi-journal-text"></i><span>Products</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="products" class="nav-content @if (Request::route()->getName() != 'Products (Admin)' && Request::route()->getName() != 'Products (Admin)') collapse @endif " data-bs-parent="#sidebar-nav">
          <li>
            <a class="@if(Request::route()->getName() == 'Products (Admin)')) active  @endif" href="{{route('Products (Admin)')}}">
              <i class="bi bi-circle"></i><span>Products</span>
            </a>
          </li>
          <li>
            <a class="@if(Request::route()->getName() == 'New Product (Admin)')) active  @endif" href="{{route('New Product (Admin)')}}">
              <i class="bi bi-circle"></i><span>Add Product</span>
            </a>
          </li>

        </ul>
      </li><!-- End Forms Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{route('Orders (Admin)')}}">
        <i class="bi bi-circle"></i>
          <span>Orders</span>
        </a>
      </li><!-- End Profile Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#bcats-nav" data-bs-toggle="collapse" href="#">
            <i class="bi bi-menu-button-wide"></i><span>Categories</span><i class="bi bi-chevron-down ms-auto"></i>
          </a>
        <ul id="bcats-nav" class="nav-content @if (Request::route()->getName() != 'Blog Categories (Admin)' && Request::route()->getName() != 'Blog  New Category (Admin)') collapse @endif" data-bs-parent="#sidebar-nav">
          <li>
            <a class="@if(Request::route()->getName() == 'Blog Categories (Admin)')) active  @endif" href="{{route('Blog Categories (Admin)')}}">
              <i class="bi bi-circle"></i><span>Categories</span>
            </a>
          </li>
          <li>
            <a class="@if(Request::route()->getName() == 'Blog New Category (Admin)')) active  @endif" href="{{route('Blog New Category (Admin)')}}">
            <i class="bi bi-circle"></i><span>Add category</span>
            </a>
          </li>
        </ul>
      </li><!-- End Bcats Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#posts-nav" data-bs-toggle="collapse" href="#">
            <i class="bi bi-menu-button-wide"></i><span>Posts</span><i class="bi bi-chevron-down ms-auto"></i>
          </a>
        <ul id="posts-nav" class="nav-content @if (Request::route()->getName() != 'Posts (Admin)' && Request::route()->getName() != 'New Posts (Admin)') collapse @endif" data-bs-parent="#sidebar-nav">
          <li>
            <a class="@if(Request::route()->getName() == 'Posts (Admin)')) active  @endif" href="{{route('Posts (Admin)')}}">
              <i class="bi bi-circle"></i><span>Posts</span>
            </a>
          </li>
          <li>
            <a class="@if(Request::route()->getName() == 'New Post (Admin)')) active  @endif" href="{{route('New Post (Admin)')}}">
              <i class="bi bi-circle"></i><span>Add Post</span>
            </a>
          </li>

        </ul>
      </li><!-- End Forms Nav -->

      <li class="nav-item">
        <a class="nav-link @if(Request::route()->getName() != 'Users (Admin)')) collapsed  @endif" href="{{route('Users (Admin)')}}">
            <i class="bi bi-grid"></i>
          <span>Users</span>
        </a>
      </li><!-- End Dashboard Page Nav -->


      <li class="nav-item">
        <a class="nav-link collapsed" href="../../../user/profile">
          <i class="bi bi-person"></i>
          <span>Profile</span>
        </a>
      </li><!-- End Profile Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{route('Settings (Admin)')}}">
          <i class="bi bi-circle"></i>
          <span>Setting</span>
        </a>
      </li><!-- End Profile Page Nav -->
    </ul>

  </aside><!-- End Sidebar-->
