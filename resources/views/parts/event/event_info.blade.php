<style>

/* user-event-post */
.user-event-post .card {
    margin-top: 50px;
}

</style>

<ul class="list-group list-group-flush">
    <li class="list-group-item">イベントID: {{$event->id}} </li>  
    <!-- <li class="list-group-item">イベントタイプ: {{-- $event->event_type --}}</li> -->
    <li class="list-group-item">イベントタイプ: {{ $event->eventLabel() }}</li>
    <li class="list-group-item">お題・テーマ: <strong>{{ $event->event_text }}</strong>｣な状況(時)の表現</li>
    <li class="list-group-item"><i class="bi bi-person-fill"></i> イベント発案者: {{ ($event->user) ? $event->user->name : "-"}}</li>
    <li class="list-group-item"><time datetime="{{ $event->updated_at->format('Y-m-d H:i:s') }}">作成日時: { $event->updated_at->format("Y-m-d H:i:s") }}</time></li>
    <li class="list-group-item">イベント終了: {{ $event->schedule_end }}</li>
</ul>