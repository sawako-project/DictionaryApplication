@include("layouts.parts.head")
<!-- $show_mvがあるものだけ画像、検索バーがある -->
@if(isset($show_mv) && $show_mv)
<div class="top-navbar">
   @include("layouts.parts.nav")
</div>
<div id="backgroundImg">
   <h1 class="glowAnime">表現を見つけましょう。</h1>
   {{--@include("layouts.parts.search-bar")--}}
</div>
@else
<div class="page-navbar">
   @include("layouts.parts.nav")
</div>
@endif

<style>
/* .search-area {
    font-family: 'Kiwi Maru', serif;
    width: 30%!important;
    text-align: center;
    margin: 0 auto;
    position: fixed;
    top: 55%;
    left: 35%;
    border-radius: 100px;
} */
</style>
<div id="app">
 
<!-- @if(session()->get('success'))
          <div class="alert alert-success">
          {{-- session()->get('success') --}}
          </div>
          @endif -->
<!-- @if ($errors->any())
          <div class="alert alert-danger">
              <ul>
                  @foreach ($errors->all() as $error)
                  <li>{{-- $error --}}</li>
                  @endforeach
              </ul>
          </div><br />
          @endif -->
          <main class="py-4 col">
    <div class="container">
        <div class="row">

        @hasSection('header-title')

        {{ Breadcrumbs::render(request()->route()->getName()) }}

        <div class="heading mb-5">
            <h2><strong><span class="under">@yield('header-title')</span></strong></h2>
        </div>
        @endif
        
        </div>
    </div>
   
    @yield('content')
    </main>
</div>

@include("layouts.parts.footer")