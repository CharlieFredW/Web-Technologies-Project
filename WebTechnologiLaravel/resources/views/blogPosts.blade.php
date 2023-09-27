<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Blog Posts</title>
    <link rel="stylesheet" href="<?php echo asset('css/blogPostsStyle.css')?>">
</head>
<body>
<div class="header">
    <div class="logo">
        <h2>Header Logo</h2>
    </div>
    <div class="header-links-box">
        <li><a href="google.com" class="header-link">link-one</a></li>
        <li><a href="google.com" class="header-link">link-two</a></li>
        <li><a href="google.com" class="header-link">link-three</a></li>
    </div>
    <div class="login-info">
        <li><a href="../LoginPage.html" class="login-button">Log In</a></li>
        <li><a href="../LoginPage.html" class="signup-button">Sign Up</a></li>
    </div>
</div>
<h1>Blogs</h1>
<section class="flex-row">
    <article class="blog-preview-half-page">
        <a class="blog-preview-image" href="blogposts/TestBlogPost.html">
            <img class= "blog-preview-thumbnail" src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/57/Treble_a.svg/1024px-Treble_a.svg.png"></a>
        <a class="blog-preview-title" href="blogposts/TestBlogPost.html">
            <h2>Title</h2>
        </a>
        <div class="blog-preview-info"> Author | Date </div>
    </article>

    <section class="flex-column">
        <article class="blog-preview-half-page">
            <a class="blog-preview-title" href="blogposts/TestBlogPost.html">
                <h2>Title</h2>
            </a>
        </article>

        <article class="blog-preview-half-page">
            <a class="blog-preview-title" href="blogposts/TestBlogPost.html">
                <h2>Title</h2>
            </a>
        </article>
    </section>
</section>
<article class="blog-preview-full-page">
    <section class="flex-row">
        <a class="blog-preview-image" href="blogposts/TestBlogPost.html">
            <img class= "blog-preview-thumbnail" src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/57/Treble_a.svg/1024px-Treble_a.svg.png"></a>
        <section class="text-padding">
            <a class="blog-preview-title" href="blogposts/TestBlogPost.html">
                <h2>Title</h2>
            </a>
            <div class="blog-preview-info"> Author | Date </div>
        </section>
    </section>
</article>

</body>
</html>
