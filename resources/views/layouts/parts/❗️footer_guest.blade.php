<!-- Footer -->
<footer class=" text-center text-white" style="background-color:#333333;">
<!-- Grid container -->
    <div class="container">
<!-- <div class="container p-4"> -->

    <!-- Section: Links -->
        <section>
    <!--Grid row-->
            <div class="row text-white">

<!--Grid column-->
                @guest
                <div class="col-lg-4 col-md-6 mb-4 mb-md-0">
                    <h5 class="text-uppercase">Dictionary.</h5>
                    <ul class="list-unstyled mb-0">
                        <li><a href="{{ url('/') }}" class="">トップ</a></li>
                        <!-- <li><a href="{{-- url('/login') --}}" role="button"><button type="button" class="btn btn-primary rounded-pill pr-50" data-mdb-ripple-color="#ffffff" style="background-color:#d97fb5">ログイン</button></a></li>
                        <li><a href="{{-- url('/register') --}}" role="button"><button type="button" class="btn btn-primary rounded-pill" data-mdb-ripple-color="#ffffff" style="background-color:#d97fb5">会員登録</button></a></li> -->
                        <li><a href="{{ url('/login') }}">ログイン</a></li>
                        <li><a href="{{ url('/register') }}">会員登録</a></li>
                        <li><a href="{{ url('/event') }}">イベント</a></li>
                        <li><a href="{{ url('/search') }}">表現を探す</a></li>
                        <li><a href="{{ url('/phrase') }}">掲示板</a></li>
                        <!-- <li><a href="">使い方</a></li> -->
                        <!-- <li class="nav-item"><a class="nav-link" href="http://localhost:9000/./user/bookmark_list.php">ブックマーク(しおり)</a></li> -->
                    </ul>   
                </div>
                @endguest
                
                @auth
                <div class="col-lg-4 col-md-6 mb-4 mb-md-0">
                    <h5 class="text-uppercase">Dictionary.</h5>
                    <ul class="list-unstyled mb-0">
                        <li><a href="{{ url('/') }}" class="">ユーザートップ</a></li><!-- / -->
                        <li><a href="{{ url('/home') }}"><i class="bi bi-person-fill"></i> {{ auth()->user()->name }}</a></li>
                        <li><a href="{{ url('/event') }}">イベント</a></li>
                        <li><a href="{{ url('/logout') }}" class="" onclick="event.preventDefault();document.getElementById('logout-form').submit();">ログアウト</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                            </form>
                        </li>
                        <!-- <li><a href="">使い方</a></li> -->
                        <!-- <li class="nav-item"><a class="nav-link" href="http://localhost:9000/./user/bookmark_list.php">ブックマーク(しおり)</a></li> -->
                    </ul>   
                </div>
                @endauth
              
                <!--Grid column-->        
                <div class="col-lg-4 col-md-6 mb-4 mb-md-0">
                    <h5 class="text-uppercase">About(Dictionary.について)</h5>

                    <ul class="list-unstyled mb-0">
                        <li>
                            <a href="{{ url('/guide') }}" class="text-white">ご利用ガイド</a><!-- topにかくか？専用ページなんているか？ -->
                        </li>
                        <!-- <li>
                            <a href="#!" class="text-white">よくある質問</a>
                        </li> -->
                        <li>
                            <a href="{{ url('/rule') }}" class="text-white">利用規約</a>
                        </li>
                        <li>
                            <a href="{{ url('/contact') }}" class="text-white">お問い合わせ</a>
                        </li>
                    </ul>
                </div>
                
                @auth
                <!--Grid column-->
                <div class="col-lg-4 col-md-6 mb-4 mb-md-0">
                    <h5 class="text-uppercase">マイメニュー(MyMenu)</h5>
                    <ul class="list-unstyled mb-0">
                        <li><a href="{{ url('/') }}" class="">トップ</a></li><!-- / -->
                        <li><a href="{{ url('/home') }}"><i class="bi bi-person-fill"></i> {{ auth()->user()->name }} </a></li>
                        <li><a href="{{ url('/user/phrase/create') }}">表現登録</a></li>
                        <li><a href="{{ url('/user/phrase') }}">自分の表現</a></li>
                        <li><a href="{{ url('/user/bookmark_list') }}">ブックマーク(しおり)</a></li>
                        <!-- <li><a href="{{-- url('/user/phrase/everyone') --}}">他のユーザーの表現</a></li> -->
                        <li><a href="{{ url('/event') }}">イベント</a></li>
                        <li><a href="{{ url('/user/event/create') }}">イベント作成</a></li>
                        {{--@auth--}}
                        <li><a href="{{ url('/user/info') }}">プロフィール情報(設定)</a></li><!-- /user/plot '/user/info/{user_name}' -->
                        <!-- <li><a href="{{-- url('/user/phrase/favorite_list') --}}">お気に入り</a></li>  -->
                        <!-- <li><a href="{{-- url('/phrase') --}}">みんなの表現登録</a></li> -->
                        <!-- <li>
                            <a href="/"></a>
                        </li> -->                      
                        <li><a href="{{ url('/logout') }}" class="" onclick="event.preventDefault();document.getElementById('logout-form').submit();">ログアウト</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                            </form>
                        </li>
                        {{--@endauth--}}
                        <!--<li>
                            <a href="#!" class="text-white">Link 4</a>
                        </li>-->
                    </ul>
                </div>
<!--Grid column-->
@endauth
                
            </div>
        <!--Grid row-->
        </section>
<!-- Section: Links -->
    </div>
<!-- Grid container -->
<!-- Copyright -->
    <div class="text-center p-3" style="background-color: rgb(33,37,41)"><!--#212529 rgba(0, 0, 0, 0.2) -->
        © 2021 Copyright:
        {{ config('app.name', 'Laravel') }}
    </div>
<!-- Copyright -->

</footer>
<!-- Footer -->