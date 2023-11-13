@extends('layouts.main')

@section('content')
<head>
    <meta charset="UTF-8">
    <title>Blog Posts</title>
    <link rel="stylesheet" href="{{ asset('css/blogPostsStyle.css') }}">
</head>
<div class="blog-frontpage">
    <div class="blog-frontpage-title">
        <p class="blog-frontpage-text">Blog Posts</p>
    </div>

    <!-- Blogs Section -->
    <div id="blogContainer">
        <div id="blogTitles" class="blog-titles">
            <p class="blog-dropdown-title">Blogs:</p>
            @foreach($blogs as $blog)
            <p
                data-blog-id="{{ $blog->id }}"
                onclick="toggleContent('{{ $blog->title }}', '{{ $blog->content }}', '{{ $blog->user->name }}', '{{ $blog->created_at }}', this)"
            >
                {{ $blog->title }} (ID: {{ $blog->id }})
            </p>
            @endforeach
        </div>

        <div class="divider"></div>

        <!-- Selected Blog Content Popup -->
        <div id="selectedBlogContent" style="display: none; position: absolute;">
            <h2 id="selectedBlogTitle"></h2>
            <p id="selectedBlogText"></p>
            <p id="selectedBlogAuthor"></p>
            <p id="selectedBlogDate"></p>

            <!-- Comment Section -->
            <div id="commentSection">
                <h3>Comments</h3>
                <ul id="commentList"></ul>
                <form id="commentForm">
                    @csrf
                    <input type="hidden" id="blogId" value="{{ $blog->id }}">
                    <label for="comment">Your Comment:</label>
                    <textarea id="comment" name="comment" rows="4" cols="50" required></textarea><br>
                    <button type="button" onclick="postComment('{{ $blog->id }}')">Post Comment</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Create a New Blog Post Section -->
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

    <script>
        // Define a global variable to store the current blog ID
        var currentBlogId = null;

        function toggleContent(title, content, author, date, element) {
            var contentDiv = document.getElementById('selectedBlogContent');
            var titleElement = document.getElementById('selectedBlogTitle');
            var textElement = document.getElementById('selectedBlogText');
            var authorElement = document.getElementById('selectedBlogAuthor');
            var dateElement = document.getElementById('selectedBlogDate');
            var commentList = document.getElementById('commentList');
            var commentForm = document.getElementById('commentForm');

            // Set the current blog ID
            currentBlogId = element.getAttribute('data-blog-id');

            titleElement.innerText = title;
            textElement.innerText = content;
            authorElement.innerText = 'Author: ' + author;
            dateElement.innerText = 'Date: ' + date;

            // Load comments for the selected blog
            loadComments(currentBlogId);

            // Toggle the display of the content
            if (contentDiv.style.display === 'none' || contentDiv.style.display === '') {
                // Show the content and move the titles down
                var titleRect = element.getBoundingClientRect();
                contentDiv.style.top = (titleRect.bottom + window.scrollY) + 'px'; // Adjust for page scroll
                contentDiv.style.left = titleRect.left + 'px';
                contentDiv.style.display = 'block';
            } else {
                // Hide the content
                contentDiv.style.display = 'none';
            }
        }

        function postComment() {
            var commentInput = document.getElementById('comment');

            console.log('Posting comment for blogId:', currentBlogId);

            fetch('/comments', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}', // Include the CSRF token
                },
                body: JSON.stringify({
                    blogId: currentBlogId,
                    comment: commentInput.value,
                }),
            })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Comment posted successfully:', data);
                    // Add the new comment to the commentList
                    var commentList = document.getElementById('commentList');
                    var li = document.createElement('li');
                    li.innerText = data.user.name + ' commented: ' + commentInput.value;
                    commentList.appendChild(li);
                })
                .catch(error => {
                    console.error('Error posting comment:', error);
                });

            // Clear the comment input
            commentInput.value = '';
        }


        function loadComments(blogId) {
            fetch('/comments/' + blogId)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(response => {
                    displayComments(response);
                })
                .catch(error => {
                    console.error('Error loading comments:', error);
                });
        }

        function displayComments(comments) {
            console.log('Received comments:', comments);

            var commentList = document.getElementById('commentList');
            commentList.innerHTML = ''; // Clear previous comments

            if (Array.isArray(comments)) {
                comments.forEach(function (comment) {
                    var li = document.createElement('li');
                    // Check if comment.user is not null before accessing its properties
                    if (comment.user && comment.user.name) {
                        li.innerText = comment.user.name + ' commented: ' + comment.comment;
                    } else {
                        li.innerText = 'A user commented: ' + comment.comment;
                    }
                    commentList.appendChild(li);
                });
            } else {
                console.error('Invalid comments data:', comments);
            }
        }


    </script>

</div>
@endsection
