@extends('layouts.dictionary',["title"=>"Dectionary","show_mv" => true])

@section('content')

<div class="container">
    <div class="row">
        <div class="col-sm-7">
            <div class="heading mb-5">
                <h2><strong><span class="under">最近作成(最新の)された表現(10件)</span></strong></h2>
            </div>
            <div class="card mb-5 pop-card">
                <div class="card-header">新規の表現(10件、総合)</div>
                <div class="card-body">              
                @if($phrases)      
                @foreach ($phrases as $phrase)
                    @include("parts.phrase.phrase_item", ["phrase" => $phrase])
                    <hr/>
                @endforeach
                @endif
                    <hr/>
                    <p class="text-right"><a href="{{ url('/phrase') }}">表現一覧(掲示板)を開く(もっと見る)<span><i class="bi bi-arrow-right-short"></i></span></a></p>
                </div>
            </div> 
        </div>

        <div class="col-sm-5">
            <div class="heading mb-5">
                <h2><strong><span class="under">イベントに参加する</span></strong></h2>
            </div>
            <div class="card mb-5 pop-card">
                <div class="card-header">まもなく終了するイベント</div>
                <div class="card-body">
                    @isset($event_soonEnd)

                    @if(count($event_soonEnd) < 1)
                    <p>まもなく終了するイベントはありません</p>
                    @endif

                    @foreach($event_soonEnd as $event)
                    <div class="item_box">
                        <h5 class="card-title">お題・テーマ: ｢<strong>{{ $event->event_text }}</strong>｣な状況(時)の表現</h5>
                        <p class="card-text"><i class="bi bi-person-fill"></i>イベント発案者: {{ ($event->user) ? $event->user->name : "-"}}</p>{{-- $event->user->name --}}
                        <p class="card-text">終了日時: {{ $event->schedule_end }}</p>
                        <p class="card-text">
                            <small class="text-muted"><time datetime="{{ $event->updated_at->format('Y-m-d H:i:s') }}">作成日時: {{ $event->updated_at->format("Y-m-d H:i:s") }}</time></small>
                        </p>
                        <p><span class="badge badge-primary">エントリー数: {{ $event->posts->count() }}件</span></p>
                        <p class="text-right"><a href="{{ url('/event/detail', ['event_id' => $event->id]) }}">このイベントに参加する<span><i class="bi bi-arrow-right-short"></i></span></a></p>
                    </div>
                    <hr/>
                    @endforeach

                    <!-- <div class='pagination justify-content-center'>
                    {{-- $event_soonEnd->links() --}}
                    </div> -->

                    @endisset
                    <hr/>
                    <p class="text-right"><a href="{{ url('/event') }}">イベントを開く(もっと見る)<span><i class="bi bi-arrow-right-short"></i></span></a></p>
                </div>
            </div>

            <div class="card mb-5 pop-card">
                <div class="card-header">開催中のイベント</div>
                <div class="card-body">
                    @isset($events_hold)

                    @if(count($events_hold) < 1)
                    <p>今開催しているイベントはありません</p>
                    @endif

                    @foreach($events_hold as $event)
                    <div class="item_box">
                        <h5 class="card-title">その作成するグループタグに入れる表現についての説明(内容): {{ $event->event_text }}</h5>
                        <p class="card-text"><i class="bi bi-person-fill"></i>イベント発案者: {{ ($event->user) ? $event->user->name : "-"}}</p>{{-- $event->user->name --}}
                        <p class="card-text">終了日時: {{ $event->schedule_end }}</p>
                        <p class="card-text">
                            <small class="text-muted"><time datetime="{{ $event->updated_at->format('Y-m-d H:i:s') }}">作成日時: {{ $event->updated_at->format("Y-m-d H:i:s") }}</time></small>
                        </p>
                        <p><span class="badge badge-primary">エントリー数: {{ $event->posts->count() }}件</span></p>
                        <p class="text-right"><a href="{{ url('/event/detail', ['event_id' => $event->id]) }}">このイベントに参加する<span><i class="bi bi-arrow-right-short"></i></span></a></p>
                    </div>
                    <hr/>
                    @endforeach

                    <!-- <div class='pagination justify-content-center'>
                        {{-- $events_hold->links() --}}
                    </div> -->

                    @endisset
                    <hr/>
                    <p class="text-right"><a href="{{ url('/event') }}">イベントを開く(もっと見る)<span><i class="bi bi-arrow-right-short"></i></span></a></p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="heading mb-5">
                <h2><strong><span class="under">カテゴリごとの表現</span></strong></h2>
            </div>
            <div class="card mb-5 pop-card">
                <div class="card-header">感情</div>
                <div class="card-body">
                @foreach($phraseCategories_feelings as $category)
                    <span><a href="{{ route('phrase.category', ['category' => $category->phrase_category ]) }}">
                    {{ $category->phrase_category }}({{ $category->phrases()->count() }})
                    </a></span>
                    <span class="mr-2"></span>
                @endforeach
                <hr/>
                </div>
            </div>
           
            <div class="card mb-5 pop-card">
                <div class="card-header">動作</div>
                <div class="card-body">
                @foreach($phraseCategories_actions as $category)
                    <span><a href="{{ route('phrase.category', ['category' => $category->phrase_category ]) }}">
                        {{ $category->phrase_category }}({{ $category->phrases()->count() }})
                    </a></span>
                    <span class="mr-2"></span>
                @endforeach
                <hr/>
                </div>
            </div>
        
            <div class="card mb-5 pop-card">
                <div class="card-header">表情</div>
                <div class="card-body">
                @foreach($phraseCategories_expressions as $category)
                    <span><a href="{{ route('phrase.category', ['category' => $category->phrase_category ]) }}">
                        {{ $category->phrase_category }}({{ $category->phrases()->count() }})
                    </a></span>
                    <span class="mr-2"></span>
                @endforeach
                <hr/>
                </div>
            </div>
        </div> 
    </div>
</div>

@endsection('content')