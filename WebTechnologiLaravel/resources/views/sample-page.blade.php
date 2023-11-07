@extends('layouts.main')
@section('content')
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Title</title>
    <link rel="stylesheet" href="{{asset('css/samplePageStyle.css')}}">
</head>
<div class="samples-heading">
    <p class="samples-heading-text">Samples</p>
</div>
<div class="filter-button">
    <button id="expand-button" onclick="toggleExpand()">Filter Results</button>
    <div class="expandable-area" id="expand-area">
        <div class="filter-inner-container">
            <ul class="filter-list">
                <li class="filter-item-header"><button>Total Downloads</button></li>
                <li class="filter-item-header"><button>BPM</button></li>
                <li class="filter-item-header"><button>Key</button></li>
                <li class="filter-item-header"><button>Genre</button></li>
                <li class="filter-item-header"><button>Created Date</button></li>
                <li class="filter-item-header"><button>Instrument</button></li>
            </ul>
        </div>
    </div>
</div>
<div class="sample-container">
    <div class="sample-inner-container">
        <ul class="sticky-container">
            <li class="sample-item-header">Image</li>
            <li class="sample-item-header">Title</li>
            <li class="sample-item-header">URL</li>
            <li class="sample-item-header">Total Downloads</li>
            <li class="sample-item-header">BPM</li>
            <li class="sample-item-header">Key</li>
            <li class="sample-item-header">Genre</li>
            <li class="sample-item-header">Instrument</li>
        </ul>
        @foreach($samples as $sample)
            <ul class="sample-items">
                <li class="sample-item"><img class="sample-image" src="{{ $sample->image_url }}" alt="{{ $sample->title }}"></li>
                <li class="sample-item"><h3>{{ $sample->title }}</h3></li>
                <li class="sample-item">
                    <button class="copy-url-button" data-sample-id="{{ $sample->id }}" data-url="{{ $sample->url }}">Copy URL</button>
                </li>
                <li class="sample-item"><p>{{ $sample->total_downloads }}</p></li>
                <li class="sample-item"><p>{{ $sample->bpm }}</p></li>
                <li class="sample-item"><p>{{ $sample->key }}</p></li>
                <li class="sample-item"><p>{{ $sample->genre }}</p></li>
                <li class="sample-item"><p>{{ $sample-> instrument}}</p></li>
            </ul>
        @endforeach
    </div>
</div>
<script src="{{ asset('js/samplePageJS.js') }}"></script>
@endsection
