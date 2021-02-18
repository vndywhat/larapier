@extends('layouts.app')

@section('navigation')
    <div class="container">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">{{ $topic->title }}</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('index') }}">Главная</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('index') }}">{{ $topic->forum->category->title }}</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('forum', ['slug' => $topic->forum->slug]) }}">{{ $topic->forum->title }}</a></li>
                    <li class="breadcrumb-item active">{{ $topic->title }}</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12 pb-2">
                <div class="float-left">
					<a class="btn btn-sm btn-outline-primary" href="#reply-message" title="Ответить на тему">
						<i class="fas fa-reply"></i>
						Ответить на тему
					</a>
                    {{--<a href="posting.php?mode=reply&amp;t=1">
                        <img src="{{ asset('images/reply.gif') }}" alt="Ответить на тему">
                    </a>--}}
                </div>
                <div class="float-right">
                    {{ $posts->links() }}
                </div>
            </div>
            <div class="col-sm-12">
                @foreach($posts as $post)
					@include('topics.partials.posts.index', ['topic' => $topic, 'post' => $post])
                @endforeach
            </div>
        </div>
		@include('topics.partials.quick-reply', ['topic' => $topic])
    </div>
@endsection
