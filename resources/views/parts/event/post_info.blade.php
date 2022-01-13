<style>

/* user-event-post */
/* .user-event-post .card {
    margin-top: 50px;
} */

</style>

<!-- <div class="card post-item text-center mb-5 pop-card"> -->
    <div class="card-body">
        <!-- <h5 class="card-title">その作成するグループタグに入れる表現についての説明(内容): {{-- $event->event_text --}}</h5> -->
        <h5 class="card-title">エントリー</h5>
        <p class="card-text">エントリー: <strong>{{ $post->post_text }}</strong></p>
        <p class="card-text"><i class="bi bi-person-fill"></i>エントリーユーザー: {{ ($post->user) ? $post->user->name : "-"}}</p>
        <p class="card-text">
            <time datetime="{{ $post->updated_at->format('Y-m-d H:i:s') }}">作成日時: {{ $post->updated_at->format("Y-m-d H:i:s") }}</time>
        </p>
        <!-- <p class="card-text"><i class="bi bi-hand-thumbs-up-fill"></i>いいね!{{-- $post->votes_count --}}個</p>
        <p><i class="bi bi-hand-thumbs-up-fill"></i><span class="badge badge-primary">いいね!{{-- $post->votes_count --}}個</span></p> -->
    </div>
    @if (Session::has('admin_auth'))
    <p class="text-right"><a href="{{ route('admin.event.post.detail', ['event_post_id' => $post->id]) }}">エントリー詳細<span><i class="bi bi-arrow-right-short"></i></span></a></p>
    @else
    <p class="text-right"><a href="{{ url('/event/post/detail', ['event_post_id' => $post->id]) }}">エントリー詳細<span><i class="bi bi-arrow-right-short"></i></span></a></p>
    <!-- <p class="text-right"><a href="{{-- url('/event/post/detail', ['event_id' => $post->id,'event_post_id' => $post->id]) --}}">エントリー詳細<span><i class="bi bi-arrow-right-short"></i></span></a></p> -->
    @endif

<!-- </div> -->

<!--  -->

<!-- <div class="card base-card post-item mb-5"> -->
    <!-- <div class="card-header">エントリー</div>
    <div class="card-body">
        <ul class="list-group list-group-flush">
            <li class="list-group-item">エントリー: <strong>{{-- $post->post_text --}}</strong></li>
            <li class="list-group-item"><i class="bi bi-person-fill"></i>エントリーユーザー: {{-- ($post->user) ? $post->user->name : "-"--}}</li>
            <li class="list-group-item"><time datetime="{{-- $post->updated_at->format('Y-m-d H:i:s') --}}">作成日時: {{-- $post->updated_at->format("Y-m-d H:i:s") --}}</time></li> -->
            <!-- <li class="list-group-item"><i class="bi bi-hand-thumbs-up-fill"></i>いいね!{{-- $post->votes_count --}}個</li>
            <li class="list-group-item"><i class="bi bi-hand-thumbs-up-fill"></i><span class="badge badge-primary">いいね!{{-- $post->votes_count --}}個</span></li> -->
            <!-- <li class="list-group-item"><a href="{{-- url('/event/post/detail', ['event_post_id' => $post->id]) --}}">エントリー詳細<span><i class="bi bi-arrow-right-short"></i></span></a></li>
        </ul>
    </div>
    <hr/> -->
<!-- </div> -->
<!--  -->
