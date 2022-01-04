@include("layouts.parts.head")

    @if(isset($show_mv) && $show_mv)<!-- $show_mvがあるものだけ画像、検索バーがある -->
        <div class="top-navbar">
            @include("layouts.parts.nav")
        </div>
        @include("layouts.parts.search-bar")
        <!--  -->
        <!-- <div id="backgroundImg">
   <h1 class="glowAnime">表現を見つけましょう。</h1>
   <p>- Let's share your dream. -</p>
 </div> -->
        <!--  -->
    @else<!--  $show_mvがないので画像、検索バーはない -->
        <div class="page-navbar">
            @include("layouts.parts.nav")
        </div>
    @endif

<div id="app">
    
@hasSection('header-title')
<div class="container">
<div class="row">
<div class="heading mb-5">
            <h2><strong><span class="under">@yield('header-title')</span></strong></h2>
        </div>
{{ Breadcrumbs::render(request()->route()->getName()) }}
    </div>
</div>
    @endif

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
@yield('content')
        </main>
</div>


@include("layouts.parts.footer")
