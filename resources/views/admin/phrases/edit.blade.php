@extends('layouts.admin.admin',["title"=>"U_Dectionary"])

@section('content')

<div class="container">

{{ Breadcrumbs::render('admin.phrase.edit',$phrase) }}

</div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-8">
            <h1 class="display-3">表現変更</h1>
			<div class="card base-card">
				<div class="card-header">表現変更</div>
				<div class="card-body">
                    <form method="post" action="{{ route('admin.phrase.update', $phrase->id) }}">
                    @csrf
                        <div class="form-group row">
                            <label for="phrase" class="col-md-4 col-form-label text-md-right">表現</label>
                            <div class="col-md-6">
                                <textarea class="form-control" rows="2" name="phrase">{{ $phrase->phrase }}</textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="phrase_category" class="col-md-4 col-form-label text-md-right">カテゴリ</label><br/>
                            <div class="col-md-6">
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
                        </div>
                        <div class="form-group row">
                            <label for="phrase_tag" class="col-md-4 col-form-label text-md-right">{{ __('タグ') }}</label>
                            <div class="col-md-6">
                                <input id="tags-input" type="text" class="form-control" name="phrase_tag" value="{{ old('phrase_tag',implode(', ', $tagList)) }}" />
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
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

<hr/>
<a href="{{ route('admin.top')}}" class="btn btn-outline-primary mx-1">管理者トップ</a>
<a href="{{ route('admin.phrase.index') }}" class="btn btn-outline-primary mx-1">管理者表現一覧</a>

<script type="text/javascript">

$(function(){

//スクリプト内で次の様に取得します。
var whitelist_str = '<?php echo $whitelist;?>';  //文字列を一度取得
var whitelist = whitelist_str.split(','); 
    // The DOM element you wish to replace with Tagify
    var input = document.querySelector('#tags-input');

    // initialize Tagify on the above input node reference
    new Tagify(input,{

        whitelist: whitelist,
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