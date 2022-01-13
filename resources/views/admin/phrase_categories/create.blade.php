@extends('layouts.admin.admin',["title"=>"U_Dectionary"])

@section('content')

<div class="container">

{{ Breadcrumbs::render('admin.phrase_category.create') }}

</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1 class="display-3">カテゴリ追加</h1>
            <div class="card base-card">
                <div class="card-header">{{ __('カテゴリ追加') }}</div>
                <div class="card-body">
                    <form method="post" action="{{ route('admin.phrase_category.store') }}">
                    @csrf
                        <div class="form-group row">
                            <label for="phrase_category" class="col-md-4 col-form-label text-md-right">{{ __('カテゴリ') }}</label>
                            <div class="col-md-6">
                                <input id="" type="text" class="form-control" name="phrase_category" value="{{ old('phrase_category') }}" required autocomplete="" autofocus />
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="phrase_category_name" class="col-md-4 col-form-label text-md-right">{{ __('カテゴリの読み方') }}</label>
                            <div class="col-md-6">
                                <input id="" type="text" class="form-control" name="phrase_category_name" value="{{ old('phrase_category_name') }}" required autocomplete="" autofocus />
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="phrase_category" class="col-md-4 col-form-label text-md-right">カテゴリの分類</label>
                            <div class="col-md-6">
                                <ul>
                                    @foreach($base_categories as $base_category)
                                    <li>
                                        <label>
                                        <input type="checkbox" name="base_categories[]" value="{{ $base_category->code }}"
                                        {{ in_array($base_category->code, old("base_categories", [])) ? 'checked="checked"' : '' }}/> 
                                        {{ $base_category->label }}
                                        </label>
                                        <span class="text-muted">{{ $base_category->sample }}</span>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
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

@endsection('content')