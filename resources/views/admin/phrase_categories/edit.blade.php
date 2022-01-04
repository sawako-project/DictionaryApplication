<!-- @//extends('layouts.app',["title"=>"U_Dectionary"]) -->
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
        <form method="post" action="{{ route('admin.phrase_category.update', $phraseCategory->id) }}">
            @csrf
            <div class="form-group">
                <label for="phrase_category">カテゴリ</label>
                <input type="text" class="form-control" name="phrase_category" value={{ $phraseCategory->phrase_category }} />
            </div>

<!--  -->
<div class="form-group row">
            <label for="phrase_category_name" class="col-md-4 col-form-label text-md-right">カテゴリの振り仮名</label>

            <div class="col-md-6">
                <input id="" type="text" class="form-control" name="phrase_category_name" value="{{ $phraseCategory->phrase_category_name }}" required autocomplete="" autofocus />
            </div>
        </div>
        <!--  -->

                   
            <div class="form-group row">
                <label for="phrase_category" class="col-md-4 col-form-label text-md-right">大カテゴリ</label>

                <div class="col-md-6">
                    <ul>
                    @foreach($base_categories as $base_category)
                    <li>
                    <label>
                    <input type="checkbox"
                        name="base_categories[]"
                        value="{{ $base_category->code }}"
                        {{ in_array($base_category->code, old("base_categories", $selected_basies)) ? 'checked="checked"' : '' }}
                    /> {{ $base_category->label }}</label>
                    <span class="text-muted">{{ $base_category->sample }}</span>
                    </li>
                    @endforeach
                    </ul>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">変更</button>
        </form>
    </div>
</div>

</div>

<button><a href="{{route('admin.phrase_category.index')}}">管理者カテゴリ一覧</a></button>

@endsection('content')