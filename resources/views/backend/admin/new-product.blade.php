@extends('backend.admin.layout.admin')
@section('main-content')

        <div class="pagetitle">
            <h1>{{$title}}</h1>
            <nav>
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{route('admin.products')}}">Products</a></li>
                <li class="breadcrumb-item active">{{$title}}</li>
              </ol>
            </nav>
          </div><!-- End Page Title -->
          <div class="container card py-2">
            <div class="py-5">
                <h4 class="text-center"><b>{{$title}}</b></h4>
            <p class="text-center">Please fill all the info for better understanding.</p>
            </div>
            <form action="{{$submission}}" method="post" enctype='multipart/form-data'>
                @csrf
                <div class="mb-3">
                    <label for="" class="form-label">Product Name <font color="red">*</font></label>
                    <input type="text" name="pro_name" id="pro_name" value="{{$product->pro_name ?? ''}}" class="form-control" placeholder="" aria-describedby="helpId" >
                    <small><span class="text-danger"> @error('pro_name') {{$message}} @enderror </span></small>
                  </div>
                  <div class="mb-3">
                    <label for="" class="form-label">Slug <font color="red">*</font></label>
                    <input type="text" name="slug" id="slug" value="{{$product->slug ?? ''}}" class="form-control" placeholder="" aria-describedby="helpId" >
                    <small><span class="text-danger"> @error('slug') {{$message}} @enderror </span></small>
                  </div>
                  <div class="mb-3">
                    <label for="" class="form-label">Choose file</label>
                    <input type="file" class="form-control" name="image" id="" placeholder="" aria-describedby="fileHelpId">
                    <div id="fileHelpId" class="form-text">Insert a image of your product</div>
                  </div>
                  <div class="mb-3">
                    <label for="" class="form-label">Category</label>
                    <select class="form-select form-select" name="category" id="">
                        @foreach ($categories as $category)
                        <option value="{{$category->id ?? ''}}">{{$category->pname ?? ''}}</option>
                        @endforeach

                    </select>
                    <small><span class="text-danger"> @error('category') {{$message}} @enderror </span></small>
                  </div>
                  <div class="row">
                    <div class="col-6"><div class="mb-3">
                      <label for="" class="form-label">Product Price <font color="red">*</font></label>
                      <input type="number" name="orginal_price" id="" value="{{$product->orginal_price ?? ''}}" class="form-control" placeholder="" aria-describedby="helpId" >
                      <small id="helpId" class="text-muted">1000</small>
                      <small><span class="text-danger"> @error('orginal_price') {{$message}} @enderror </span></small>
                    </div></div>
                    <div class="col-6"><div class="mb-3">
                        <label for="" class="form-label">Product Discount Price</label>
                        <input type="number" name="discount_price" value="{{$product->discount_price ?? ''}}" id="" class="form-control" placeholder="" aria-describedby="helpId">
                        <small id="helpId" class="text-muted">500</small>
                      </div></div>
                  </div>
                  <div class="mb-3">
                    <label for="" class="form-label">Availabilty <font color="red">*</font></label>
                    <select class="form-select form-select" name="availability" id="" >
                        <option value="In Stock" selected>In Stock</option>
                        <option value="Stock out">Stock out</option>
                        <option value="Comming Soon">Comming Soon</option>
                    </select>
                    <small><span class="text-danger"> @error('availability') {{$message}} @enderror </span></small>
                  </div>
                  <div class="mb-3">
                    <label for="" class="form-label">Description of the Product <font color="red">*</font></label>
                    <textarea class="form-control" name="description" id="editor" rows="3" >@php
                        echo html_entity_decode($product->description ?? '')
                    @endphp</textarea>
                    <small><span class="text-danger"> @error('description') {{$message}} @enderror </span></small>
                  </div>
                  <div class="row">
                    <div class="col-6"><div class="mb-3">
                        <label for="" class="form-label">Shipping</label>
                        <input type="number" name="shipping" value="{{$product->shipping ?? ''}}" id="" class="form-control" placeholder="" aria-describedby="helpId">
                        <small id="helpId" class="text-muted">1,7,15</small>
                      </div></div>
                      <div class="col-6"><div class="mb-3">
                        <label for="" class="form-label">Weight</label>
                        <input type="number" name="weight" value="{{$product->weight ?? ''}}" id=""  class="form-control" placeholder="" aria-describedby="helpId">
                        <small id="helpId" class="text-muted">1 kg</small>
                      </div></div>
                  </div>
                  <div class="mb-3">
                    <label for="" class="form-label">Information about the Product</label>
                    <textarea class="form-control" name="information" id="editorx" rows="3"> @php
                        echo html_entity_decode($product->information ?? '')
                    @endphp </textarea>
                  </div>
                  <div class="py-3">
                    <button type="submit" class="btn btn-primary">Add as a Product</button>
                  </div>
              </form>
          </div>

          <script>
            $("#pro_name").change(function(){
            $.ajax({
                url: '{{ route("admin.getpSlug")}}',
                type: 'get',
                data: {pro_name : $(this).val()},
                datatype: 'json',
                success: function(response){
                    $("#slug").val(response.slug);
                }
            })
            });
            </script>


          <script src="https://cdn.ckeditor.com/ckeditor5/39.0.2/classic/ckeditor.js"></script>
          <script>
            ClassicEditor
                .create( document.querySelector( '#editor' ))
                .catch( error => {
                    console.error( error );
                } );

                ClassicEditor
                .create( document.querySelector( '#editorx' ))
                .catch( error => {
                    console.error( error );
                } );
        </script>
@endsection
