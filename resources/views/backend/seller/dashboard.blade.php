@extends('backend.seller.layout.seller')
@section('main-content')

<div class="pagetitle">
  <h1>{{Route::currentRouteName()}}</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{route('seller.dashboard')}}">Home</a></li>
      <li class="breadcrumb-item active">{{Route::currentRouteName()}}</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

          <div style="min-height: 400px">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-6 col-6"><div class="card"><img src="../../storage/image/checkmate.webp" alt="Use it for Sample by MERANA International" srcset=""></div></div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-6"><div class="card"><img src="../../storage/image/checkmate.webp" alt="Use it for Sample by MERANA International" srcset=""></div></div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-6"><div class="card"><img src="../../storage/image/checkmate.webp" alt="Use it for Sample by MERANA International" srcset=""></div></div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-6"><div class="card"><img src="../../storage/image/checkmate.webp" alt="Use it for Sample by MERANA International" srcset=""></div></div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-6 col-6"><div class="card"><img src="../../storage/image/checkmate.webp" alt="Use it for Sample by MERANA International" srcset=""></div></div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-6"><div class="card"><img src="../../storage/image/checkmate.webp" alt="Use it for Sample by MERANA International" srcset=""></div></div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-6"><div class="card"><img src="../../storage/image/checkmate.webp" alt="Use it for Sample by MERANA International" srcset=""></div></div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-6"><div class="card"><img src="../../storage/image/checkmate.webp" alt="Use it for Sample by MERANA International" srcset=""></div></div>
            </div>

        </div>






@endsection
