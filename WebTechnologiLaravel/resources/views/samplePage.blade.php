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
                <li><a href="google.com" class="header-link">Samples</a></li>
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
</body>
</html>
