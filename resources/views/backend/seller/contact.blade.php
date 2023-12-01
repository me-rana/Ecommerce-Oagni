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
    
@endsection