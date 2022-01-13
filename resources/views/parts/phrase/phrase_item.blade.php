<div class="item_box">
    <p class="card-text">表現: {{ $phrase->phrase }}</p>
    <p class="card-text">カテゴリ:
    @foreach($phrase->phraseCategories as $phraseCategory)
    <!-- <p class="card-text"><a href="{{-- route('phrase.category', ['category' => $phraseCategory->phrase_category]) --}}" class="btn btn-secondary">{{-- $phraseCategory->phrase_category --}}</a></p> -->
    {{ $phraseCategory->phrase_category }}
    @endforeach
    </p>
    <p class="card-text">タグ:
    @foreach($phrase->phraseTags as $phraseTag)
        {{ $phraseTag->phrase_tag }}
    @endforeach
    </p>
    <p class="card-text"><i class="bi bi-person-fill"></i>:{{ ($phrase->user) ? $phrase->user->name : "-"}}</p>
    <p class="card-text">作成日時: {{ $phrase->updated_at }}</p>
</div>