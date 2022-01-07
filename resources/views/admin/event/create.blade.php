@extends('layouts.admin.admin',["title"=>"U_Dectionary"])

{{--@section('header-title', 'イベント作成')--}}

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card base-card">
                <div class="card-header">{{ __('イベント作成') }}</div>
                <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div><br />
                @endif
                    <form method="post" action="{{ route('admin.event.store') }}">
                    @csrf
                        <div class="form-group row">
                            <label for="event_type" class="col-md-4 col-form-label text-md-right">イベントタイプ</label>
                            <div class="col-md-6 radio-list">
                                @foreach($event_type_list as $event_type)
                                <label>
                                    <input type="radio" 
                                    name="event_type" 
                                    id="{{ $event_type->event_type }}" 
                                    value="{{ $event_type->event_type }}"
                                    {{ ($event_type->event_type == old('event_type',$event_type_list[0]->event_type)) ? 'checked="checked"' : '' }}
                                    />
                                    <span class="m-form-radio-name">
                                        <span class="m-form-radio-text">{{ $event_type->label }}</span>
                                    </span>
                                </label>    
                                @endforeach
                                {{ old("event_type") }}
                            </div>
                        </div>

                        <!-- <div class="eventForm phraseAboutSituationEvent"> -->
                        <div class="form-group row">
                            <label for="phrase_category" class="col-md-4 col-form-label text-md-right">{{ __('指定するカテゴリ') }}</label>
                            <div class="col-md-6 check-list">
                            @foreach($phraseCategories as $phraseCategory)
                                <label>
                                    <input 
                                    type="checkbox" 
                                    name="phrase_category[]" 
                                    value="{{ $phraseCategory->id }}"
                                    {{ (in_array($phraseCategory->phrase_category, old("phrase_category", []))) ? 'checked="checked"' : '' }}
                                    />
                                    <span class="m-form-checkbox-name">
                                        <span class="m-form-checkbox-text">{{ $phraseCategory->phrase_category }}</span>
                                    </span>
                                </label>
                            @endforeach
                            </div>

                            <label for="phrase_tag" class="col-md-4 col-form-label text-md-right">追加タグ</label>
                            <div class="col-md-6">
                                <!-- <textarea class="form-control" rows="4" name="auto_tag">{{-- old('auto_tag') --}}</textarea> -->
                                <!-- <input id="tags-input" type="text" name="phrase_tag" value="{{-- old('phrase_tag') --}}" class="tagfy-input rounded" /> -->
                                <input type="text" name="auto_tag" value="{{ old('auto_tag') }}" class="m-form-text" />
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="event_text" class="col-md-4 col-form-label text-md-right">{{ __('お題・テーマ') }}</label>
                            <div class="col-md-6 textarea-space">
                                <textarea name="event_text" class="m-form-textarea">{{ old('event_text') }}</textarea>
                                <span>な状況(時)の表現</span>
                            </div>
                        </div>

                        <!-- イベントタイプが"phraseAboutGroupedTagEvent", "グループタグ表現"の時は要るの？ -->
                        <div class="form-group row">
                            <label for="schedule_end" class="col-md-4 col-form-label text-md-right">{{ __('イベント終了日時') }}</label>
                            <div class="col-md-6">
                                <div class="input-group date" id='datetimepicker1'>
                                    <input type="datetime-local" id="" name="schedule_end" value="{{ old('schedule_end') }}" class="m-form-text" />
                                    @if ($errors->has('schedule_end'))
                                    <span class="error mb-4 text-red-900">{{ $errors->first('schedule_end') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('登録') }}
                                </button>
                            </div>
                        </div>

                        <!-- <div class="eventForm phraseAboutSituationEvent">-->
                    </form>
                </div><!-- <div class="card-body"> -->
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

$(function(){

    $('[name="event_type"]:radio').on("change",function() {

        const value = $('[name="event_type"]:radio:checked').val();
        
        $(".eventForm").hide();
        $(".eventForm." + value).fadeIn();

        $(".eventForm").find("input,select,textarea").prop('disabled', true);//選択on有効,findはplunk
        $(".eventForm." + value).find("input,select,textarea").prop('disabled', false);//off無効

    });

    //初期状態
    $('[name="event_type"]:radio:checked').trigger("change");

//////////////////
//スクリプト内で次の様に取得します。
// var whitelist_str = '<//?php echo $whitelist;?>';  //文字列を一度取得
// var whitelist = whitelist_str.split(','); 
//     // The DOM element you wish to replace with Tagify
//     var input = document.querySelector('#tags-input');

//     // initialize Tagify on the above input node reference
//     new Tagify(input,{
//         whitelist: whitelist,//@//json($whitelist),//whitelist
//         dropdown: {
//             maxItems: 20,           // <- mixumum allowed rendered suggestions
//             classname: "tags-look", // <- custom classname for this dropdown, so it could be targeted
//             enabled: 0,             // <- show suggestions on focus
//             closeOnSelect: false    // <- do not hide the suggestions dropdown once an item has been selected
//         }
//     })
//////////////////

});

</script>

@endsection('content')