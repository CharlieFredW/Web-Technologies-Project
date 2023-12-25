@extends('layouts.main')
@section('content')
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Title</title>
    <link rel="stylesheet" href="{{asset('css/samplePageStyle.css')}}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<div class="samples-heading">
    <p class="samples-heading-text">Samples</p>
</div>
<div class="sample-container">
    <div class="sample-inner-container">
        <ul class="sticky-container">
            <li class="sample-item-header">Image</li>
            <li class="sample-item-header">Title</li>
            <li class="sample-item-header">URL</li>
            <li class="sample-item-header">Sample Rating</li>
            <li class="sample-item-header">Total Downloads</li>
            <li class="sample-item-header">BPM</li>
            <li class="sample-item-header">Key</li>
            <li class="sample-item-header">Genre</li>
            <li class="sample-item-header">Instrument</li>
        </ul>
        @foreach($samples as $sample)
            <form method="POST" action="{{ route('sample.rate') }}">
                @csrf
                <input type="hidden" name="sample_id" value="{{ $sample->id }}">
                <input type="hidden" name="rating" id="rating_{{ $sample->id }}" value="">

            <ul class="sample-items">
                <li class="sample-item"><img class="sample-image" src="{{ $sample->image_url }}" alt="{{ $sample->title }}"></li>
                <li class="sample-item"><h3>{{ $sample->title }}</h3></li>
                <li class="sample-item">
                    <button class="copy-url-button" data-sample-id="{{ $sample->id }}" data-url="{{ $sample->url }}">Copy URL</button>
                </li>

                <li class="sample-item">
                    <div class="rating">
                        <p>
                            Average Rating:
                            @if ($sample->averageRating !== null)
                                {{ $sample->averageRating }}
                            @else
                                No Ratings Yet
                            @endif
                        </p>
                        <button id="1-star" class="star" data-value="1" onclick="assignValue({{ $sample->id }}, 1)">&#9733</button>
                        <button id="2-star" class="star" data-value="2" onclick="assignValue({{ $sample->id }}, 2)">&#9733</button>
                        <button id="3-star" class="star" data-value="3" onclick="assignValue({{ $sample->id }}, 3)">&#9733</button>
                        <button id="4-star" class="star" data-value="4" onclick="assignValue({{ $sample->id }}, 4)">&#9733</button>
                        <button id="5-star" class="star" data-value="5" onclick="assignValue({{ $sample->id }}, 5)">&#9733</button>

                    </div>
                </li>

                <li class="sample-item"><p>{{ $sample->total_downloads }}</p></li>
                <li class="sample-item"><p>{{ $sample->bpm }}</p></li>
                <li class="sample-item"><p>{{ $sample->key }}</p></li>
                <li class="sample-item"><p>{{ $sample->genre }}</p></li>
                <li class="sample-item"><p>{{ $sample-> instrument}}</p></li>
            </ul>
            </form>
        @endforeach
    </div>
</div>
<script src="{{ asset('js/samplePageJS.js') }}"></script>
@endsection
