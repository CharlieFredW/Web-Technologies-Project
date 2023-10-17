<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Page</title>
    <link rel="stylesheet" href="{{asset('css/myPageCreatorStyle.css')}}">
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
                <li><a href="{{ asset('/') }}" class="home-page-button">Home Page</a></li>
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
<div class="my-page-frontpage-title">
    <p class="my-page-frontpage-text"> My Page (creator)</p>
</div>

<div class="flex-column">
    <img class="avatar-picture" src="https://i.imgur.com/PoyiRJw.png">
    <h2>USERNAME</h2>
</div>

<div class="upload-button-box">
    <a href="/createSample" class="upload-button">Upload Sample</a>
</div>

<div class="my-samples-heading">
    <p class="my-samples-heading-text">My Samples</p>
</div>
<div class="my-samples-box">
    <div class="flex-row">
        <article class="my-page-list">

            <div class="sample">
                <a class="blog-preview-image" href="google.dk">
                    <img class="my-page-sample-preview"
                         src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/57/Treble_a.svg/1024px-Treble_a.svg.png"></a>
                <a class="my-page-sample-title" href="google.dk">
                    <h3>Title</h3>
                </a>
                <div class="my-page-sample-info"> Date</div>
            </div>
            <div class="my-samples">
                <a class="blog-preview-image" href="google.dk">
                    <img class="my-page-sample-preview"
                         src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/57/Treble_a.svg/1024px-Treble_a.svg.png"></a>
                <a class="my-page-sample-title" href="google.dk">
                    <h3>Title</h3>
                </a>
                <div class="my-page-sample-info"> Date</div>
            </div>

        </article>

    </div>

</div>

<div class="space-between-elements"></div>
<div class="downloaded-samples-heading">
    <p class="downloaded-samples-text">Downloaded Samples</p>
</div>
<div class="my-samples-box">
    <div class="flex-row">
        <article class="my-page-list">

            <div class="sample">
                <a class="blog-preview-image" href="google.dk">
                    <img class="my-page-sample-preview"
                         src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/57/Treble_a.svg/1024px-Treble_a.svg.png"></a>
                <a class="my-page-sample-title" href="google.dk">
                    <h3>Title</h3>
                </a>
                <div class="my-page-sample-info"> Date</div>
            </div>
            <div class="my-samples">
                <a class="blog-preview-image" href="google.dk">
                    <img class="my-page-sample-preview"
                         src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/57/Treble_a.svg/1024px-Treble_a.svg.png"></a>
                <a class="my-page-sample-title" href="google.dk">
                    <h3>Title</h3>
                </a>
                <div class="my-page-sample-info"> Date</div>
            </div>


        </article>

    </div>

</div>

<div class="space-between-elements"></div>

<div class="sample-statistics-heading">
    <p class="sample-statistics-text">Sample Statistics</p>
</div>
<div class="my-samples-box">
    <div class="flex-row">
        <article class="my-page-list">

            <!-- ADD STATISTICS HERE -->

        </article>

    </div>

</div>

<div class="space-between-elements"></div>
<div class="divider"></div>
</body>
</html>
