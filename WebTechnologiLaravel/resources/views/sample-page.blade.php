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
    <button id="expand-button">Filter Results</button>
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
        <button id="sort-highest" class="download-sort-button">Sort by Highest</button> <br>
        <button id="sort-lowest" class="download-sort-button">Sort by Lowest</button> <br>
    </div>
    <div id="bpm-search-dropdown" class="dropdown-content">
        <label for="bpm-input" class="bpm-search-dropdown-label">Enter BPM:</label> <br>
        <input type="number" id="bpm-input" placeholder="Enter BPM" class="bpm-search-dropdown-label"> <br>
        <button class="bpm-search-dropdown-button" id="bpm-button">Search</button> <br>
    </div>
    <div id="key-dropdown" class="dropdown-content">
        <!-- major keys -->
        <button id="sortC" class="key-dropdown-button">Sort by C</button> <br>
        <button id="sortC#" class="key-dropdown-button">Sort by C#</button> <br>
        <button id="sortD" class="key-dropdown-button">Sort by D</button> <br>
        <button id="sortD#" class="key-dropdown-button">Sort by D#</button> <br>
        <button id="sortE" class="key-dropdown-button">Sort by E</button> <br>
        <button id="sortF" class="key-dropdown-button">Sort by F</button> <br>
        <button id="sortF#" class="key-dropdown-button">Sort by F#</button> <br>
        <button id="sortG" class="key-dropdown-button">Sort by G</button> <br>
        <button id="sortG#" class="key-dropdown-button">Sort by G#</button> <br>
        <button id="sortA" class="key-dropdown-button">Sort by A</button> <br>
        <button id="sortA#" class="key-dropdown-button">Sort by A#</button> <br>
        <button id="sortB" class="key-dropdown-button">Sort by B</button> <br>

        <!-- minor keys -->
        <button id="sortAm" class="key-dropdown-button">Sort by Am</button> <br>
        <button id="sortA#m" class="key-dropdown-button">Sort by A#m</button> <br>
        <button id="sortBm" class="key-dropdown-button">Sort by Bm</button> <br>
        <button id="sortCm" class="key-dropdown-button">Sort by Cm</button> <br>
        <button id="sortC#m" class="key-dropdown-button">Sort by C#m</button> <br>
        <button id="sortDm" class="key-dropdown-button">Sort by Dm</button> <br>
        <button id="sortD#m" class="key-dropdown-button">Sort by D#m</button> <br>
        <button id="sortEm" class="key-dropdown-button">Sort by Em</button> <br>
        <button id="sortFm" class="key-dropdown-button">Sort by Fm</button> <br>
        <button id="sortF#m" class="key-dropdown-button">Sort by F#m</button> <br>
        <button id="sortGm" class="key-dropdown-button">Sort by Gm</button> <br>
        <button id="sortG#m" class="key-dropdown-button">Sort by G#m</button> <br>
    </div>
    <div id="genre-dropdown" class="dropdown-content">
        <label><input type="checkbox" name="genre" value="pop" class="genre-dropdown-button"> Pop</label> <br>
        <label><input type="checkbox" name="genre" value="rock" class="genre-dropdown-button"> Rock</label> <br>
        <label><input type="checkbox" name="genre" value="hip-hop" class="genre-dropdown-button"> Hip Hop</label> <br>
        <label><input type="checkbox" name="genre" value="country" class="genre-dropdown-button"> Country</label> <br>
        <label><input type="checkbox" name="genre" value="jazz" class="genre-dropdown-button"> Jazz</label> <br>
        <label><input type="checkbox" name="genre" value="blues" class="genre-dropdown-button"> Blues</label> <br>
        <label><input type="checkbox" name="genre" value="classical" class="genre-dropdown-button"> Classical</label> <br>
        <label><input type="checkbox" name="genre" value="reggae" class="genre-dropdown-button"> Reggae</label> <br>
        <label><input type="checkbox" name="genre" value="electronic" class="genre-dropdown-button"> Electronic</label> <br>
        <label><input type="checkbox" name="genre" value="indie" class="genre-dropdown-button"> Indie</label> <br>
        <label><input type="checkbox" name="genre" value="metal" class="genre-dropdown-button"> Metal</label> <br>
        <label><input type="checkbox" name="genre" value="folk" class="genre-dropdown-button"> Folk</label> <br>
        <label><input type="checkbox" name="genre" value="rap" class="genre-dropdown-button"> Rap</label> <br>
        <label><input type="checkbox" name="genre" value="latin" class="genre-dropdown-button"> Latin</label> <br>
        <label><input type="checkbox" name="genre" value="punk" class="genre-dropdown-button"> Punk</label> <br>
        <label><input type="checkbox" name="genre" value="r&b" class="genre-dropdown-button"> R&B</label> <br>
        <label><input type="checkbox" name="genre" value="soul" class="genre-dropdown-button"> Soul</label> <br>
        <label><input type="checkbox" name="genre" value="funk" class="genre-dropdown-button"> Funk</label> <br>
        <label><input type="checkbox" name="genre" value="disco" class="genre-dropdown-button"> Disco</label> <br>
        <label><input type="checkbox" name="genre" value="world" class="genre-dropdown-button"> World</label> <br>
    </div>
    <div id="date-dropdown" class="dropdown-content">
        <button id="sort-date-newest" class="date-dropdown-button">Newest First</button> <br>
        <button id="sort-date-oldest" class="date-dropdown-button">Oldest First</button> <br>
    </div>
    <div id="instrument-dropdown" class="dropdown-content">
        <label><input type="radio" name="instrument" value="guitar" class="instrument-dropdown-button"> Guitar</label> <br>
        <label><input type="radio" name="instrument" value="piano" class="instrument-dropdown-button"> Piano</label> <br>
        <label><input type="radio" name="instrument" value="drums" class="instrument-dropdown-button"> Drums</label> <br>
        <label><input type="radio" name="instrument" value="bass" class="instrument-dropdown-button"> Bass</label> <br>
        <label><input type="radio" name="instrument" value="violin" class="instrument-dropdown-button"> Violin</label> <br>
        <label><input type="radio" name="instrument" value="saxophone" class="instrument-dropdown-button"> Saxophone</label> <br>
        <label><input type="radio" name="instrument" value="trumpet" class="instrument-dropdown-button"> Trumpet</label> <br>
    </div>
</div>
<div class="sample-container">
    <div class="sample-inner-container" id="sample-container">
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
        <div id="generated-html">
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
</div>
<script src="{{ asset('js/samplePageJS.js') }}"></script>
@endsection
