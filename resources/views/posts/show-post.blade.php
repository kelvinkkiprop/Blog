@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ $post->title }}</div>

                <div class="card-body">

                    @if($post->image!=null)
                        <img class="card-img-top1" src="/storage/app/public/blog_images/{{$post->image}}" alt="Image">
                        {{-- <img class="card-img-top1" src="/storage/blog_images/{{$post->image}}" alt="Image"> --}}
                    @else
                        <img class="card-img-top1" src="/images/no_image_avail.png" height="120" alt="No image">
                    @endif
                    <h6 class="card-title1"><strong><a href="{{ route ('home.show', $post->id) }}">{{$post->title}}</a></strong></h6>
                    <span class="text-muted mt-1 mb-1"><strong>{{Carbon\Carbon::parse($post->created_at)->format('d M, Y')}}</strong></span>
                    <h6 class="card-subtitle mt-1 mb-1"><span class="badge badge-pill badge-warning">@isset($post->PostCategory){{$post->PostCategory->name}}@endisset</span></h6>
                    <p class="card-text">{!! $post->description !!}</p>

                    <form action="{{ route('home.update', $post->id) }}" method="POST">
                        @csrf

                        <!-- Conversations-->
                        <div class="form-group">
                            @isset($post->PostComments)
                                @foreach ($post->PostComments as $comment)
                                @if(Auth::user()!=null && $comment->uid!=Auth::user()->id)
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="card p-2">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <i class="rounded-circle fas fa-user-circle fa-fw"></i>
                                                    <strong>@if(App\User::find($comment->uid)!=null){{ App\User::find($comment->uid)->name }}@endif</strong>
                                                </div>
                                                <div class="col-md-4 text-right">
                                                    <span class="text-muted">{{ Carbon\carbon::parse($comment->created_at)->format('d M, y h:ia')  }}</span>
                                                </div>
                                                <div class="col-md-12">
                                                    <p>{{ $comment->comment }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6"></div>
                                </div>
                                @else
                                <div class="row">
                                    <div class="col-md-6"></div>
                                    <div class="col-md-6">
                                        <div class="card p-2">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <i class="rounded-circle fas fa-user-circle fa-fw"></i>
                                                    <strong>@if(App\User::find($comment->uid)!=null){{ App\User::find($comment->uid)->name }}@endif</strong>
                                                </div>
                                                <div class="col-md-4 text-right">
                                                    <span class="text-muted">{{ Carbon\carbon::parse($comment->created_at)->format('d M, y h:ia')  }}</span>
                                                </div>
                                                <div class="col-md-12">
                                                    <p>{{ $comment->comment }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                @endforeach
                            @endisset
                        </div>

                        @if(Auth::user())
                            <!-- Message -->
                            <div class="form-group mt-2">
                                <label for="comment"><strong>{{ __('Comment:') }}</strong></label>
                                <textarea id="comment" type="text" class="form-control{{ $errors->has('comment') ? ' is-invalid' : '' }}" name="comment"
                                    value="{{ old('comment') }}" placeholder="Enter comment" rows="2" required autofocus></textarea>
                                @if ($errors->has('comment'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('comment') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <button type="submit" class="pull-left btn btn-success">Send</button>
                        @endif
                        <a href="{{ route('home.index') }}" class="btn btn-outline-warning">@method('PUT')Cancel<a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
