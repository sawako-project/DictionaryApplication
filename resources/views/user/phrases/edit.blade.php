@extends('layouts.dictionary',["title"=>"U_Dectionary"])

{{--@section('header-title', '表現変更')--}}

@section('content')

{{ Breadcrumbs::render('user.phrase.edit', $phrase) }}

<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-8">
            <div class="card base-card">
                <div class="card-header">{{ __('表現変更') }}</div>
                <div class="card-body">
                    <form method="post" action="{{ route('user.phrase.update', $phrase->id) }}">
                    @csrf
                        <div class="form-group row">
                            <label for="phrase" class="col-md-4 col-form-label text-md-right">表現</label>
                            <div class="col-md-6 textarea-space">
                                <textarea name="phrase" class="m-form-textarea" rows="2">{{ $phrase->phrase }}</textarea>
                                <small class="form-text text-muted">max length is xxxxx</small>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="phrase_category" class="col-md-4 col-form-label text-md-right">カテゴリ</label><br/>
                            <div class="col-md-6 check-list">
                            @foreach($phraseCategories as $phraseCategory)
                                <label>
                                    <input type="checkbox" 
                                        name="phrase_category[]"
                                        value="{{ $phraseCategory->id }}"
                                        @if(in_array($phraseCategory->id, $selected_categories))
                                        checked
                                        @endif/>
                                    <span class="m-form-checkbox-name">
                                        <span class="m-form-checkbox-text">{{ $phraseCategory->phrase_category }}</span>
                                    </span>
                                </label>
                            @endforeach
                            </div>  
                        </div>

                        <div class="form-group row">
                            <label for="phrase_tag" class="col-md-4 col-form-label text-md-right">{{ __('タグ') }}</label>
                            <div class="col-md-6">
                                <input id="tags-input" type="text" class="tagfy-input rounded" name="phrase_tag" value="{{ old('phrase_tag',implode(', ', $tagList)) }}" />
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-success">
                                    {{ __('変更') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

$(function(){

    //スクリプト内で次の様に取得します。
    var whitelist_str = '<?php echo $whitelist;?>';  //文字列を一度取得
    var whitelist = whitelist_str.split(','); 
    // The DOM element you wish to replace with Tagify
    var input = document.querySelector('#tags-input');

    // initialize Tagify on the above input node reference
    new Tagify(input,{

        whitelist: whitelist,//@json($whitelist),//whitelist
        dropdown: {
            
            maxItems: 20,           // <- mixumum allowed rendered suggestions
            classname: "tags-look", // <- custom classname for this dropdown, so it could be targeted
            enabled: 0,             // <- show suggestions on focus
            closeOnSelect: false    // <- do not hide the suggestions dropdown once an item has been selected
        }
    })
    
});
</script>

@endsection('content')