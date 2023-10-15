@extends('backend.admin.layout.admin')
@section('main-content')

        <div class="pagetitle">
            <h1>Posts</h1>
            <nav>
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                <li class="breadcrumb-item active">Posts</li>
              </ol>
            </nav>
          </div><!-- End Page Title -->
          @include('backend.admin.layout.message-notify')
          <div class="row">
            @if(count($posts) > 0)
                @foreach ($posts as $post)
                <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                    <div class="card py-2">
                        <img src="../../storage/image/{{$post->image_path}}" height="200px" alt="Avatar" style="width:100%">
                        <div class="container">
                          <h4 class="text-center"><b>{{$post->title}}</b></h4>
                          <p class="text-justify">
                            @php echo Str::words($post->content,15);; @endphp
                          </p>
                          <p class="text-center"> Author : <b> {{$post->name}} </b> <br>
                            Status : @if ($post->status == 1)
                                Published
                                @else
                                Unpublished
                            @endif
                            <br>
                            Category : {{$post->cname}} <br>
                            Tags : {{$post->tag}}

                        </p>
                          <div class="row">

                            <div class="col-4"><a href="../../../blog/{{$post->slug}}" rel="noopener noreferrer"><button class="btn btn-success">View</button></a></div>
                            <div class="col-4"><a href="../../admin/blog/update-post/{{$post->id}}" rel="noopener noreferrer"><button class="btn btn-secondary">Edit</button></a></div>
                            <div class="col-4"><a href="../../admin/blog/delete-post/{{$post->id}}" rel="noopener noreferrer"><button class="btn btn-danger">Delete</button></a></div>
                          </div>



                        </div>
                      </div>
                </div>
                @endforeach
            @endif
          </div>





@endsection
