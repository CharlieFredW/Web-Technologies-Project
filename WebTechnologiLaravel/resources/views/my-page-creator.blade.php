@extends('layouts.main')
@section('content')
<head>
    <meta charset="UTF-8">
    <title>My Page</title>
    <link rel="stylesheet" href="{{asset('css/myPageCreatorStyle.css')}}">
</head>

<div class="my-page-frontpage-title">
    <p class="my-page-frontpage-text"> My Page (creator)</p>
</div>

<div class="flex-column">
    <img class="avatar-picture" src="https://i.imgur.com/PoyiRJw.png" alt="yee">
    <h2>USERNAME</h2>
</div>

<div class="upload-button-box">
    <a href="/create-sample" class="upload-button">Upload Sample</a>
</div>

<div class="my-samples-heading">
    <p class="my-samples-heading-text">My Samples</p>
</div>
<div class="new-samples-box">

    <div class="my-samples-images-container">
        @foreach($mySamples as $mySample)
            <div class="my-samples-image-container">
                <img class="sample-image" src="{{ $mySample->image_url }}" alt="{{ $mySample->title }}">
                <p class="my-samples-image-caption">{{ $mySample->title }}</p>
            </div>
        @endforeach
    </div>
</div>

<div class="space-between-elements"></div>
<div class="downloaded-samples-heading">
    <p class="downloaded-samples-text">Downloaded Samples</p>
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

@endsection
