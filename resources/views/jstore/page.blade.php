@extends('base')

@section('title')
    {{ $page->title }} {{ $site_title() }}
@endsection

@section('content')

@include('jstore/components/top-page', ['title'=> $page->title])
<div class="container">
    {!! $page->content !!}

</div>


@endsection
