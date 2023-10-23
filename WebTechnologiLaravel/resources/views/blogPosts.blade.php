<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Blog Posts</title>
    <link rel="stylesheet" href="{{asset('css/blogPostsStyle.css')}}">
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
                    <li><a class="logout-button">Log Out</a></li>
                </form>
            @else
                <li><a href="{{ asset('/login') }}" class="login-button">Log In</a></li>
                <li><a href="{{ asset('/signup') }}" class="signup-button">Sign Up</a></li>
            @endif
        </div>
    </div>
</div>
<div class="blog-frontpage">
    <div class="blog-frontpage-title">
        <p class="blog-frontpage-text">Blog Posts<p>
    </div>
    <div class="flex-row">
        <div class="blog-preview-side1">
            <div class="blog-preview-half-page">
                <a class="blog-preview-image" href="blogposts/TestBlogPost.html">
                    <img class= "blog-preview-thumbnail" src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/57/Treble_a.svg/1024px-Treble_a.svg.png"></a>
                <a class="blog-preview-title" href="blogposts/TestBlogPost.html">
                    <h2>Title</h2>
                </a>
                <div class="blog-preview-info"> Author | Date </div>
            </div>
        </div>
        <div class="blog-preview-side2">
            <div class="flex-column">
                <div class="blog-preview-title-box">
                    <a class="blog-preview-title" href="blogposts/TestBlogPost.html">
                        <p class="blog-preview-title-box-text">Title</p>
                    </a>
                </div>

                <div class="blog-preview-title-box">
                    <a class="blog-preview-title" href="blogposts/TestBlogPost.html">
                        <p class="blog-preview-title-box-text">Title</p>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="divider"></div>
<div class="blog-second-page-title">
    <p class="blog-frontpage-text">Today's Top Blog Post<p>
</div>
<div class="blog-preview-full-page">
    <div class="blog-preview-full-page-inner-box">
        <a class="blog-preview-image" href="blogposts/TestBlogPost.html">
            <img class= "blog-preview-thumbnail" src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/57/Treble_a.svg/1024px-Treble_a.svg.png"></a>
        <div class="text-padding">
            <a class="blog-preview-title" href="blogposts/TestBlogPost.html">
                <h2>Title</h2>
            </a>
            <div class="blog-preview-info"> Author | Date </div>
        </div>
    </div>
</div>
<div class="divider"></div>
</body>
</html>
