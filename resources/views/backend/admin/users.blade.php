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
          @include('backend.admin.layout.message-notify')
          <div class="row">
            @if(count($users) > 0)
                @foreach ($users as $user)
                <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                    <div class="card py-2">
                        <img class="rounded mx-auto d-block" src="../../{{$user->image_path ?? 'backend-assets/img/user.png'}}" height="200px" alt="Avatar" style="width:70%">
                        <div class="container">
                          <h4 class="text-center"><b>{{$user->name}}</b></h4>
                          <p class="text-center"><b>
                              @if ($user->usertype == 3)
                                Admin
                              @elseif ($user->usertype == 2)
                                Seller
                              @else
                                Customer
                              @endif </b></p>

                            <p class="text-center">Email : <b>{{$user->email}}</b></p>
                            <div class="row">
                                <div class="col-6"><p class="text-end">Status :</p></div>
                                <div class="col-6">@if ($user->email_verified_at != null)
                                    <p class="text-success"><strong>Verified</strong></p>
                                    @else
                                    <p class="text-danger"><strong>Unverified</strong></p>
                                @endif</div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <a class="float-end" href="../../admin/update-user/{{$user->id}}" rel="noopener noreferrer"><button class="btn btn-success">Modify</button></a>
                                </div>
                                <div class="col-6">
                                    <a href="../../admin/delete-user/{{$user->id}}" rel="noopener noreferrer"><button class="btn btn-danger">Delete</button></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            @endif
          </div>


@endsection
