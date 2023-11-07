<head>
    <meta charset="UTF-8">
    <title>Blog Posts</title>
    <link rel="stylesheet" href="{{asset('css/blogPostsStyle.css')}}">
</head>
@extends('layouts.main')
@section('content')
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
            <div class="header-item">Actions</div> <!-- Add a new header item for actions -->
        </div>
        @foreach($blogs as $blog)
        <div class="blog-post-item">
            <div class="blog-item">{{ $blog->title }}</div>
            <div class="blog-item">{{ $blog->content }}</div>
            <div class="blog-item">{{ App\Models\User::find($blog->user_id)->email }}</div>
            <div class="blog-item">{{ $blog->created_at }}</div>

            <div class="blog-item">
                @php
                $authenticatedUserId = auth()->user()->id;
                $blogUserId = $blog->user_id;
                @endphp
                @if($authenticatedUserId === $blogUserId)
                <form method="POST" action="{{ route('blog.delete', ['blog' => $blog->id]) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="delete-button">Delete</button>
                </form>

                @endif
            </div>
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
@endsection
