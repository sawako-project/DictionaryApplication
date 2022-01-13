<style>

</style>

<!-- phrase-list res-->
<div class="phrase-list">
    <dl>
        <dt>表現</dt>
        <dd><a href="{{ route('phrase.show', ['id' => $phrase->id]) }} ">{{ $phrase->phrase }}</a></dd>
        <dt>カテゴリ</dt>
        <dd>
        @foreach($phrase->phraseCategories as $phraseCategory)
            <a href="{{ route('phrase.category', ['category' => $phraseCategory->phrase_category]) }}" class="btn btn-secondary text-nowrap">{{ $phraseCategory->phrase_category }}</a>
        @endforeach
        </dd>
        <dt>タグ</dt>
        <dd>
        @foreach($phrase->phraseTags as $phraseTag)
            <a href="{{ route('phrase.tag', ['tag' => $phraseTag->phrase_tag]) }}" class="btn btn-outline-secondary text-nowrap">{{ $phraseTag->phrase_tag }}</a>
        @endforeach
        </dd>

        @if($phrase->user_id)

        <dt>作成ユーザー</dt>
        <dd>{{ ($phrase->user) ? $phrase->user->name : "-"}}{{-- $phrase->user->name --}}</dd>

        @auth
        @if($phrase->user_id == Auth::id())
        <dt>この表現を</dt>
        <dd style="float:left;">
            <a href="{{ route('user.phrase.edit',$phrase->id)}}" class="btn btn-primary text-nowrap text-white mb-1">編集</a>
            <form action="{{ route('user.phrase.destroy', $phrase->id)}}" method="post">
            @csrf
                <button class="btn btn-danger text-nowrap mb-1" type="submit" onclick="return confirm('削除しますか?');">削除</button>
            </form>
        </dd>
        @endif
        @endauth

        @endif

    </dl>
</div>
<!-- phrase-list res-->