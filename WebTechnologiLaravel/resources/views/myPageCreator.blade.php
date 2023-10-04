<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Page</title>
    <link rel="stylesheet" href="{{asset('css/myPageCreatorStyle.css')}}">
</head>
<body>

<div class="header">
    <div class="logo">
        <h2>Header Logo</h2>
    </div>
    <div class="header-links-box">
        <li><a href="google.com"  class="header-link">link-one</a></li>
        <li><a href="google.com" class="header-link">link-two</a></li>
        <li><a href="google.com" class="header-link">link-three</a></li>
    </div>
    <div class="login-info">
        <button type="submit" class="signup-button" onclick="window.location.href = 'LoginPage.html';">Your Page</button>
    </div>
</div>

<h1> My Page (creator)</h1>

<section class="flex-column">
    <img class="avatar-picture" src="https://i.imgur.com/PoyiRJw.png">
    <h2>USERNAME</h2>
</section>

<div>
    <button class="upload-button">Upload Sample</button>
</div>

<h4>My Samples</h4>
<div class="header">
    <section class="flex-row">
        <article class="my-page-list">

            <section class="sample">
                <a class="blog-preview-image" href="google.dk">
                    <img class= "my-page-sample-preview" src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/57/Treble_a.svg/1024px-Treble_a.svg.png"></a>
                <a class="my-page-sample-title" href="google.dk">
                    <h3>Title</h3>
                </a>
                <div class="my-page-sample-info"> Date </div>
            </section>
            <section class="my-samples">
                <a class="blog-preview-image" href="google.dk">
                    <img class= "my-page-sample-preview" src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/57/Treble_a.svg/1024px-Treble_a.svg.png"></a>
                <a class="my-page-sample-title" href="google.dk">
                    <h3>Title</h3>
                </a>
                <div class="my-page-sample-info"> Date </div>
            </section>

        </article>

    </section>

</div>

<div class="space-between-elements"></div>

<h4>Downloaded Samples</h4>
<div class="header">
    <section class="flex-row">
        <article class="my-page-list">

            <section class="sample">
                <a class="blog-preview-image" href="google.dk">
                    <img class= "my-page-sample-preview" src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/57/Treble_a.svg/1024px-Treble_a.svg.png"></a>
                <a class="my-page-sample-title" href="google.dk">
                    <h3>Title</h3>
                </a>
                <div class="my-page-sample-info"> Date </div>
            </section>
            <section class="my-samples">
                <a class="blog-preview-image" href="google.dk">
                    <img class= "my-page-sample-preview" src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/57/Treble_a.svg/1024px-Treble_a.svg.png"></a>
                <a class="my-page-sample-title" href="google.dk">
                    <h3>Title</h3>
                </a>
                <div class="my-page-sample-info"> Date </div>
            </section>


        </article>

    </section>

</div>

<div class="space-between-elements"></div>

<h3>Sample Statistics</h3>
<div class="header">
    <section class="flex-row">
        <article class="my-page-list">

            <!-- ADD STATISTICS HERE -->

        </article>

    </section>

</div>

<div class="space-between-elements" ></div>

</body>
</html>
