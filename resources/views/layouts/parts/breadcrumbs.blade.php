<style>

.breadcrumb {
    display: flex;
}

.breadcrumb-item {
    list-style: none;
    margin: 20px 20px;
    font-family: 'Kiwi Maru', serif;
}

</style>

@if(count($breadcrumbs))
<ul class="breadcrumb">
@foreach($breadcrumbs as $breadcrumb)
    @if($breadcrumb->url && !$loop->last)
    <li class="breadcrumb-item"><a href="{{$breadcrumb->url}}">{{$breadcrumb->title}}</a></li>
    @else
    <li class="breadcrumb-item active">{{ $breadcrumb->title }}</li>
    @endif
@endforeach
</ul>
@endif