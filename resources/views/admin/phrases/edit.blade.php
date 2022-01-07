@extends('layouts.admin.admin',["title"=>"U_Dectionary"])

@section('content')

<div class="container">
    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <h1 class="display-3">内容変更</h1>

            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            <br />
            @endif

            <form method="post" action="{{ route('admin.phrase.update', $phrase->id) }}">
            @csrf
                <div class="form-group">
                    <label for="phrase">表現</label>
                    <!-- <input type="text" class="form-control" name="phrase" value={{-- $phrase->phrase --}} /> -->
                    <textarea class="form-control" rows="4" name="phrase">{{ $phrase->phrase }}</textarea>
                </div>

                <div class="form-group">
                    <label for="phrase_category">カテゴリ</label><br/>
                    @foreach($phraseCategories as $phraseCategory)
                    <input type="checkbox" 
                        name="phrase_category[]"
                        value="{{ $phraseCategory->id }}"
                        @if(in_array($phraseCategory->id, $selected_categories))
                        checked
                        @endif
                    />
                    {{ $phraseCategory->phrase_category }}
                    @endforeach    
                </div>
                
                            <!-- <div class="form-group row">
                <label for="phrase_tag" class="col-md-4 col-form-label text-md-right">{{-- __('タグ') --}}</label>
                <div class="col-md-6"> -->
                    <!-- <textarea name="phrase_tag" rows="4" class="form-control">{{-- old("phrase_tag") --}}</textarea> -->
                    <!-- {{-- old("phrase_tag", implode("\n", $tagList)) --}} -->
                    <!-- <ul>
            @//foreach($phraseTags as $phraseTag)
                        <li>
                            <label>
                                <input 
                                type="checkbox" 
                                name="phrase_tag[]" 
                                value="{{-- $phraseTag->id --}}"
                                {{-- in_array($phraseTag->phrase_tag, old("phrase_tag", $tagList)) ? 'checked="checked"' : '' --}}
                                /> 
                                {{-- $phraseTag->phrase_tag --}}
                            </label>
                        </li>
                    @//endforeach
                    </ul> -->
                <!-- </div> -->
            <!-- </div> -->
            <!-- <div>-->
                <!-- </div> -->
            <!-- </div> -->

                <div class="form-group">
                    <!-- <label for="phrase_tag" class="col-md-4 col-form-label text-md-right">{{-- __('タグ') --}}</label> -->
                    <label for="phrase_tag">{{ __('タグ') }}</label>
                    <input id="tags-input" type="text" class="form-control" name="phrase_tag" value="{{ old('phrase_tag',implode(', ', $tagList)) }}" />
                </div>
                <button type="submit" class="btn btn-primary">変更</button>
            </form>
        </div>
    </div>
</div>

<button><a href="{{route('admin.phrase.index')}}">管理者表現一覧</a></button>

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