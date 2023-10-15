@extends('backend.customer.layout.main')
@section('main-section')

<div class="container card my-2">
    <div class="table-responsive py-5">
        <table class="table table-light">
            <thead>
                <tr>
                    <th scope="col">OrderID</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">View</th>
                </tr>
            </thead>
            <tbody>

                    @if ($orders->count() > 0)
                    <tr class="">
                        @foreach ($orders as $order)
                        <td scope="row">{{$order->order_id}}</td>
                        <td>{{$order->product_name}}</td>
                        <td><a href="../../../customer/myorder/{{$order->order_id}}"><button type="submit" class="btn btn-primary">View</button></a></td>
                    </tr>
                        @endforeach
                    @endif

            </tbody>
        </table>
    </div>

</div>


@endsection
