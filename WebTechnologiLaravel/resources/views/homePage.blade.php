<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="{{asset('css/homepageStyle.css')}}">
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
<div class="new-samples-box">
    <div class="new-samples-text">
        <p>New Samples</p>
    </div>
    <div class="new-samples-images-container">
    @for ($i = 0; $i < min(6, count($newSamples)); $i++)
        <div class="new-samples-image-container">
            <img class="sample-image" src="{{ $newSamples[$i]->image_url }}" alt="{{ $newSamples[$i]->title }}">
            <p class="new-samples-image-caption">{{ $newSamples[$i]->title }}</p>
        </div>
        @endfor
    </div>
</div>
<div class="divider"></div>
<div class="blog-container">
    <p class="blog-heading">Today's Blog Post Choice</p>
    <div class="blog-images-container">
        <div class="blog-image-container">
            <img src="placeholder1.jpg" alt="Placeholder Image 1">
            <p class="blog-image-caption">Placeholder text1</p>
        </div>
        <div class="blog-image-container">
            <img src="placeholder1.jpg" alt="Placeholder Image 2">
            <p class="blog-image-caption">Placeholder text2</p>
        </div>
        <div class="blog-image-container">
            <img src="placeholder1.jpg" alt="Placeholder Image 3">
            <p class="blog-image-caption">Placeholder text3</p>
        </div>
    </div>
</div>
<div class="divider"></div>
<div class="today-picks-box">
    <div class="today-picks-text">
        <p>Today's Top Picks</p>
    </div>
    <div class="today-picks-images-container">
        @for ($i = 0; $i < min(6, count($todaySamples)); $i++)
            <div class="today-picks-image-container">
                <img class="sample-image" src="{{ $todaySamples[$i]->image_url }}" alt="{{ $todaySamples[$i]->title }}">
                <p class="today-picks-image-caption">{{ $todaySamples[$i]->title }}</p>
            </div>
        @endfor
    </div>
</div>
<div class="divider"></div>
<div class="this-weeks-creators-text">
    <p>Top Creators This Week</p>
</div>
<div class="this-weeks-creators-container">
    <div class="this-weeks-creators-box">
        <div class="this-weeks-creators-images-container">
            <div class="this-weeks-creators-image-container">
                <img src="placeholder1.jpg" alt="Placeholder Image 1">
                <p class="this-weeks-creators-image-caption">Placeholder text1</p>
            </div>
            <div class="this-weeks-creators-image-container">
                <img src="placeholder1.jpg" alt="Placeholder Image 2">
                <p class="this-weeks-creators-image-caption">Placeholder text2</p>
            </div>
            <div class="this-weeks-creators-image-container">
                <img src="placeholder1.jpg" alt="Placeholder Image 3">
                <p class="this-weeks-creators-image-caption">Placeholder text3</p>
            </div>
            <div class="this-weeks-creators-image-container">
                <img src="placeholder1.jpg" alt="Placeholder Image 4">
                <p class="this-weeks-creators-image-caption">Placeholder text4</p>
            </div>
        </div>
    </div>
    <div class="this-weeks-creators-box2">
        <div class="this-weeks-creators-images-container">
            <div class="this-weeks-creators-image-container">
                <img src="placeholder1.jpg" alt="Placeholder Image 5">
                <p class="this-weeks-creators-image-caption">Placeholder text5</p>
            </div>
            <div class="this-weeks-creators-image-container">
                <img src="placeholder1.jpg" alt="Placeholder Image 6">
                <p class="this-weeks-creators-image-caption">Placeholder text6</p>
            </div>
            <div class="this-weeks-creators-image-container">
                <img src="placeholder1.jpg" alt="Placeholder Image 7">
                <p class="this-weeks-creators-image-caption">Placeholder text7</p>
            </div>
            <div class="this-weeks-creators-image-container">
                <img src="placeholder1.jpg" alt="Placeholder Image 8">
                <p class="this-weeks-creators-image-caption">Placeholder text8</p>
            </div>
        </div>
    </div>
</div>
<div class="divider"></div>
<div class="join-community-box">
    <div class="join-community-text">
        <p>Join our community</p>
    </div>
</div>
<div class="join-community-box2">
    <div class="community-button-box">
        <button class="community-button">Click Here</button>
    </div>
</div>
<div class="divider">
    <p>© Magic Samples</p>
</div>
</body>
</html>
