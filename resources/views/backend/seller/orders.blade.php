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

          <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-6 col-12"></div>
            <div class="col-lg-4 col-md-4 col-sm-6 col-12"></div>
            <div class="col-lg-4 col-md-4 col-sm-6 col-12"><form action="{{route('seller.orderSearch')}}"><div class="row"><div class="col-10"><input class="form-control" name="order_id" type="text">  </div><div class="col-2"><button class="btn btn-light"><i class="bi bi-search"></i> </button></div></div></form></div>
          </div>

          <div class="table-responsive">
            <table class="table table-light order-font">
                <thead>
                    <tr>
                        <th scope="col">Order Id</th>
                        <th scope="col">Customer Name</th>
                        <th scope="col">Product Name</th>
                        <th scope="col">Price and Qunatity</th>
                        <th scope="col">Total Price</th>
                        <th scope="col">Status</th>
                        <th scope="col">Modify</th>

                    </tr>
                </thead>
                <tbody>
                    @if ($orders->count() > 0)
                        @foreach ($orders as $order)
                        <tr class="">
                            <td scope="row">{{$order->order_id}}</td>
                            <td>{{$order->name}}</td>
                            <td>{{$order->product_name}}</td>
                            <td>{{$order->price}} BDT x {{$order->quantity}}</td>
                            <td>{{$order->total_price + $order->vat}} BDT <br> <font color="red" size="1px"> Vat {{$order->vat}} BDT</font></td>
                            <td><div class="mb-3">
                              <form action="{{route('seller.orderSearchUpdate')}}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-8">
                                        <select class="form-select form-select" name="status" id="">
                                            <option value="Processing" @if ($order->status == "Processing") selected @endif>Processing</option>
                                            <option value="Cancelled" @if ($order->status == "Cancelled") selected @endif>Cancelled</option>
                                            <option value="Ready for Shipping" @if ($order->status == "Ready for Shipping") selected @endif>Ready for Shipping</option>
                                            <option value="Shipped" @if ($order->status == "Shipped") selected @endif>Shipped</option>
                                            <option value="Completed" @if ($order->status == "Completed") selected @endif>Completed</option>
                                          </select>
                                    </div>
                                    <div class="col-4">
                                        <input name="order_id" type="hidden" value="{{$order->order_id}}">
                                        <button class="btn btn-light" type="submit"><i class="bi bi-check-square"></i>
                                    </div>
                                </div>

                              </div></form></td>
                              <td><a href="../../seller/order-modify/{{$order->order_id}}"><button class="btn btn-success">Modify</button></a></td>
                        @endforeach
                        </tr>

                    @endif

                </tbody>
            </table>
          </div>





@endsection
