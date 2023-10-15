@extends('backend.seller.layout.seller')
@section('main-content')

<style>
    @import url('https://fonts.googleapis.com/css2?family=Josefin+Sans&display=swap');
    .order-font{
        font-family: 'Josefin Sans', sans-serif;
    }
  </style>

        <div class="pagetitle">
            <h1>Orders</h1>
            <nav>
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                <li class="breadcrumb-item active">Orders</li>
              </ol>
            </nav>
          </div><!-- End Page Title -->

          <div class="container">
            <div class="row">
                <div class="col-lg-2 col-md-2 col-sm-1 col-1"></div>
                <div class="col-lg-10 col-md-10 col-sm-11 col-11">
                    <div class="card rounded">
                        <div class="container">
                            <center>
                                <p>OrderID : <strong>{{$order->order_id}}</strong></p>
                                <img src="../../storage/image/{{$product->image_path}}" height="200px" width="150px" alt="">
                                <h3><strong>{{$order->product_name}}</strong></h3>
                                <p>Quantity : <strong>{{$order->quantity}}</strong></p>
                                <p>Price : <strong>{{$order->price}}</strong></p>
                                <p>Total Price: <strong>{{$order->total_price + $order->vat}}</strong></p>
                                <p>Customer Name : <strong>{{$order->name}}</strong></p>
                                <form action="{{route('seller.orderSearchUpdate')}}" method="post">
                                    @csrf
                                    <select class="form-select form-select" name="status" id="">
                                        <option value="Processing" @if ($order->status == "Processing") selected @endif>Processing</option>
                                        <option value="Cancelled" @if ($order->status == "Cancelled") selected @endif>Cancelled</option>
                                        <option value="Ready for Shipping" @if ($order->status == "Ready for Shipping") selected @endif>Ready for Shipping</option>
                                        <option value="Shipped" @if ($order->status == "Shipped") selected @endif>Shipped</option>
                                        <option value="Completed" @if ($order->status == "Completed") selected @endif>Completed</option>
                                    </select>
                                    <label for="note">Update Notes are here</label>
                                    <textarea placeholder="Special Notes" name="note" id="" class="form-control" cols="30" rows="10"></textarea>
                                    <input name="order_id" type="hidden" value="{{$order->order_id}}"> <br>
                                    <button class="btn btn-success" type="submit"><i class="bi bi-check-square"></i> Update Status </button>
                                </form>
                                <br>
                            </center>
                        </div>

                    </div>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-1 col-1"></div>
            </div>
          </div>



@endsection
