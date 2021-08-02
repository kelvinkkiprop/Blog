@extends('layouts.app')

@section('content')

    <!-- Content Header -->
    <section class="content-header">

        <div class="container">
            <div class="row">

                <!-- Left -->
                <div class="col-xl-8 col-lg-8 col-md-8 col-sm-8 col-xs-8 col-xl-4">

                    <!-- Posts -->
                    @if(count($posts)>0)
                    @foreach ($posts as $post)
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        @if($post->image!=null)
                                             <img class="card-img-top1" src="/storage/blog_images/{{$post->image}}" alt="Image">
                                            <img class="card-img-top1" src="{{env("UPLOADED_IMAGES_STORAGE_URL").$post->image}}" alt="Image">
                                        @else
                                            <img class="card-img-top1" src="{{ asset('images/no_image_avail.png') }}" height="120" alt="No image">
                                        @endif
                                    </div>
                                    <div class="col-md-9">
                                        <h6 class="card-title1"><strong><a href="{{ route ('home.show', $post->id) }}">{{$post->title}}</a></strong></h6>
                                        <span class="text-muted mt-1 mb-1"><strong>{{Carbon\Carbon::parse($post->created_at)->format('d M, Y')}}</strong></span>
                                        <h6 class="card-subtitle mt-1 mb-1"><span class="badge badge-pill badge-warning">@isset($post->PostCategory){{$post->PostCategory->name}}@endisset</span></h6>
                                        <span class="card-text">{!! substr($post->description, 0, 500) !!}...</span>
                                        <p>
                                            <a href="{{ route ('home.show', $post->id) }}" class="btn btn-success btn-sm mr-1">Read More</a>
                                            <a href="whatsapp://send?text={{ $post->title }}: {{ route ('home.show', $post->id) }}" class="btn btn-outline-dark btn-sm" data-action="share/whatsapp/share">Share via Whatsapp</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    @else
                        <div class="p-5">
                            <p class="text-center text-muted">No posts</p>
                        </div>
                    @endif
                    <p class="mt-1 text-center">
                        {{ $posts->links() }}
                    </p>
                </div>
                <!-- ./Left -->

                <!-- Right -->
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    <!-- Search -->
                    <div class="card p-3">
                        <form method="POST" action="{{ route ('home.store') }}">
                            @csrf
                            <div class="input-group">
                                <input id="search_term" type="text" class="form-control{{ $errors->has('search_term') ? ' is-invalid' : '' }}"
                                    name="search_term" value="{{ old('search_term') }}" required autofocus/>
                                <div class="input-group-append">
                                    <button class="input-group-text" type="submit">
                                        <i class="fa fa-search" aria-hidden="true"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Recent Posts -->
                    <div class="card p-3">
                        <h6><strong>Recent Posts</strong></h6>
                        <ul style="list-style-type:disc">
                            @if(count($recent_posts)>0)
                                @foreach ($recent_posts as $recent_post)
                                    <a href="{{ route ('home.show', $recent_post->id) }}"><li>{{$recent_post->title}}</li></a>
                                @endforeach
                            @else
                                <div class="p-5">
                                    <p class="text-center text-muted">No recent posts</p>
                                </div>
                            @endif
                        </ul>
                    </div>

                    <!-- Categories -->
                    <div class="card p-3">
                        <h6><strong>Categories</strong></h6>
                        <ul style="list-style-type:square">
                            @if(count($post_categories)>0)
                                @foreach ($post_categories as $category)
                                    <a href="{{ route ('home.edit', $category->id) }}"><li>{{$category->name}}</li></a>
                                @endforeach
                            @else
                                <div class="p-5">
                                    <p class="text-center text-muted">No post categories</p>
                                </div>
                            @endif
                        </ul>
                    </div>

                </div>
                <!-- ./Right -->

            </div>

        </div>

    </section>
    <!-- /.Content Main -->

@endsection
