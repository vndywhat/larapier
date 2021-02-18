@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-9 pb-2">
                <a href="#" class="btn btn-outline-primary btn-xs">Последние сообщения</a> ·
                <a href="#" class="btn btn-outline-primary btn-xs">Мои сообщения</a> ·
                <a href="#" class="btn btn-outline-primary btn-xs">
                    <i class="fas fa-rss"></i>
                    Последние раздачи
                </a>
                <div class="btn-group float-right">
                    <button type="button" class="btn btn-outline-primary btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        Опции показа
                    </button>
                    <ul class="dropdown-menu" style="">
                        <li>
                            <a class="dropdown-item" href="#">Dropdown link</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">Dropdown link</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-12 col-md-9">
                @forelse($categories as $category)
                    <div class="card">
                        <div class="card-header">
                            <h4 class="text-muted">
                                {{ $category->title }}
                            </h4>
                        </div>
                        <div class="card-body">
                            @forelse($category->forums as $forum)
                            <div class="row align-items-center">
                                <div class="col-sm-0">
                                    <img class="center-block"
                                         src="{{ asset('images/folder_big.gif') }}"
                                         alt=""
                                    >
                                </div>
                                <div class="col-sm-6">
                                    <a href="{{ route('forum', ['slug' => $forum->slug]) }}">
                                        <h5>{{ $forum->title }}</h5>
                                    </a>
                                    <div class="nodeStats pairsInline mb-0">
                                        <dl>
                                            <dt>Тем:</dt>
                                            <dd>{{ $forum->topics_count }}</dd>
                                            <dt>Сообщ.:</dt>
                                            <dd>{{ $forum->posts_count }}</dd>
                                        </dl>
                                    </div>
                                    @if($forum->childs->first())
                                    <p class="subforums">

                                        @foreach($forum->childs as $child)
                                            <span class="sf_title">
                                                <a
                                                    href="#"
                                                    class="dot-sf"
                                                >
                                                    •
                                                </a>
                                                <a
                                                    href="{{ route('forum', ['slug' => $child->slug]) }}"
                                                    class="dot-sf"
                                                >
                                                    {{ $child->title }}
                                                </a>
                                            </span>
                                            <span class="sf_separator"></span>
                                        @endforeach
                                    </p>
                                    @endif
                                </div>
                                <div class="col-sm-4">
                                    @if($forum->lastPost)
                                    <div class="nodeLastPost">
                                        <h6 class="last_topic">
                                            Последнее:
                                            <a href="{{ route('topic', ['topic' => $forum->lastPost->topic->id]) }}#post-{{ $forum->lastPost->id }}"
                                               title="{{ $forum->lastPost->topic->title }}"
                                            >
                                                {{ $forum->lastPost->topic->title }}
                                            </a>
                                        </h6>
                                        <p class="last_post_time">
                                            <span class="last_author">
                                                <a href="{{ route('user', ['id' => $forum->lastPost->author->id]) }}">
                                                    {{ $forum->lastPost->author->username }}
                                                </a>,
                                            </span>
                                            <span class="last_time">
                                                {{ $forum->lastPost->created_at->format('d.m.Y H:s') }}
                                            </span>
                                        </p>
                                    </div>
                                    @else
                                        <div class="nodeLastPost">
                                            <h6 class="last_topic">
                                                Сообщений нет
                                            </h6>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            @empty
                                <div class="row align-items-center">
                                    <div class="col-sm-12">
                                        Форумов нет
                                    </div>
                                </div>
                            @endforelse
                        </div>
                    </div>
                @empty
                    <div class="card">
                        <div class="card-body">
                            <div class="text-center">
                                Категорий нет
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>
            <div class="col-sm-4 col-md-3">
                <div class="card">
                    <div class="card-header">
                        <h4 class="text-muted">Block #1</h4>
                    </div>
                    <div class="card-body">
                        123
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
