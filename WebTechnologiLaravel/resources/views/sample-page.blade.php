@extends('layouts.main')
@section('content')
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Title</title>
    <link rel="stylesheet" href="{{asset('css/samplePageStyle.css')}}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function assignValue(sample_id, value) {
            document.getElementById('rating_' + sample_id).value = value;
        }
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var samples = document.querySelectorAll('.rating');

            samples.forEach(function (rating) {
                var stars = rating.querySelectorAll('.star');

                stars.forEach(function (star) {
                    star.addEventListener('mouseover', function () {
                        var value = star.getAttribute('data-value');
                        highlightStars(rating, value);
                    });

                    star.addEventListener('mouseout', function () {
                        resetStars(rating);
                    });
                });
            });
        });

        function highlightStars(rating, value) {
            var stars = rating.querySelectorAll('.star');
            stars.forEach(function (star, index) {
                if (index < value) {
                    star.classList.add('active');
                } else {
                    star.classList.remove('active');
                }
            });

            var ratingInput = rating.parentElement.querySelector('input[name="rating"]');
            ratingInput.value = value; // Set the hidden input value
        }

        function resetStars(rating) {
            var stars = rating.querySelectorAll('.star');
            stars.forEach(function (star) {
                star.classList.remove('active');
            });
        }

    </script>
</head>
<div class="samples-heading">
    <p class="samples-heading-text">Samples</p>
</div>
<div class="filter-button">
    <button id="expand-button" onclick="toggleExpand()">Filter Results</button>
    <div class="expandable-area" id="expand-area">
        <div class="filter-inner-container">
            <ul class="filter-list">
                <li onclick="toggleDropdown('download-sort-dropdown', this)" class="filter-item-header" id="filter1">
                    <button class="dropdown-btn">Total Downloads</button>
                </li>
                <li onclick="toggleDropdown('bpm-search-dropdown', this)" class="filter-item-header" id="filter2">
                    <button class="dropdown-btn">BPM</button>
                </li>
                <li onclick="toggleDropdown('key-dropdown', this)" class="filter-item-header" id="filter3">
                    <button class="dropdown-btn">Key</button>
                </li>
                <li onclick="toggleDropdown('genre-dropdown', this)" class="filter-item-header" id="filter4">
                    <button>Genre</button>
                </li>
                <li onclick="toggleDropdown('date-dropdown', this)" class="filter-item-header" id="filter5">
                    <button>Created Date</button>
                </li>
                <li onclick="toggleDropdown('instrument-dropdown', this)" class="filter-item-header" id="filter6">
                    <button>Instrument</button>
                </li>
            </ul>
        </div>
    </div>
    <div id="download-sort-dropdown" class="dropdown-content">
        <button onclick="sortSamples('highest')">Sort by Highest</button>
        <button onclick="sortSamples('lowest')">Sort by Lowest</button>
    </div>
    <div id="bpm-search-dropdown" class="dropdown-content">
        <label for="bpm-input">Enter BPM:</label>
        <input type="number" id="bpm-input" placeholder="Enter BPM">
        <button onclick="searchByBpm()">Search</button>
    </div>
    <div id="key-dropdown" class="dropdown-content">
        <!-- major keys -->
        <button onclick="sortSamples('C')">Sort by C</button>
        <button onclick="sortSamples('C#')">Sort by C#</button>
        <button onclick="sortSamples('D')">Sort by D</button>
        <button onclick="sortSamples('D#')">Sort by D#</button>
        <button onclick="sortSamples('E')">Sort by E</button>
        <button onclick="sortSamples('F')">Sort by F</button>
        <button onclick="sortSamples('F#')">Sort by F#</button>
        <button onclick="sortSamples('G')">Sort by G</button>
        <button onclick="sortSamples('G#')">Sort by G#</button>
        <button onclick="sortSamples('A')">Sort by A</button>
        <button onclick="sortSamples('A#')">Sort by A#</button>
        <button onclick="sortSamples('B')">Sort by B</button>

        <!-- minor keys -->
        <button onclick="sortSamples('Am')">Sort by Am</button>
        <button onclick="sortSamples('A#m')">Sort by A#m</button>
        <button onclick="sortSamples('Bm')">Sort by Bm</button>
        <button onclick="sortSamples('Cm')">Sort by Cm</button>
        <button onclick="sortSamples('C#m')">Sort by C#m</button>
        <button onclick="sortSamples('Dm')">Sort by Dm</button>
        <button onclick="sortSamples('D#m')">Sort by D#m</button>
        <button onclick="sortSamples('Em')">Sort by Em</button>
        <button onclick="sortSamples('Fm')">Sort by Fm</button>
        <button onclick="sortSamples('F#m')">Sort by F#m</button>
        <button onclick="sortSamples('Gm')">Sort by Gm</button>
        <button onclick="sortSamples('G#m')">Sort by G#m</button>
    </div>
    <div id="genre-dropdown" class="dropdown-content">
        <label><input type="checkbox" name="genre" value="pop"> Pop</label>
        <label><input type="checkbox" name="genre" value="rock"> Rock</label>
        <label><input type="checkbox" name="genre" value="hip-hop"> Hip Hop</label>
        <label><input type="checkbox" name="genre" value="country"> Country</label>
        <label><input type="checkbox" name="genre" value="jazz"> Jazz</label>
        <label><input type="checkbox" name="genre" value="blues"> Blues</label>
        <label><input type="checkbox" name="genre" value="classical"> Classical</label>
        <label><input type="checkbox" name="genre" value="reggae"> Reggae</label>
        <label><input type="checkbox" name="genre" value="electronic"> Electronic</label>
        <label><input type="checkbox" name="genre" value="indie"> Indie</label>
        <label><input type="checkbox" name="genre" value="metal"> Metal</label>
        <label><input type="checkbox" name="genre" value="folk"> Folk</label>
        <label><input type="checkbox" name="genre" value="rap"> Rap</label>
        <label><input type="checkbox" name="genre" value="latin"> Latin</label>
        <label><input type="checkbox" name="genre" value="punk"> Punk</label>
        <label><input type="checkbox" name="genre" value="r&b"> R&B</label>
        <label><input type="checkbox" name="genre" value="soul"> Soul</label>
        <label><input type="checkbox" name="genre" value="funk"> Funk</label>
        <label><input type="checkbox" name="genre" value="disco"> Disco</label>
        <label><input type="checkbox" name="genre" value="world"> World</label>
    </div>
    <div id="date-dropdown" class="dropdown-content">
        <button onclick="sortSamples('newest')">Newest First</button>
        <button onclick="sortSamples('oldest')">Oldest First</button>
    </div>
    <div id="instrument-dropdown" class="dropdown-content">
        <label><input type="radio" name="instrument" value="guitar"> Guitar</label>
        <label><input type="radio" name="instrument" value="piano"> Piano</label>
        <label><input type="radio" name="instrument" value="drums"> Drums</label>
        <label><input type="radio" name="instrument" value="bass"> Bass</label>
        <label><input type="radio" name="instrument" value="violin"> Violin</label>
        <label><input type="radio" name="instrument" value="saxophone"> Saxophone</label>
        <label><input type="radio" name="instrument" value="trumpet"> Trumpet</label>
    </div>
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
                        <button class="star" data-value="1" onclick="assignValue({{ $sample->id }}, 1)">&#9733</button>
                        <button class="star" data-value="2" onclick="assignValue({{ $sample->id }}, 2)">&#9733</button>
                        <button class="star" data-value="3" onclick="assignValue({{ $sample->id }}, 3)">&#9733</button>
                        <button class="star" data-value="4" onclick="assignValue({{ $sample->id }}, 4)">&#9733</button>
                        <button class="star" data-value="5" onclick="assignValue({{ $sample->id }}, 5)">&#9733</button>
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
