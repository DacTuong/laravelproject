@extends('layout')
@section('content')

<div class="breadcrumbs">
    <a href="{{ URL::to('/') }}">Trang chủ </a>/
    <a href="{{ URL::to('/wishlist') }}">Danh sách yêu thích</a>
</div>

<div class="row" id="wishlist-container">



</div>


@endsection