@extends('layout')
@section('content')
<div class="breadcrumbs">
    <a href="{{ URL::to('/') }}">Trang chủ </a>/
    <a href=""></a>
</div>
Trang bài viết sản phẩm


<div class="row">
    @foreach ($posts as $post)
    <div class="col-lg-3 col-md-3 col-sm-6 col-6" style="padding-bottom: 12px;">
        {{$post->name_article}}
    </div>
    @endforeach

</div>
@endsection