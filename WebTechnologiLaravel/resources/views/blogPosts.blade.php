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
                    <li><button class="logout-button">Log Out</button></li>
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
        <p class="blog-frontpage-text">Blog Posts</p>
    </div>

    <div class="blog-posts-container">
        <div class="blog-post-header">
            <div class="header-item">Title</div>
            <div class="header-item">Content</div>
            <div class="header-item">Author</div>
            <div class="header-item">Created At</div>
        </div>
        @foreach($blogs as $blog)
        <div class="blog-post-item">
            <div class="blog-item">{{ $blog->Title }}</div>
            <div class="blog-item">{{ $blog->content }}</div>
            <div class="blog-item">{{ $blog->user }}</div>
            <div class="blog-item">{{ $blog->created_at }}</div>
        </div>
        @endforeach
    </div>


<div class="divider"></div>

    <div class="create-post-section">
        @if(Auth::check())
        <div class="blog-frontpage-title">
            <p class="blog-frontpage-text">Create a New Blog Post</p>
        </div>
        <form method="POST" action="{{ route('blog.store') }}" class="blog-preview-half-page">
            @csrf
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" required><br>

            <label for="content">Content:</label><br>
            <textarea id="content" name="content" rows="4" cols="50" required></textarea><br>

            <button type="submit" class="login-button">Publish Post</button>
        </form>
        @endif
    </div>

</div>

</body>
</html>
