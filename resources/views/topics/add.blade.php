@extends('layouts.app')

@section('navigation')
    <div class="container">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Начать новую тему</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('index') }}">Главная</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('index') }}">{{ $forum->category->title }}</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('forum', ['slug' => $forum->slug]) }}">{{ $forum->title }}</a></li>
                    <li class="breadcrumb-item active">Начать новую тему</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('add-topic', ['forum' => $forum->id]) }}" method="POST">
                            @csrf
                            {{ $errors }}
                            <div class="form-group">
                                <label for="topic-title">Тема</label>
                                <input id="topic-title" class="form-control @error('title') is-invalid @enderror" type="text" name="title" value="{{ old('title') }}">
                                @error('title')
                                <div class="invalid-feedback">
                                    {{ $errors->first('title') }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="topic-message">Сообщение</label>
                                <textarea class="form-control @error('message') is-invalid @enderror" name="message" id="topic-message" rows="18" cols="92">{{ old('message') }}</textarea>
                                @error('message')
                                <div class="invalid-feedback">
                                    {{ $errors->first('message') }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <div class="form-check form-check-inline">
                                    <label class="form-check-label" for="notify">Сообщать мне о получении ответа</label>
                                    <input class="form-check-input" style="margin-left: 0.3rem;" type="checkbox" id="notify" name="notify" checked="checked">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-check form-check-inline">
                                    <input id="topic-type-1" class="form-check-input" type="radio" name="type" value="0" checked>
                                    <label class="form-check-label" for="topic-type-1">Обычная</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input id="topic-type-2" class="form-check-input" type="radio" name="type" value="1">
                                    <label class="form-check-label" for="topic-type-2">Прилепленная</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input id="topic-type-3" class="form-check-input" type="radio" name="type" value="2">
                                    <label class="form-check-label" for="topic-type-3">Объявление</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="fileupload">Имя файла</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input name="fileupload" type="file" class="custom-file-input" id="fileupload" size="45" maxlength="262144">
                                        <label class="custom-file-label" for="fileupload">Выберите файл</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-primary">Предв. просмотр</button>
                                <button type="submit" class="btn btn-success">Отправить</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
