<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>{{ config('app.name', 'Laravel') }}</title>

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}" defer></script>

<!-- Fonts -->
<link rel="dns-prefetch" href="//fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

<!-- FontAwesome -->
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

<!-- Bootstrap icon -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">

<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

<!-- Styles -->
<link href="{{ asset('css/app.css') }}" rel="stylesheet">

<!-- javascript,jQueryを有効にするもの -->
<script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<!-- <script type="text/javascript" src="{{-- asset('js/main.js') --}}"></script>  -->

<!-- vendor -->
<script src="https://unpkg.com/@yaireo/tagify"></script>
<script src="https://unpkg.com/@yaireo/tagify/dist/tagify.polyfills.min.js"></script>
<link href="https://unpkg.com/@yaireo/tagify/dist/tagify.css" rel="stylesheet" type="text/css" /> 

<style>

@import url('https://fonts.googleapis.com/css2?family=Noto+Serif+JP&display=swap');

li {
    list-style: none;
}

a {
    text-decoration: none; 
    color: inherit;
}

.display-3 {
    font-family: 'Noto Serif JP', serif;
}

.heading {
    font-family: 'Noto Serif JP', serif;
}

p {
    font-family: 'Noto Serif JP', serif;
}

.card-header {
    font-weight: bold;
}

.table {
    font-family: 'Kiwi Maru', serif!important;
}

/* card */
.base-card,.pop-card {
    font-family: 'Kiwi Maru', serif;
    overflow: hidden;
    box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
    border-radius: 10px!important;
    position:relative;
    transition:box-shadow 0.3s, transform 0.3s;
}

</style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ route('admin.top') }}">
                    {{ config('app.name', 'Laravel') }}管理者ページ
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto">
                    @if (Session::has('admin_auth'))
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                管理者
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <ul>
                                    <li class="dropdown-item">
                                        <a href="{{ route('admin.top') }}">管理者トップ</a>
                                    </li>
                                    <li class="dropdown-item">
                                        <a href="{{route('admin.phrase.index')}}">管理者表現一覧</a>
                                    </li>
                                    <li class="dropdown-item">
                                        <a href="{{route('admin.phrase_category.index')}}">管理者カテゴリ一覧</a>
                                    </li>
                                    <li class="dropdown-item">
                                        <a href="{{route('admin.event.index')}}">管理者イベント一覧</a>
                                    </li>
                                    <li class="dropdown-item">
                                        <a  href="{{ url('admin/logout') }}" style=""
                                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                        {{ __('ログアウト') }}
                                        </a>
                                        <form id="logout-form" action="{{ url('admin/logout') }}" method="POST" class="d-none">
                                        @csrf
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin/login') }}">{{ __('Login') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/') }}">{{ __('Dictionary.サイトトップ') }}</a>
                        </li>
                    @endif
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>

</body>
</html>