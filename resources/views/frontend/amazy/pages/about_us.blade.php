@extends('frontend.amazy.layouts.app')

@section('title')
{{$content->mainTitle}}
@endsection
@section('content')
@php
    $page = \Modules\FrontendCMS\Entities\DynamicPage::where('slug', 'about-us')->first();
@endphp

<div class="container mt_30 mb_30 min-vh-50">
    @php
        echo $page->description;
    @endphp
</div>

@endsection

