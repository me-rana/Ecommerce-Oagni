@extends('backend.admin.layout.admin')
@section('main-content')

<div class="pagetitle">
  <h1>{{Route::currentRouteName()}}</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{route('Dashboard (Admin)')}}">Home</a></li>
      <li class="breadcrumb-item active">{{Route::currentRouteName()}}</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

          <div style="min-height: 400px">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Tenetur consectetur placeat voluptas officia ut exercitationem tempore, adipisci impedit numquam deleniti. Fugit quo hic similique sequi nisi vero esse ipsam nostrum?
            <br>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Autem deserunt suscipit facere iusto, ullam excepturi, voluptate tenetur ex tempora libero, est quidem totam exercitationem ipsam earum voluptatem rem. Voluptates, nisi!
            <br>
            Lorem ipsum, dolor sit amet consectetur adipisicing elit. Laudantium, magnam eos doloremque maxime tempora possimus vel dolorem? Vero aperiam incidunt ratione saepe temporibus, veritatis eveniet illo ab, eius architecto molestiae?

        </div>






@endsection
