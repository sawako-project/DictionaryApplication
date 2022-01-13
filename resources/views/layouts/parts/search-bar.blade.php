<style>

.search-area {
    font-family: 'Kiwi Maru', serif;
    width: 30%!important;
    /* display: flex!important; */
    text-align: center;
    margin: 0 auto;
    /* margin-top: 50%; */
    /* position: fixed;
    top: 55%;
    left: 35%; */
    border-radius: 100px;
}

</style>

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
    </div>
</div>