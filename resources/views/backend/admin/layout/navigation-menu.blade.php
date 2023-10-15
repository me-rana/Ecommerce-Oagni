  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link @if(Request::route()->getName() != 'admin.dashboard')) collapsed  @endif" href="{{route('admin.dashboard')}}">
            <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#product-cat" data-bs-toggle="collapse" href="#">
          <i class="bi bi-menu-button-wide"></i><span>Product Categories</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="product-cat" class="nav-content @if (Request::route()->getName() != 'admin.categories' && Request::route()->getName() != 'admin.addCategory') collapse @endif" data-bs-parent="#sidebar-nav">
          <li>
            <a class="@if(Request::route()->getName() == 'admin.categories')) active  @endif" href="{{route('admin.categories')}}">
              <i class="bi bi-circle"></i><span>Categories</span>
            </a>
          </li>
          <li>
            <a class="@if(Request::route()->getName() == 'admin.addCategory')) active  @endif" href="{{route('admin.addCategory')}}">
            <i class="bi bi-circle"></i><span>Add category</span>
            </a>
          </li>
        </ul>
      </li><!-- End Components Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#products" data-bs-toggle="collapse" href="#">
          <i class="bi bi-journal-text"></i><span>Products</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="products" class="nav-content @if (Request::route()->getName() != 'admin.products' && Request::route()->getName() != 'admin.addProduct') collapse @endif " data-bs-parent="#sidebar-nav">
          <li>
            <a class="@if(Request::route()->getName() == 'admin.products')) active  @endif" href="{{route('admin.products')}}">
              <i class="bi bi-circle"></i><span>Products</span>
            </a>
          </li>
          <li>
            <a class="@if(Request::route()->getName() == 'admin.addProduct')) active  @endif" href="{{route('admin.addProduct')}}">
              <i class="bi bi-circle"></i><span>Add Product</span>
            </a>
          </li>

        </ul>
      </li><!-- End Forms Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{route('admin.orders')}}">
        <i class="bi bi-circle"></i>
          <span>Orders</span>
        </a>
      </li><!-- End Profile Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#bcats-nav" data-bs-toggle="collapse" href="#">
            <i class="bi bi-menu-button-wide"></i><span>Categories</span><i class="bi bi-chevron-down ms-auto"></i>
          </a>
        <ul id="bcats-nav" class="nav-content @if (Request::route()->getName() != 'admin.blog.categories' && Request::route()->getName() != 'admin.blog.addCategory') collapse @endif" data-bs-parent="#sidebar-nav">
          <li>
            <a class="@if(Request::route()->getName() == 'admin.blog.categories')) active  @endif" href="{{route('admin.blog.categories')}}">
              <i class="bi bi-circle"></i><span>Categories</span>
            </a>
          </li>
          <li>
            <a class="@if(Request::route()->getName() == 'admin.blog.addCategory')) active  @endif" href="{{route('admin.blog.addCategory')}}">
            <i class="bi bi-circle"></i><span>Add category</span>
            </a>
          </li>
        </ul>
      </li><!-- End Bcats Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#posts-nav" data-bs-toggle="collapse" href="#">
            <i class="bi bi-menu-button-wide"></i><span>Posts</span><i class="bi bi-chevron-down ms-auto"></i>
          </a>
        <ul id="posts-nav" class="nav-content @if (Request::route()->getName() != 'admin.blog.posts' && Request::route()->getName() != 'admin.blog.addPost') collapse @endif" data-bs-parent="#sidebar-nav">
          <li>
            <a class="@if(Request::route()->getName() == 'admin.blog.posts')) active  @endif" href="{{route('admin.blog.posts')}}">
              <i class="bi bi-circle"></i><span>Posts</span>
            </a>
          </li>
          <li>
            <a class="@if(Request::route()->getName() == 'admin.blog.addPost')) active  @endif" href="{{route('admin.blog.addPost')}}">
              <i class="bi bi-circle"></i><span>Add Post</span>
            </a>
          </li>

        </ul>
      </li><!-- End Forms Nav -->

      <li class="nav-item">
        <a class="nav-link @if(Request::route()->getName() != 'admin.users')) collapsed  @endif" href="{{route('admin.users')}}">
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
        <a class="nav-link collapsed" href="{{route('admin.settings')}}">
          <i class="bi bi-circle"></i>
          <span>Setting</span>
        </a>
      </li><!-- End Profile Page Nav -->
    </ul>

  </aside><!-- End Sidebar-->
