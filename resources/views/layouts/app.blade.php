<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" href="{{ asset('favicon.png') }}" sizes="32x32">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="layout-top-nav">
    <div id="app" class="wrapper">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ route('index') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('tracker') }}">Трекер</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('search') }}">Поиск</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('terms') }}">
                                <span class="text-danger">Правила</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('groups') }}">Группы</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('users') }}">Пользователи</a>
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">Войти</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">Зарегистрироваться</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" style="padding-top: 0.2rem;" class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <img src="https://adminlte.io/themes/v3/dist/img/user1-128x128.jpg" alt="" class="img-circle img-sm">
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a href="{{ route('user', ['id' => Auth::user()->id ]) }}" class="dropdown-item">
                                        Профиль
                                    </a>
                                    <a href="{{ route('settings') }}" class="dropdown-item">
                                        Настройки
                                    </a>
                                    <a class="dropdown-item btn btn-outline-danger" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        Выход
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <i class="fas fa-comments"></i>
                                </a>

                                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a href="#" class="dropdown-item">
                                        <div class="media">
                                            <img src="https://adminlte.io/themes/v3/dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                                            <div class="media-body">
                                                <h3 class="dropdown-item-title">
                                                    Brad Diesel
                                                    <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                                                </h3>
                                                <p class="text-sm">Call me whenever you can...</p>
                                                <p class="text-sm text-muted"><i class="fas fa-clock mr-1"></i> 4 Hours Ago</p>
                                            </div>
                                        </div>
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a href="#" class="dropdown-item dropdown-footer">Посмотреть все</a>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <div class="content-wrapper">
            <div class="content-header">
                <div class="container">
                    <div class="row">
                        @auth
                        <div class="col-sm-12">
                            <form class="d-flex justify-content-center">
                                @csrf
                                <input
                                    class="form-control mr-2 col-sm-8 col-md-8"
                                    type="search"
                                    placeholder="поиск..."
                                    aria-label="Поиск"
                                >
                                <select class="form-control mr-2 col-sm-3 col-md-3">
                                    <option value="tracker.php#results" selected="selected"> по трекеру </option>
                                    <option value="search.php"> по форуму </option>
                                    <option value="tracker.php" class="hash"> по info_hash </option>
                                </select>
                                <button class="btn btn-outline-success ml-2 col-sm-0" type="submit">
                                    <i class="fa fa-search"></i>
                                </button>
                            </form>
                        </div>
                        @else
                            <div class="col-sm-12">
                                <div class="d-flex align-items-center">
                                    <div class="col-sm-2 ml-auto">
                                        <a class="btn btn-outline-danger" href="#">Регистрация</a>
                                    </div>
                                    <form method="POST" action="{{ route('login') }}" class="form-inline">
										@csrf
                                        <div class="form-group mx-2">
                                            <label for="loginName" class="pr-1">Имя:</label>
                                            <input
                                                id="loginName"
                                                class="form-control"
                                                type="text"
                                                placeholder="Имя"
                                                aria-label="Имя"
												name="username"
                                            >
                                        </div>
                                        <div class="form-group mx-2">
                                            <label for="password" class="pr-1">Пароль:</label>
                                            <input
                                                id="password"
                                                class="form-control"
                                                type="password"
                                                placeholder="Пароль"
                                                aria-label="Пароль"
												name="password"
                                            >
                                        </div>
										<div class="form-group mx-2">
											<button type="submit" class="btn btn-success">Войти</button>
										</div>
                                    </form>
                                    <div class="col-sm-2 mr-auto">
                                        <a class="btn btn-outline-primary" href="#">Забыли пароль?</a>
                                    </div>
                                </div>
                            </div>
                        @endauth
                    </div>
                </div>
            </div>
            <div class="content-header">
                @yield('navigation')
            </div>
            @if(\Illuminate\Support\Facades\Session::has('success'))
                <div class="content-header">
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h5><i class="icon fas fa-check"></i></h5>
                        {{ \Illuminate\Support\Facades\Session::get('success') }}
                    </div>
                </div>
            @endif
            <div class="content">
                @yield('content')
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
</body>
</html>
