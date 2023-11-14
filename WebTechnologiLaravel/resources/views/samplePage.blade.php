<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
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
<body>
<div class="header-background">
    <div class="header">
        <div class="logo">
            <h2>Header Logo</h2>
            <div class="header-links-box">
                <li><a href="{{ asset('/samplePage') }}" class="header-link">Samples</a></li>
                <li><a href="google.com" class="header-link">Community</a></li>
                <li><a href="{{ asset('/blogs') }}" class="header-link">Blog</a></li>
            </div>
        </div>
        <div class="login-info">
            @if(Auth::check())
                <li><a href="{{ asset('/my-page-creator') }}" class="my-page-button">My Page</a></li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <li><button class="logout-button">Log Out</button></li>
                </form>
            @else
                <li><a href="{{ asset('/login') }}" class="login-button">Log In</a></li>
                <li><a href="{{ asset('/signup') }}" class="signup-button">Sign Up</a></li>
            @endif
        </div>
    </div>
</div>
<div class="samples-heading">
    <p class="samples-heading-text">Samples</p>
</div>
<div class="filter-button">
    <button class="filter-button-text">Filter Results</button>
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
            <input type="hidden" name="rating" id="rating_{{ $sample->id }}" value=""> <!-- Hidden input to store rating value -->

            <ul class="sample-items">
                <li class="sample-item"><img class="sample-image" src="{{ $sample->image_url }}" alt="{{ $sample->title }}"></li>
                <li class="sample-item"><h3>{{ $sample->title }}</h3></li>
                <li class="sample-item"><p>{{ $sample->url }}</p></li>

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
                <li class="sample-item"><p>{{ $sample->key }}r</p></li>
                <li class="sample-item"><p>{{ $sample->genre }}</p></li>
                <li class="sample-item"><p>{{ $sample-> instrument}}</p></li>
            </ul>
        </form>
        @endforeach
    </div>

</div>
</body>
</html>
