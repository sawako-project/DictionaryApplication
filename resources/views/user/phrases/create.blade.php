@extends('layouts.dictionary',["title"=>"U_Dectionary"])

@section('header-title', '表現作成')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card base-card">
                <div class="card-header">{{ __('表現作成') }}</div>
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
                    <form method="post" action="{{ route('user.phrase.store') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="phrase" class="col-4 col-form-label text-md-right">{{ __('表現') }}</label>
                            <div class="col-md-6 textarea-space">
                                <textarea name="phrase" class="m-form-textarea" placeholder="例)頬を緩ませる">{{ old('phrase') }}</textarea><!--class="form-control" type="text" rows="4"-->
                                <!-- <input type="text" name="phrase" value="{{-- old('phrase') --}}" class="m-form-text" /> -->
                                <small class="form-text text-muted">最大文字数は200文字です。</small>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="phrase_category" class="col-md-4 col-form-label text-md-right">カテゴリ</label>
                            
                            <div class="col-md-6 check-list">
                            <small class="form-text text-muted">好きなだけ選んでください</small>

                                @foreach($phraseCategories as $phraseCategory)

                                        <label>
                                            <input 
                                            type="checkbox" 
                                            name="phrase_category[]" 
                                            value="{{ $phraseCategory->id }}"
                                            {{ in_array($phraseCategory->id, old("phrase_category", $category_ids)) ? 'checked="checked"' : '' }}
                                            />
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
                                <input id="tags-input" type="text" name="phrase_tag" value="{{ old('phrase_tag') }}" class="tagfy-input rounded" /><!-- class="form-control" value="{{-- old('phrase_tag', implode(', ', $tagList)) --}}"-->
                                <!-- <textarea name="phrase_tag" rows="4" class="form-control">{{-- old("phrase_tag") --}}</textarea> {{-- old("phrase_tag", implode("\n", $tagList)) --}} -->
                            </div>
                            <!--  -->
                            <!-- <ul>
                            @//foreach($phraseTags as $phraseTag)
                                <li>
                                    <label>
                                        <input 
                                        type="checkbox" 
                                        name="phrase_tag[]" 
                                        value="{{-- $phraseTag->id --}}"
                                        {{-- in_array($phraseTag->phrase_tag, old("phrase_tag", [])) ? 'checked="checked"' : '' --}}
                                        /> 
                                        {{-- $phraseTag->phrase_tag --}}
                                    </label>
                                </li>
                            @//endforeach
                            </ul> -->
                            <!--  -->
                        </div>
                       

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('登録') }}
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