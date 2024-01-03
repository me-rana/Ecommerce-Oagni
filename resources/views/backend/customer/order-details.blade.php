@extends('backend.customer.layout.main')
@section('main-section')
<div class="container card my-2">
    <div class="container py-5">
        <h3 class="text-center">Order Details</h3>
        <p class="text-center">OrderID : <strong>{{$order->order_id}}</strong></p>


        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-12 col-12">
                <center> <img src="../../{{$product->image_path}}" height="200px" width="250px" alt="">
                    <br><strong>{{$order->product_name}}</strong>
                    </center>
                <div class="row">
                    <div class="col-5">Name</div><div class="col-1">:</div><div class="col-6">{{$order->name}}</div>
                    <div class="col-5">Shipping Address</div><div class="col-1">:</div><div class="col-6">@php echo $order->shipping_address @endphp</div>
                    <div class="col-5">Billing Address</div><div class="col-1">:</div><div class="col-6">@php echo $order->shipping_address @endphp</div>
                    <div class="col-5">Phone No</div><div class="col-1">:</div><div class="col-6">{{$order->phone}}</div>
                    <div class="col-5">Note</div><div class="col-1">:</div><div class="col-6">{{$order->note}}</div>
                </div>
                <br> <br>
                <div class="card py-3 px-2"><h5 class="text-center">Order Updates</h5>
                    @php
                        $i = 2;
                    @endphp
                    <h6>1. Processing</h6>
                    @if ($order_updates->count() > 0)
                        @foreach ($order_updates as $update)
                            <h6>{{$i++}}. {{$update->status}}</h6>
                            <p>{{$update->note}}</p>
                        @endforeach
                    @endif</div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 col-12">


                <br>
                <h5 class="text-center">Purchase Details</h5>
                <p><font size="2px" color="red">Payment Method : {{$order->payment_method}} </font></p>
                <p class="text-end">Price : <strong>{{$order->price}} BDT</strong></p>
                <p class="text-end">Quantity : <strong>x{{$order->quantity}}</strong></p>
                <p class="text-end text-danger">Vat : <strong>{{$order->vat}} BDT</strong></p>
                <hr>
                <h6 class="text-end">Total : <strong>{{$order->total_price + $order->vat}} BDT</strong></h6>

            </div>
        </div>
    </div>
</div>
@endsection
