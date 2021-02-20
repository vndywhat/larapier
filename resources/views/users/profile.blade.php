@extends('layouts.app')

@section('title', 'Профиль пользователя ' . $profile->username)

@section('navigation')
    <div class="container">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Профиль пользователя {{ $profile->username }}</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('index') }}">Главная</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('users') }}">Пользователи</a></li>
                    <li class="breadcrumb-item active">{{ $profile->username }}</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <!-- Profile Image -->
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <img class="profile-user-img img-fluid img-circle"
                                 src="https://adminlte.io/themes/v3/dist/img/user4-128x128.jpg"
                                 alt="User profile picture"
                            >
                        </div>

                        <h3 class="profile-username text-center">
                            {{ $profile->username }}
                        </h3>

                        <p class="text-muted text-center">Администратор</p>

                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>Рейтинг</b> <span class="float-right">Нет (DL < 10 GB)</span>
                            </li>
                            <li class="list-group-item">
                                <b>Тем</b> <a class="float-right">{{ $profile->topics_count }}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Сообщений</b> <a class="float-right">{{ $profile->posts_count }}</a>
                            </li>
                        </ul>
                        <a href="#" class="btn btn-primary btn-block">
                            <b>Отправить ЛС</b>
                        </a>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Как связаться с {{ $profile->username }}</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        @if($profile->email)
                            <strong>
                                <i class="fas fa-envelope-open mr-1"></i> Адрес e-mail
                            </strong>
                            <p class="text-muted">
                                {{ $profile->email }}
                            </p>
                            <hr>
                        @endif

                        @if($profile->telegram)
                            <strong><i class="fab fa-telegram mr-1"></i> Telegram</strong>
                            <p class="text-muted">
                                {{ $profile->telegram }}
                            </p>
                            <hr>
                        @endif

                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                            <li class="nav-item">
                                <a class="nav-link active" href="#activity" data-toggle="tab">
                                    Основное
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="active tab-pane" id="activity">
                                <ul class="list-group list-group-unbordered mb-3">
                                    <li class="list-group-item">
                                        <b>Зарегистрирован</b> <span class="float-right text-muted">{{ $profile->created_at }}</span>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Пол</b> <span class="float-right text-muted">{{ $profile->gender }}</span>
                                    </li>
                                </ul>
                                <table class="table table-bordered table-sm">
                                    <thead>
                                    <tr>
                                        <th class="text-center"></th>
                                        <th class="text-center">Скачано</th>
                                        <th class="text-center">Отдано</th>
                                        <th class="text-center">На своих</th>
                                        <th class="text-center">На редких</th>
                                        <th class="text-center">Сидбонус</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td class="text-center">Сегодня</td>
                                        <td class="text-center"><span class="text-danger">0 B</span></td>
                                        <td class="text-center"><span class="text-success">0 B</span></td>
                                        <td class="text-center"><span class="text-success">0 B</span></td>
                                        <td class="text-center"><span class="text-success">0 B</span></td>
                                        <td class="text-center"><span class="text-primary">0.00</span></td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">Вчера</td>
                                        <td class="text-center"><span class="text-danger">0 B</span></td>
                                        <td class="text-center"><span class="text-success">0 B</span></td>
                                        <td class="text-center"><span class="text-success">0 B</span></td>
                                        <td class="text-center"><span class="text-success">0 B</span></td>
                                        <td class="text-center"><span class="text-primary">0.00</span></td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">Всего</td>
                                        <td class="text-center"><span class="text-danger text-bold">0 B</span></td>
                                        <td class="text-center"><span class="text-success text-bold">0 B</span></td>
                                        <td class="text-center"><span class="text-success text-bold">0 B</span></td>
                                        <td class="text-center"><span class="text-success text-bold">0 B</span></td>
                                        <td class="text-center"><span class="text-primary text-bold">{{ $profile->points }}</span></td>
                                    </tr>
                                    <tr>
                                        <td class="text-center" colspan="1">Скорость</td>
                                        <td class="text-center" colspan="2">Загрузка: 0 KB/s</td>
                                        <td class="text-center" colspan="2">Отдача: 0 KB/s</td>
                                        <td class="text-center" colspan="1"><a href="#">Обменять</a></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                    </div><!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
@endsection
