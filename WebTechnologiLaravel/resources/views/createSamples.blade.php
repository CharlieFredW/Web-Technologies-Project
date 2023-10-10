<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Upload Sample</title>
    <link rel="stylesheet" href="{{asset('css/uploadSampleForm.css')}}">
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
                    <li><a class="logout-button">Log Out</a></li>
                </form>
            @else
                <li><a href="{{ asset('/login') }}" class="login-button">Log In</a></li>
                <li><a href="{{ asset('/signup') }}" class="signup-button">Sign Up</a></li>
            @endif
        </div>
    </div>
</div>



<div class="sample-form">
    <h1>Upload Sample</h1>

    <form action="{{ route('samples.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control" rows="3"></textarea>
        </div>

        <div class="form-group">
            <label for="url">Sample URL</label>
            <input type="text" name="url" id="url" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="bpm">BPM</label>
            <input type="number" name="bpm" id="bpm" class="form-control">
        </div>

        <div class="form-group">
            <label for="key">Key</label>
            <input type="text" name="key" id="key" class="form-control">
        </div>

        <div class="form-group">
            <label for="genre">Genre</label>
            <input type="text" name="genre" id="genre" class="form-control">
        </div>

        <div class="form-group">
            <label for="instrument">Instrument</label>
            <input type="text" name="instrument" id="instrument" class="form-control">
        </div>

        <button type="submit" class="submit-button">Upload Sample</button>
    </form>
</div>


<div class="divider"></div>
</body>
</html>
