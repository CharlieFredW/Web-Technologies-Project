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
        <ul class="sample-items">
            <li class="sample-item"><img class="sample-image" src="{{ asset('images/album-cover1.jpg') }}" alt="Sample 1"></li>
            <li class="sample-item"><h3>Sample 1 Title</h3></li>
            <li class="sample-item"><p>BPM: 120</p></li>
            <li class="sample-item"><p>Key: C Major</p></li>
        </ul>
        <ul class="sample-items">
            <li class="sample-item"><img class="sample-image" src="{{ asset('images/album-cover2.jpg') }}" alt="Sample 1"></li>
            <li class="sample-item"><h3>Sample 2 Title</h3></li>
            <li class="sample-item"><p>BPM: 125</p></li>
            <li class="sample-item"><p>Key: A Major</p></li>
        </ul>
        <ul class="sample-items">
            <li class="sample-item"><img class="sample-image" src="{{ asset('images/album-cover3.jpg') }}" alt="Sample 1"></li>
            <li class="sample-item"><h3>Sample 3 Title</h3></li>
            <li class="sample-item"><p>BPM: 135</p></li>
            <li class="sample-item"><p>Key: B Major</p></li>
        </ul>
        <ul class="sample-items">
            <li class="sample-item"><img class="sample-image" src="{{ asset('images/album-cover2.jpg') }}" alt="Sample 1"></li>
            <li class="sample-item"><h3>Sample 4 Title</h3></li>
            <li class="sample-item"><p>BPM: 145</p></li>
            <li class="sample-item"><p>Key: F Major</p></li>
        </ul>
    </div>
</div>
</body>
</html>
