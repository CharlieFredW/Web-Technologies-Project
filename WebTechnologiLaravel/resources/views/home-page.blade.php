<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="{{asset('css/homepageStyle.css')}}">
</head>
@extends('layouts.main')
@section('content')
<div class="new-samples-box">
    <div class="new-samples-text">
        <p>New Samples</p>
    </div>
</div>
<div class="divider"></div>
<div class="blog-container">
    <p class="blog-heading">Today's Blog Post Choice</p>
    <div class="blog-images-container">
        @for ($i = 0; $i < min(3, count($todayBlogPosts)); $i++)
        <div class="blog-image-container">
            <img src="placeholder1.jpg" alt="Placeholder Image 1">
            <p class="blog-image-caption">{{ $todayBlogPosts[$i]->title }}</p>
        </div>
        @endfor
    </div>
</div>
<div class="divider"></div>
<div class="today-picks-box">
    <div class="today-picks-text">
        <p>Today's Top Picks</p>
    </div>
    <div class="today-picks-images-container">
        @for ($i = 0; $i < min(6, count($todaySamples)); $i++)
            <div class="today-picks-image-container">
                <img class="sample-image" src="{{ $todaySamples[$i]->image_url }}" alt="{{ $todaySamples[$i]->title }}">
                <p class="today-picks-image-caption">{{ $todaySamples[$i]->title }}</p>
            </div>
        @endfor
    </div>
</div>
<div class="divider"></div>
<div class="this-weeks-creators-text">
    <p>Top Creators This Week</p>
</div>
<div class="this-weeks-creators-container">
    <div class="this-weeks-creators-box">
        <div class="this-weeks-creators-images-container">
            @for ($i = 0; $i < min(4, count($thisWeeksTopCreators)); $i++)
            <div class="this-weeks-creators-image-container">
                <img src="{{ $thisWeeksTopCreators[$i]->image_url }}" alt="{{ $thisWeeksTopCreators[$i]->title }}">
                <p class="this-weeks-creators-image-caption">{{ $thisWeeksTopCreators[$i]->title }}</p>
            </div>
            @endfor
        </div>
    </div>
    <div class="this-weeks-creators-box2">
        <div class="this-weeks-creators-images-container">
            @for ($i = 4; $i < min(8, count($thisWeeksTopCreators)); $i++)
            <div class="this-weeks-creators-image-container">
                <img src="{{ $thisWeeksTopCreators[$i]->image_url }}" alt="{{ $thisWeeksTopCreators[$i]->title }}">
                <p class="this-weeks-creators-image-caption">{{ $thisWeeksTopCreators[$i]->title }}</p>
            </div>
            @endfor
        </div>
    </div>
</div>
<div class="divider"></div>
<div class="join-community-box">
    <div class="join-community-text">
        <p>Join our community</p>
    </div>
</div>
<div class="join-community-box2">
    <div class="community-button-box">
        <button class="community-button">Click Here</button>
    </div>
</div>
@endsection

