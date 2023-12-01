@extends('backend.seller.layout.seller')
@section('main-content')

<div class="pagetitle">
  <h1>{{Route::currentRouteName()}}</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{route('Dashboard (Seller)')}}">Home</a></li>
      <li class="breadcrumb-item active">{{Route::currentRouteName()}}</li>
    </ol>
  </nav>
</div><!-- End Page Title -->
          @include('backend.admin.layout.message-notify')
          <div class="row">
            @if(count($categories) > 0)
                @foreach ($categories as $category)
                <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                    <div class="card py-2">
                        <img src="../../{{$category->pimage_path}}" height="200px" alt="Avatar" style="width:100%">
                        <div class="container">
                          <h4 class="text-center"><b>{{$category->pname}}</b></h4>
                          <p class="text-justify">{{$category->pdescription}}</p>




                        </div>
                      </div>
                </div>
                @endforeach
                {{$categories->links('pagination::bootstrap-5')}}

            @endif
          </div>


@endsection
