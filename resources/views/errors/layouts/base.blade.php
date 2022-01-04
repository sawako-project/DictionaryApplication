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

</body>
</html>