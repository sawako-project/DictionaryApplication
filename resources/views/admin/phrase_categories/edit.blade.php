@extends('layouts.admin.admin',["title"=>"U_Dectionary"])

@section('content')

<div class="container">

{{ Breadcrumbs::render('admin.phrase_category.edit',$phraseCategory) }}

</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-8">
            <h1 class="display-3">カテゴリ変更</h1>
            <div class="card base-card">
                <div class="card-header">{{ __('カテゴリ変更') }}</div>
                <div class="card-body">
                    <form method="post" action="{{ route('admin.phrase_category.update', $phraseCategory->id) }}">
                    @csrf
                        <div class="form-group row">
                            <label for="phrase_category" class="col-md-4 col-form-label text-md-right">カテゴリ</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="phrase_category" value={{ $phraseCategory->phrase_category }} />
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="phrase_category" class="col-md-4 col-form-label text-md-right">カテゴリの分類</label>
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
<a class="btn btn-outline-primary mx-1" href="{{route('admin.top')}}">管理者トップ</a>
<a class="btn btn-outline-primary mx-1" href="{{route('admin.phrase_category.index')}}">管理者カテゴリ一覧</a>

@endsection('content')