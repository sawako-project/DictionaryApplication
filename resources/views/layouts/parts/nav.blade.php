<nav id="main-nav" class="navbar fixed-top navbar-expand-lg navbar-dark">

    <a class="navbar-brand" href="{{ url('/') }}">Dictionary.</a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">

        <ul class="navbar-nav ml-auto">
       
            @guest
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/login') }}">ログイン</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/register') }}">会員登録</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ url('/search') }}">表現を探す</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/phrase') }}">表現を見る</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/event') }}">イベント</a>
            </li>

            <li class="nav-item dropdown">

                <a class="nav-link dropdown-toggle" href="{{ url('/') }}" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                About(Dictionaryについて)
                </a>

                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ url('/guide') }}">ご利用ガイド</a>
                    <a class="dropdown-item" href="{{ url('/rule') }}">利用規約</a>
                    <a class="dropdown-item" href="{{ route('about.contact.create') }}">お問い合わせ</a>
                </div>
            </li>

            @endguest

            @auth
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/home') }}"><i class="bi bi-person-fill"></i> {{ auth()->user()->name }} </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/logout') }}" class="" onclick="event.preventDefault();document.getElementById('logout-form').submit();">ログアウト</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                    </form>
            </li>
            @endauth

        </ul>
    </div>
</nav>