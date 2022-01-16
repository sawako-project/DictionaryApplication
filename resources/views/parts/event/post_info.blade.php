<div class="card-body">
    <h5 class="card-title">エントリー</h5>
    <p class="card-text">エントリー: <strong>{{ $post->post_text }}</strong></p>
    <p class="card-text"><i class="bi bi-person-fill"></i>エントリーユーザー: {{ ($post->user) ? $post->user->name : "-"}}</p>
    <p class="card-text">
        <time datetime="{{ $post->updated_at->format('Y-m-d H:i:s') }}">作成日時: {{ $post->updated_at->format("Y-m-d H:i:s") }}</time>
    </p>
</div>
@if (Session::has('admin_auth'))
<p class="text-right"><a href="{{ route('admin.event.post.detail', ['event_post_id' => $post->id]) }}">エントリー詳細<span><i class="bi bi-arrow-right-short"></i></span></a></p>
@else
<p class="text-right"><a href="{{ url('/event/post/detail', ['event_post_id' => $post->id]) }}">エントリー詳細<span><i class="bi bi-arrow-right-short"></i></span></a></p>
@endif