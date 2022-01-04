@extends('layouts.admin.admin',["title"=>"U_Dectionary"])

{{--@section('header-title', 'お問い合わせ')--}}

@section('content')
    
@if(session()->get('success'))
<div class="alert alert-success">
   {{ session()->get('success') }} 
</div>
@endif



<h1>{{ __('やったぜ') }}</h1>



@endsection('content')