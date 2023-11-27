@extends('frontend.layout.main')
@section('main-section')

     <!-- Breadcrumb Section Begin -->
     <section class="breadcrumb-section set-bg" data-setbg="../assets/img/breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Blog</h2>
                        <div class="breadcrumb__option">
                            <a href="../">Home</a>
                            <span>Blog</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Blog Section Begin -->
    <section class="blog spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-5">
                    <div class="blog__sidebar">
                        <div class="blog__sidebar__search">
                            <form action="{{route('blogSearch')}}">
                                <input type="text" name="title" placeholder="Search...">
                                <button type="submit"><span class="icon_search"></span></button>
                            </form>
                        </div>
                        <div class="blog__sidebar__item">
                            <h4>Categories</h4>
                            @if (count($blogCategories)  > 0)
                            <ul>
                                @foreach ($blogCategories as $blogCategory)
                                <li><a href="../blog-category/{{$blogCategory->curl}}">{{$blogCategory->cname}} </a></li>
                                @endforeach
                            </ul>

                            @endif
                        </div>
                        <div class="blog__sidebar__item">
                            <h4>Recent News</h4>
                            <div class="blog__sidebar__recent">
                               @if (count($posts_latest) > 0)
                               @foreach ($posts_latest as $latest_post)
                               <a href="#" class="blog__sidebar__recent__item">
                                <div class="blog__sidebar__recent__item__pic">
                                    <img style="border: 1px solid #f5f5f5" src="../../{{$latest_post->image_path}}" alt="" width="100px" height="60px">
                                </div>
                                <div class="blog__sidebar__recent__item__text">
                                    <h6>{{$latest_post->title}}</h6>
                                    <span> {{$latest_post->created_at->format('j F, Y')}}</span>
                                </div>
                            </a>
                               @endforeach

                               @endif
                            </div>
                        </div>
                        <div class="blog__sidebar__item">
                            <h4>Search By</h4>
                            <div class="blog__sidebar__item__tags">
                                <a href="#">Apple</a>
                                <a href="#">Beauty</a>
                                <a href="#">Vegetables</a>
                                <a href="#">Fruit</a>
                                <a href="#">Healthy Food</a>
                                <a href="#">Lifestyle</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-md-7">
                    <div class="row">

                            @if (count($posts) > 0)

                            @foreach ($posts as $post)
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="blog__item">
                                    <div class="blog__item__pic">
                                        <img style="border: 1px solid #f5f5f5" src="../../{{$post->image_path}}" alt="" height="200px">
                                    </div>
                                    <div class="blog__item__text">
                                        <ul>
                                            <li><i class="fa fa-calendar-o"></i> {{$post->created_at->format('j F, Y')}}</li>
                                            <li><i class="fa fa-comment-o"></i> {{$post->writer}}</li>
                                        </ul>
                                        <h5><a href="#">{{$post->title}}</a></h5>
                                        <p>@php echo Str::words($post->content,15);; @endphp  </p>
                                        <a href="../blog/{{$post->slug}}" class="blog__btn">READ MORE <span class="arrow_right"></span></a>
                                    </div>
                                </div>
                            </div>

                            @endforeach
                        </div>
                            @else
                            <div class="col-lg-12 py-3">
                                <center><h3>Nothing Found</h3>
                                    <p>We could not found any posts.</p></center>
                            </div>
                        @endif

                        <div class="col-lg-12">
                            @if (Route::currentRouteName() == 'blog')
                                {{$posts->links('pagination::bootstrap-5')}}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Blog Section End -->

@endsection
