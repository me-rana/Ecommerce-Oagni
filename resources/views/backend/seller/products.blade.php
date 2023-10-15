@extends('backend.seller.layout.seller')
@section('main-content')

        <div class="pagetitle">
            <h1>Products</h1>
            <nav>
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                <li class="breadcrumb-item active">Products</li>
              </ol>
            </nav>
          </div><!-- End Page Title -->
          @include('backend.seller.layout.message-notify')
          <div class="row">
            @if(count($products) > 0)
                @foreach ($products as $product)
                <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                    <div class="card py-2">
                        <img src="../../storage/image/{{$product->image_path}}" height="200px" alt="Avatar" style="width:100%">
                        <div class="container">
                          <h4 class="text-center"><b>{{$product->pro_name}}</b></h4>
                          <center>{{$product->pname}}</center>
                          <p class="text-justify">
                            @php echo Str::words($product->description,15);; @endphp
                          </p>
                          <p class="text-center"> Price : <b> {{$product->discount_price ?? $product->orginal_price}} BDT </b> <br>
                            Availabilty : <b>{{$product->availability}}</b>
                            <br>
                            Delivery : In {{$product->shipping}} days</p>
                          <div class="row">

                            <div class="col-4"><a href="../../../product/{{$product->slug}}" rel="noopener noreferrer"><button class="btn btn-success">View</button></a></div>
                            <div class="col-4"><a href="../../seller/update-product/{{$product->id}}" rel="noopener noreferrer"><button class="btn btn-secondary">Edit</button></a></div>
                            <div class="col-4"><a href="../../seller/delete-product/{{$product->id}}" rel="noopener noreferrer"><button class="btn btn-danger">Delete</button></a></div>
                          </div>



                        </div>
                      </div>
                </div>
                @endforeach
                @else
                <div class="py-3"><h4 class="text-center">Nothing Found</h4><p class="text-center">You have not added any product added yet</p></div>
            @endif
          </div>




@endsection
