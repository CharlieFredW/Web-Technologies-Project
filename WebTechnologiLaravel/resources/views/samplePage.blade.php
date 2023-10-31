<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="{{asset('css/samplePageStyle.css')}}">
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
                <?php
                    //get all images file path
                    $imageFiles = array_map(
                        fn($path) => basename($path),
                        glob(public_path('images') . '/*')
                    );

                    //get a random images path
                    $randomImageName = $imageFiles[array_rand($imageFiles)];

                    //make the path short so it does not get the local::8080 in front so it works
                    $randomImageUrl = asset("images/{$randomImageName}");
                ?>
                <li class="sample-item"><img class="sample-image" src="{{ $randomImageUrl }}" alt="{{ $sample->title }}"></li>
                <li class="sample-item"><h3>{{ $sample->title }}</h3></li>
                <li class="sample-item"><p>{{ $sample->url }}</p></li>
                <li class="sample-item"><p>{{ $sample->total_downloads }}</p></li>
                <li class="sample-item"><p>{{ $sample->bpm }}</p></li>
                <li class="sample-item"><p>{{ $sample->key }}r</p></li>
                <li class="sample-item"><p>{{ $sample->genre }}</p></li>
                <li class="sample-item"><p>{{ $sample-> instrument}}</p></li>
            </ul>
        @endforeach
    </div>
</div>
<script src="{{ asset('js/samplePageJS.js') }}"></script>
</body>
</html>
