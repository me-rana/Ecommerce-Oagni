@extends('backend.admin.layout.admin')
@section('main-content')

        <div class="pagetitle">
            <h1>{{$title}} (Blog)</h1>
            <nav>
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{route('admin.blog.categories')}}">Categories</a></li>
                <li class="breadcrumb-item active">{{$title}}</li>
              </ol>
            </nav>
          </div><!-- End Page Title -->
          <div class="container bg-white card">
            <div class="py-5">
                <h4 class="text-center"><b>{{$title}}</b></h4>
            <p class="text-center">Please fill all the info for better understanding.</p>
            </div>
            <form action="{{$submission}}" method="post" enctype='multipart/form-data'>
                @csrf
                <div class="mb-3">
                    <label for="" class="form-label">Category Name</label>
                    <input type="text" name="cname" id="cname" value="{{$categories->cname ?? ''}}" class="form-control" placeholder="" aria-describedby="helpId">
                    <small id="helpId" class="text-muted">Beauty, Diet and Weightloss</small>
                  </div>
                  <div class="mb-3">
                    <label for="" class="form-label">Category Slug</label>
                    <input type="text" name="curl" id="curl" value="{{$categories->curl ?? ''}} " class="form-control" placeholder="" aria-describedby="helpId">
                    <small id="helpId" class="text-muted">beauty,weightloss</small>
                  </div>
                  <div class="mb-3">
                    <label for="" class="form-label">Choose file</label>
                    <input type="file" class="form-control" name="image" id="" placeholder="" aria-describedby="fileHelpId">
                    <div id="fileHelpId" class="form-text">Image is used for the cover of the category</div>
                  </div>
                  <div class="mb-3">
                    <label for="" class="form-label">Description of the Category</label>
                    <input type="text" name="cdescription" value="{{$categories->cdescription ?? ''}}" id="" class="form-control" placeholder="" aria-describedby="helpId">
                    <small id="helpId" class="text-muted">In this category, All the contents are related to the beauty.</small>
                  </div>
                  <div class="py-4">
                  <input type="submit" value="Create" class="btn btn-primary">
                  </div>
            </form>
          </div>


          <script>
            $("#cname").change(function(){
            $.ajax({
                url: '{{ route("admin.blog.getBlogCurl")}}',
                type: 'get',
                data: {cname : $(this).val()},
                datatype: 'json',
                success: function(response){
                    $("#curl").val(response.curl);
                }
            })
            });
            </script>


@endsection
