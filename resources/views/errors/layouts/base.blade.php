<!DOCTYPE html>
<html lang="ja">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

<head>
  <meta charset="UTF-8">
  <title>@yield('title')</title>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Kiwi+Maru&display=swap');
    .error-wrap {
      margin: auto;
      padding: 5px 20px;
      /* width: 300px; */
      /* display: inline-block; */
      /* border: 1px solid #dcdcdc;
      box-shadow: 0px 0px 8px #dcdcdc; */
      font-family: 'Kiwi Maru', serif;
      display: flex;
      justify-content: center
    }
    h1 { font-size: 18px; }
    p { margin-left: 10px; font-size: 12px; }
    .error-wrap a {
      display: flex;
      justify-content: center
    }
    .error-wrap button {
      display: flex;
      justify-content: center
    }
  </style>
</head>
<body>

{{--<main class="py-4 col">
            @yield('content')
        </main>--}}

<div class="error-wrap">
  <section>
    <h1>@yield('title')</h1>
    <p class="error-message">@yield('message')</p>
    <p class="error-detail">@yield('detail')</p>
    @yield('link')
  </section>
</div>

<!-- スクロールトップ -->
<div id="preloader"></div>
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

      <!-- Footer -->
      <footer class=" text-center text-white" style="background-color:#333333;">
    <!-- Copyright -->
        <div class="text-center p-3" style="background-color: rgb(33,37,41)"><!--#212529 rgba(0, 0, 0, 0.2) -->
            © 2022 Copyright:
            {{ config('app.name', 'DictionaryApplication') }}
        </div>
    <!-- Copyright -->
    </footer>
    <!-- Footer -->

</body>
</html>