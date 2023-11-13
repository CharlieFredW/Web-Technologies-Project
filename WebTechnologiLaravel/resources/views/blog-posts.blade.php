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
                <div id="loadingMessage" style="display: none;">Loading comments...</div>
                <form id="commentForm" data-comment-id="">
                    @csrf
                    <label for="comment">Your Comment:</label>
                    <textarea id="comment" name="comment" rows="4" cols="50" required></textarea><br>
                    <button type="button" onclick="postComment()">Post Comment</button>
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
        var currentBlogId = null;
        var commentInput = null; // Declare the variable globally


        function toggleContent(title, content, author, date, element) {
            var contentDiv = document.getElementById('selectedBlogContent');
            var titleElement = document.getElementById('selectedBlogTitle');
            var textElement = document.getElementById('selectedBlogText');
            var authorElement = document.getElementById('selectedBlogAuthor');
            var dateElement = document.getElementById('selectedBlogDate');
            var commentList = document.getElementById('commentList');
            var loadingMessage = document.getElementById('loadingMessage');
            var commentForm = document.getElementById('commentForm');

            currentBlogId = element.getAttribute('data-blog-id');

            titleElement.innerText = title;
            textElement.innerText = content;
            authorElement.innerText = 'Author: ' + author;
            dateElement.innerText = 'Date: ' + date;

            commentList.style.display = 'none';
            loadingMessage.style.display = 'block';

            loadComments(currentBlogId);

            if (contentDiv.style.display === 'none' || contentDiv.style.display === '') {
                var titleRect = element.getBoundingClientRect();
                contentDiv.style.top = (titleRect.bottom + window.scrollY) + 'px';
                contentDiv.style.left = titleRect.left + 'px';
                contentDiv.style.display = 'block';
            } else {
                contentDiv.style.display = 'none';
            }
        }

        function editComment(commentId, commentContent) {
            commentInput = document.getElementById('comment'); // Update the global variable
            var commentForm = document.getElementById('commentForm');

            commentForm.setAttribute('data-comment-id', commentId);
            commentInput.value = commentContent;

            commentInput.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }

        function postComment() {
            commentInput = document.getElementById('comment'); // Update the global variable
            var commentForm = document.getElementById('commentForm');
            var commentId = commentForm.getAttribute('data-comment-id');

            if (commentId) {
                // Update existing comment
                updateComment(commentId, commentInput.value);
            } else {
                // Post new comment
                postNewComment(commentInput.value);
            }

            // Clear the textarea and reset data-comment-id attribute after posting/editing
            commentForm.removeAttribute('data-comment-id');
            commentInput.value = '';
        }

        function postNewComment(commentContent) {
            fetch('/comments', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                body: JSON.stringify({
                    blogId: currentBlogId,
                    comment: commentContent,
                }),
            })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    loadComments(currentBlogId);
                    commentInput.value = ''; // Clear the textarea
                })
                .catch(error => {
                    console.error('Error posting comment:', error);
                });
        }



        function updateComment(commentId) {
            // Retrieve the updated comment from the textarea
            var updatedComment = document.getElementById('comment').value;

            // Make an AJAX request to update the comment
            fetch('/comments/' + commentId, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                body: JSON.stringify({
                    comment: updatedComment,
                }),
            })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Comment updated successfully:', data);
                    // Reload comments after updating
                    loadComments(currentBlogId);
                })
                .catch(error => {
                    console.error('Error updating comment:', error);
                });
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
                    var loadingMessage = document.getElementById('loadingMessage');
                    loadingMessage.style.display = 'none';

                    if (response.comments && response.comments.length > 0) {
                        displayComments(response);
                    } else {
                        var commentList = document.getElementById('commentList');
                        commentList.innerHTML = '<li>No comments yet.</li>';
                    }
                })
                .catch(error => {
                    console.error('Error loading comments:', error);
                });
        }

        function displayComments(comments) {
            var commentList = document.getElementById('commentList');
            commentList.innerHTML = '';

            if (Array.isArray(comments.comments)) {
                comments.comments.forEach(function (comment) {
                    if (comment.blog_id == currentBlogId) {
                        var li = document.createElement('li');
                        if (comment.user && comment.user.name) {
                            li.innerText = comment.user.name + ' commented: ' + comment.comment;
                        } else {
                            li.innerText = 'A user commented: ' + comment.comment;
                        }

                        if (comment.user && comment.user.is_owner) {
                            var editButton = document.createElement('button');
                            editButton.innerText = 'Edit';
                            editButton.onclick = function() {
                                editComment(comment.id, comment.comment);
                            };
                            li.appendChild(editButton);
                        }

                        commentList.appendChild(li);
                    }
                });
                commentList.style.display = 'block';
            } else {
                console.error('Invalid comments data:', comments);
            }
        }

    </script>

</div>
@endsection
