@extends('backend.customer.layout.main')
@section('main-section')

<style>
    @import url('https://fonts.googleapis.com/css2?family=Josefin+Sans&display=swap');
    .order-font{
        font-family: 'Josefin Sans', sans-serif;
    }
  </style>

          <div class="container py-2">
            @include('backend.customer.layout.message-notify')
            <div class="card">
                <div class="container py-3">
                    <h3 class="text-center">User Info</h3>
                    <center>Fill these with valid info</center>
                    <form action="{{route('customer.updatedmyinfo')}}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="" class="form-label">Name</label>
                            <input type="text" name="name" id="" class="form-control" value="{{$user->name}}" placeholder="" aria-describedby="helpId">
                            <small id="helpId" class="text-muted">Help text</small>
                          </div>

                          <div class="mb-3">
                            <label for="" class="form-label">Phone No</label>
                            <input type="number" name="phone" value="{{$user->phone}}" id="" class="form-control" placeholder="" aria-describedby="helpId">
                            <small id="helpId" class="text-muted">Help text</small>
                          </div>
                          <div class="mb-3">
                            <label for="" class="form-label">Billing Address</label>
                            <input type="text" name="billing_address" id="" class="form-control" value="{{$user->billing_address}}" placeholder="" aria-describedby="helpId">
                            <small id="helpId" class="text-muted">Help text</small>
                          </div>
                          <div class="mb-3">
                            <label for="" class="form-label">Shipping Address</label>
                            <input type="text" name="shipping_address" id="" class="form-control" value="{{$user->shipping_address}}" placeholder="" aria-describedby="helpId">
                            <small id="helpId" class="text-muted">Help text</small>
                          </div>
                          <div class="mb-3">
                            <label for="" class="form-label">Country</label>
                            <input type="text" name="country" id="" class="form-control" value="{{$user->country}}" placeholder="" aria-describedby="helpId">
                            <small id="helpId" class="text-muted">Help text</small>
                          </div>
                          <div class="mb-3">
                            <label for="" class="form-label">City</label>
                            <input type="text" name="city" id="" class="form-control" value="{{$user->city}}" placeholder="" aria-describedby="helpId">
                            <small id="helpId" class="text-muted">Help text</small>
                          </div>

                          <div class="mb-3">
                            <label for="" class="form-label">State</label>
                            <input type="text" name="state" id="" class="form-control" value="{{$user->state}}" placeholder="" aria-describedby="helpId">
                            <small id="helpId" class="text-muted">Help text</small>
                          </div>
                          <div class="mb-3">
                            <label for="" class="form-label">PostCode / Zipcode</label>
                            <input type="number" name="postcode" id="" value="{{$user->postcode}}" class="form-control" placeholder="" aria-describedby="helpId">
                            <small id="helpId" class="text-muted">Help text</small>
                          </div>
                          <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
          </div>



@endsection
