<!-- <h1 class="card-title glowAnime">表現を見つけましょう。</h1> -->

<div id="backgroundImg"><!--  backgroundImg-->
   <h1 class="glowAnime">表現を見つけましょう。</h1>
   <!-- <p>- Let's share your dream. -</p> -->

        <div class="search-area">
        <div class="search-area-inner">
                <form action="{{url('/search_phrases')}}" method="get" name="search">
                <div id="search" class="form-group">
                        <div class="input-group">
                            <input type="text" name="keyword" value="{{ @$keyword }}" class="form-control" placeholder="言葉を入力して検索する" ><!--form-search {{-- @//$keyword --}}-->
                            <div class="input-group-append">
                                <button class="btn btn-light text-dark" type="submit"><span><i class="fas fa-search"></i></span></button><!--button class="btn-search"-->
                            </div>
                        </div>
                    </div>
                </form>
                </div><!--dictionary-topの<div class="search-area-inner">-->
        </div><!-- dictionary-topの<div class="search-area"> -->
</div>
