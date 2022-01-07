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
            <form method="post" action="{{ route('admin.base_category.update', $baseCategory->id) }}">
            @csrf
                <div class="form-group">
                    <label for="base_category">表現</label>
                    <input type="text" class="form-control" name="base_category" value={{ $baseCategory->base_category }} />
                </div>

                <button type="submit" class="btn btn-primary">変更</button>
            </form>
        </div>
    </div>
</div>

@endsection('content')