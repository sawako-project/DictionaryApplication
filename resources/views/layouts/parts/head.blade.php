<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Dectionary') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
   
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- Bootstrap icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" type="text/css" media="all">

    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <!-- javascript,jQueryを有効にするもの -->
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script type="text/javascript" src="{{ asset('js/main.js') }}"></script>

    <!-- vendor -->
    <script src="https://unpkg.com/@yaireo/tagify"></script>
    <script src="https://unpkg.com/@yaireo/tagify/dist/tagify.polyfills.min.js"></script>
    <link href="https://unpkg.com/@yaireo/tagify/dist/tagify.css" rel="stylesheet" type="text/css" />

<style>

@import url('https://fonts.googleapis.com/css2?family=Ephesis&display=swap');
@import url('https://fonts.googleapis.com/css2?family=Kiwi+Maru&display=swap');


@import url('https://fonts.googleapis.com/css2?family=M+PLUS+Rounded+1c&display=swap');
@import url('https://fonts.googleapis.com/css2?family=M+PLUS+1p&display=swap');

/* font-family: 'Ephesis', cursive;筆記体
font-family: 'Scheherazade New', serif;筆記体寄り、英字
font-family: 'Inconsolata', monospace;丸、英字

font-family: 'Sawarabi Mincho', sans-serif;明朝、日本語
font-family: 'Shippori Mincho', serif; 明朝、日本語
font-family: 'Noto Serif JP', serif;明朝寄り、日本語
font-family: 'M PLUS 1p', sans-serif;
font-family: 'Kiwi Maru', serif;❗️
font-family: 'M PLUS Rounded 1c', sans-serif;丸、日本語
*/
/* body {
    background-color: pink;
} */
</style>
</head>
<body>