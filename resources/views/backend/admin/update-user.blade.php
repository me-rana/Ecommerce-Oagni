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

          <div class="container card py-4">
            <h3 class="text-center">Update User's Profile</h3>
            <p class="text-center">Modified data as your requirement</p>
            <form action="{{null}}" method="post">
                @csrf
                <div class="mb-3">
                  <label for="" class="form-label">Name</label>
                  <input type="text" name="name" id="" value="{{$user->name}}" class="form-control" placeholder="" aria-describedby="helpId">
                  <small id="helpId" class="text-muted">Help text</small>
                </div>
                <div class="mb-3">
                  <label for="" class="form-label">Email</label>
                  <input type="text" name="email" value="{{$user->email}}" id="" class="form-control" placeholder="" aria-describedby="helpId">
                  <small id="helpId" class="text-muted">Help text</small>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Role</label>
                    <select class="form-select form-select" name="role" id="">
                        <option value="1" @if ($user->role == 1) selected @endif>Customer</option>
                        <option value="2" @if ($user->role == 2) selected @endif>Seller</option>
                        <option value="3" @if ($user->role == 3) selected @endif>Admin</option>
                    </select>
                </div>
                <div class="mb-3">
                  <label for="" class="form-label">Phone No</label>
                  <input type="number" name="phone_no" value="{{$user->phone ?? ''}}" id="" class="form-control" placeholder="" aria-describedby="helpId">
                  <small id="helpId" class="text-muted">Help text</small>
                </div>
                <div class="mb-3">
                  <label for="" class="form-label">Billing Address</label>
                  <input type="text" name="billing_address" id="" value="{{$user->billing_address ?? ''}}" class="form-control" placeholder="" aria-describedby="helpId">
                  <small id="helpId" class="text-muted">Help text</small>
                </div>
                <div class="mb-3">
                  <label for="" class="form-label">Shipping Address</label>
                  <input type="text" name="shipping_address" id="" value="{{$user->shipping_address ?? ''}}" class="form-control" placeholder="" aria-describedby="helpId">
                  <small id="helpId" class="text-muted">Help text</small>
                </div>
                <button type="submit" class="btn btn-primary">Update User</button>
            </form>

          </div>





@endsection
