@extends('layouts.app')

@section('navigation')
    <div class="container">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">{{ $forum->title }}</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('index') }}">Главная</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('index') }}">{{ $forum->category->title }}</a></li>
                    <li class="breadcrumb-item active">{{ $forum->title }}</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
@endsection

@section('content')
    {{--Подфорумы--}}
    <div class="container mb-2">
        <div class="row">
            <div class="col-sm-6">
				<a href="{{ route('add-topic', ['forum' => $forum->id]) }}" class="btn btn-sm btn-outline-primary" title="Создать раздачу">
					<i class="far fa-file-archive"></i>
					Новый релиз
				</a>
            </div>
            <div class="col-sm-6 text-right">
                Pagination
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="text-muted">Форумы</h4>
                    </div>
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-sm-0">
                                <img class="center-block"
                                     src="{{ asset('images/folder_big.gif') }}"
                                     alt=""
                                >
                            </div>
                            <div class="col-sm-6">
                                <h4 class="text-muted">
                                    <a href="#" class="">Forum Title</a>
                                </h4>
                                <p class="mb-0">
                                    <span class="text-muted">description</span>
                                </p>
                            </div>
                            <div class="col-sm-1">
                                <dl class="text-center">
                                    <dt>Topics</dt>
                                    <dd>0</dd>
                                </dl>
                            </div>
                            <div class="col-sm-1">
                                <dl class="text-center">
                                    <dt>Posts</dt>
                                    <dd>0</dd>
                                </dl>
                            </div>
                            <div class="col-sm-3 text-center">
                                Lorem ipsum dolor sit amet.
                                <p class="text-muted">
                                    12-Окт-20 18:12 by <a href="#">admin</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--Топики--}}
    @if($forum->topics->first())
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="text-muted">Топики</h4>
                    </div>
                    <div class="card-body">
                        @foreach($forum->topics as $topic)
                            <div class="topic">
                                <div class="row align-items-center">
                                    <div class="col-sm-0">
										<i class="center-block far fa-file"></i>
                                        {{--<img class="center-block"
                                             src="{{ asset('images/folder.gif') }}"
                                             alt=""
                                        >--}}
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="torTopic">

                                    <span id="status-11" title="проверено">
										<i class="fas fa-check" style="color: green;"></i>
                                        {{--<span class="tor-icon tor-approved">√</span>--}}
                                    </span>·
                                            <a id="tt-11" href="{{ route('topic', ['topic' => $topic->id]) }}" class="torTopic tt-text">
                                                <b>{{ $topic->title }}</b>
                                            </a>
                                        </div>
                                        <p class="mb-0">
                                            <a href="{{ route('user', ['id' => $topic->author->id]) }}">{{ $topic->author->username }}</a>
                                        </p>
                                    </div>
                                    <div class="col-sm-1 text-center">
                                        <span style="color: #060!important;" title="Seeders"><b>0</b></span>
                                        <span class="med"> | </span>
                                        <span style="color: #800000!important;" title="Leechers"><b>0</b></span>
                                        <p class="mb-0">
                                            <a href="./dl.php?id=11" class="small" style="text-decoration: none">18,36&nbsp;GB</a>
                                        </p>
                                    </div>
                                    <div class="col-sm-1 text-center">
                                        1 | 1525
                                        <p class="mb-0">
                                            0
                                        </p>
                                    </div>
                                    <div class="col-sm-3 text-center">
                                        {{ $topic->lastPost->created_at->format('d.m.Y H:i') }}
                                        <p class="text-muted">
                                            <a href="{{ route('user', ['id' => 1]) }}">admin</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <div class="topic">
                            <div class="row align-items-center">
                                <div class="col-sm-0">
                                    <img class="center-block"
                                         src="{{ asset('images/folder.gif') }}"
                                         alt=""
                                    >
                                </div>
                                <div class="col-sm-6">
                                    <div class="torTopic">
                                    <span id="status-11" title="проверено">
                                        <span class="tor-icon tor-approved">√</span>
                                    </span>·
                                        <a id="tt-11" href="{{ route('topic', ['topic' => 1]) }}" class="torTopic tt-text">
                                            <b>123</b>
                                        </a>
                                    </div>
                                    <p class="mb-0">
                                        author
                                    </p>
                                </div>
                                <div class="col-sm-1 text-center">
                                    <span style="color: #060!important;" title="Seeders"><b>0</b></span>
                                    <span class="med"> | </span>
                                    <span style="color: #800000!important;" title="Leechers"><b>0</b></span>
                                    <p class="mb-0">
                                        <a href="./dl.php?id=11" class="small" style="text-decoration: none">18,36&nbsp;GB</a>
                                    </p>
                                </div>
                                <div class="col-sm-1 text-center">
                                    1 | 1525
                                    <p class="mb-0">
                                        0
                                    </p>
                                </div>
                                <div class="col-sm-3 text-center">
                                    Lorem ipsum dolor sit amet.
                                    <p class="text-muted">
                                        12-Окт-20 18:12 by <a href="{{ route('user', ['id' => 1]) }}">admin</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
@endsection
