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

    <div id="blogContainer">
        <div id="blogTitles" class="blog-titles">
            <div id="titlesRectangle"></div>
            <p class="blog-dropdown-title">Blogs Title:</p>
            @foreach($blogs as $blog)
            <p
                data-blog-id="{{ $blog->id }}"
                onclick="toggleContent('{{ $blog->title }}', '{{ $blog->content }}', '{{ $blog->user->name }}', '{{ $blog->created_at }}', this)"
            >
                {{ $blog->title }}
            </p>
            @endforeach
        </div>

        <div class="divider"></div>

        <!-- Selected Blog Content dropdownStyle menu -->
        <div id="selectedBlogContent" style="display: none; position: absolute;">
            <h2 id="selectedBlogTitle"></h2>
            <p id="selectedBlogText"></p>
            <p id="selectedBlogAuthor"></p>
            <p id="selectedBlogDate"></p>

            <!-- Comment Section Things -->
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

    <!--New Blog Post Section-->
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
        //Added variables
        var currentBlogId = null;
        var commentInput = null;


        //This is the function to toggle the content from the blog
        function toggleContent(title, content, author, date, element) {

            //All the content for the dropdown menu for selected blog post
            var contentDiv = document.getElementById('selectedBlogContent');
            var titleElement = document.getElementById('selectedBlogTitle');
            var textElement = document.getElementById('selectedBlogText');
            var authorElement = document.getElementById('selectedBlogAuthor');
            var dateElement = document.getElementById('selectedBlogDate');
            var commentList = document.getElementById('commentList');
            var loadingMessage = document.getElementById('loadingMessage');
            var commentForm = document.getElementById('commentForm');

            //The ID of the selected blog post
            currentBlogId = element.getAttribute('data-blog-id');

            //All the elements
            titleElement.innerText = title;
            textElement.innerText = content;
            authorElement.innerText = 'Author: ' + author;
            dateElement.innerText = 'Date: ' + date;

            commentList.style.display = 'none';
            loadingMessage.style.display = 'block';

            //The method that reloads the comments
            loadComments(currentBlogId);

            //Placemment of the content dropdown menu
            if (contentDiv.style.display === 'none' || contentDiv.style.display === '') {
                var titlesRectangle = document.getElementById('titlesRectangle').getBoundingClientRect();
                var requiredHeight = titlesRectangle.height + 200;
                var scrollTop = window.scrollY || document.documentElement.scrollTop;
                var scrollLeft = window.scrollX || document.documentElement.scrollLeft;

                //More placement
                contentDiv.style.top = titlesRectangle.top + scrollTop + 'px';
                contentDiv.style.left = titlesRectangle.left + 'px';
                contentDiv.style.width = '950px';
                contentDiv.style.height = requiredHeight + 'px';
                contentDiv.style.display = 'block';
            } else {
                contentDiv.style.display = 'none';
            }
        }

        //Functino to edit a comment if the user created the comment
        function editComment(commentId, commentContent) {
            commentInput = document.getElementById('comment');
            var commentForm = document.getElementById('commentForm');

            commentForm.setAttribute('data-comment-id', commentId);
            commentInput.value = commentContent;

            commentInput.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }

        //Function to postComment
        function postComment() {
            commentInput = document.getElementById('comment');

            //Variables getFuntions
            var commentForm = document.getElementById('commentForm');
            var commentId = commentForm.getAttribute('data-comment-id');

            if (commentId) {
                // Update existing comment
                updateComment(commentId, commentInput.value);
            } else {
                // Post new comment
                postNewComment(commentInput.value);
            }

            // Clear the textarea and reset data CommentId
            commentForm.removeAttribute('data-comment-id');
            commentInput.value = '';
        }


        //Method for posting a new comment
        function postNewComment(commentContent) {
            //Request (Async)
            fetch('/comments', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                //Make strings from the comment information
                body: JSON.stringify({
                    blogId: currentBlogId,
                    comment: commentContent,
                }),
            })
                //Give json response upon error
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                //Reaload the comments after posting comment
                .then(data => {
                    loadComments(currentBlogId);
                    commentInput.value = '';
                })
                .catch(error => {
                    console.error('Error posting comment:', error);
                });
        }

        //Function to update (edit) a comment
        function updateComment(commentId) {
            // Updated/edited comment
            var updatedComment = document.getElementById('comment').value;

            // AJAX request to update the comment using fetch
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
                    // Reload comments
                    loadComments(currentBlogId);
                })
                .catch(error => {
                    console.error('Error updating comment:', error);
                });
        }

        //Loads the comments on a blog post
        function loadComments(blogId) {
            fetch('/comments/' + blogId)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                //Styling settings
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


        //Delete method for comemnts
        function deleteComment(commentId) {

            //Using ajax, Fetch request
            fetch('/comments/' + commentId, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
            })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Comment deleted successfully:', data);
                    // Reload comments
                    loadComments(currentBlogId);
                })
                .catch(error => {
                    console.error('Error deleting comment:', error);
                });
        }




        //Display the comments
        function displayComments(comments) {
            //gets the comment by ID
            var commentList = document.getElementById('commentList');
            commentList.innerHTML = '';

            //If the comments is working
            if (Array.isArray(comments.comments)) {
                //Loop and get all the comments for the specific blog ppost
                comments.comments.forEach(function (comment) {

                    //Shows all the comments with user who created it
                    if (comment.blog_id == currentBlogId) {
                        var li = document.createElement('li');
                        if (comment.user && comment.user.name) {
                            li.innerText = comment.user.name + ' commented: ' + comment.comment;
                        } else {
                            li.innerText = 'A user commented: ' + comment.comment;
                        }

                        //If the user authenticated is the creater of the comment,
                        // add an edit and delete button
                        if (comment.user && comment.user.is_owner) {
                            var editButton = document.createElement('button');
                            editButton.innerText = 'Edit';
                            editButton.onclick = function() {
                                editComment(comment.id, comment.comment);
                            };
                            li.appendChild(editButton);

                            var deleteButton = document.createElement('button');
                            deleteButton.innerText = 'Delete';
                            deleteButton.onclick = function() {
                                deleteComment(comment.id);
                            };
                            li.appendChild(deleteButton);
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
