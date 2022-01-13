<style>

/* user-event-post */
/* .user-event-post .card {
    margin-top: 50px;
} */

</style>

<div class="card event-item text-center mb-5 pop-card">
    <div class="card-body">
        <!-- <h5 class="card-title">その作成するグループタグに入れる表現についての説明(内容): {{-- $event->event_text --}}</h5> -->
        <h5 class="card-title">イベント</h5>
        <p class="card-text">お題・テーマ: ｢<strong>{{ $event->event_text }}</strong>｣<span>な状況(時)の表現</span></p>
        <p class="card-text">イベントタイプ: {{ $event->eventLabel() }}</p>
        <p class="card-text"><i class="bi bi-person-fill"></i>イベント発案者: {{ ($event->user) ? $event->user->name : "-"}}</p>
        <p class="card-text">
            <small class="text-muted"><time datetime="{{ $event->updated_at->format('Y-m-d H:i:s') }}">作成日時: {{ $event->updated_at->format("Y-m-d H:i:s") }}</time></small>
        </p>
        <p class="card-text">イベント終了日時: {{ $event->schedule_end }}</p>
        <p><span class="badge badge-primary">エントリー数: {{ $event->posts->count() }}件</span></p>
    </div>
    @if (Session::has('admin_auth'))
    <p class="text-right"><a href="{{ url('/admin/event/detail', ['event_id' => $event->id]) }}">このイベントに参加する<span><i class="bi bi-arrow-right-short"></i></span></a></p>
    @else
    <p class="text-right"><a href="{{ url('/event/detail', ['event_id' => $event->id]) }}">このイベントに参加する<span><i class="bi bi-arrow-right-short"></i></span></a></p>
    @endif
</div>