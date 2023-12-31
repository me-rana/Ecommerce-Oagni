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
          @if (session('message'))
          <div class="alert alert-primary alert-dismissible fade show" role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            <strong>Success!</strong> {{session('message')}}
          </div>
          @endif
        

          <div class="container bg-white card">
            <div class="py-5">
                <h4 class="text-center"><b>{{$title}}</b></h4>
            <p class="text-center">Please fill all the info for better understanding.</p>
            </div>
            <form action="{{$submission}}" method="post" enctype='multipart/form-data'>
                @csrf
                <div class="mb-3">
                    <label for="" class="form-label">Title</label>
                    <input type="text" name="title" id="title" value="{{$getPost->title ??  old('title') ?? ''}}" class="form-control" placeholder="" aria-describedby="helpId">
                    <small><span class="text-danger"> @error('title') {{$message}} @enderror </span></small>
                  </div>
                  @if (Route::currentRouteName() == 'admin.blog.updatedPost')
                    <input type="hidden" name="post_id" value="{{ $post_id }}">
                  @endif
                  
                  <div class="mb-3">
                    <label for="" class="form-label">Post Slug</label>
                    <input type="text" name="slug" id="slug" value="{{$getPost->slug ?? old('slug') ?? ''}}" class="form-control" placeholder="" aria-describedby="helpId" disabled>
                    <small><span class="text-danger"> @error('slug') {{$message}} @enderror </span></small>
                  </div>
                  <div class="mb-3">
                    <label for="" class="form-label">Post Status</label>
                    <select class="form-select form-select" name="status" id="">
                        <option value="0" @if (Route::currentRouteName() == 'admin.blog.updatePost' && $getPost->status == 0) selected @endif>Unpublished</option>
                        <option value="1" @if (Route::currentRouteName() == 'admin.blog.updatePost' && $getPost->status == 1) selected @endif>Published</option>
                    </select>
                    <small><span class="text-danger"> @error('status') {{$message}} @enderror </span></small>
                  </div>
                  <div class="mb-3">
                    <label for="" class="form-label">Category</label>
                    <select class="form-select form-select" name="category" id="">
                        @if (count($categories) > 0)
                            @foreach ($categories  as $category)
                            <option value="{{$category->id}}" @if (Route::currentRouteName()== 'admin.blog.updatePost') {{ ( $getPost->category == $category->id ) ? 'selected' : '' }} @endif>{{$category->cname}}</option>
                            @endforeach
                        @endif

                    </select>
                    <small><span class="text-danger"> @error('category') {{$message}} @enderror </span></small>
                  </div>
                  <div class="mb-3">
                    <label for="" class="form-label">Choose file</label>
                    <input type="file" class="form-control" name="image" id="" placeholder="" aria-describedby="fileHelpId">
                    <div id="fileHelpId" class="form-text">Image is used as cover photo</div>
                  </div>
                  <div class="mb-3">
                    <label for="" class="form-label">Description of the Post</label>
                    <textarea class="form-control" name="content" id="editor">@php
                        echo html_entity_decode($getPost->content ?? old('content') ?? '')
                    @endphp</textarea>
                    <small><span class="text-danger"> @error('content') {{$message}} @enderror </span></small>
                  </div>
                  <div class="mb-3">
                    <label for="" class="form-label">Tag</label>
                    <input type="text" name="tag" id="" value="{{$getPost->tag ?? '' }}"  class="form-control" placeholder="" aria-describedby="helpId">
                    <small><span class="text-danger"> @error('tag') {{$message}} @enderror </span></small>
                  </div>
                  <div class="py-4">
                  <input type="submit" value="Create" class="btn btn-primary">
                  </div>
            </form>
          </div>



          <script src="https://cdn.ckeditor.com/ckeditor5/39.0.2/classic/ckeditor.js"></script>
          <script>
            ClassicEditor
                .create( document.querySelector( '#editor' ) )
                .catch( error => {
                    console.error( error );
                } );
        </script>

<script>
    $("#title").change(function(){
    $.ajax({
        url: '{{ route("admin.blog.getSlug") }}',
        type: 'get',
        data: {title : $(this).val()},
        datatype: 'json',
        success: function(response){
            $("#slug").val(response.slug);
        }
    })
    });
    </script>



@endsection
