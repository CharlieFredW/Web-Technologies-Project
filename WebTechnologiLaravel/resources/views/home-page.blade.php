@extends('layouts.main')
@section('content')
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="{{asset('css/homepageStyle.css')}}">
</head>
<div class="new-samples-box">
    <div class="new-samples-text">
        <p>New Samples</p>
    </div>
    <x-new-samples :newSamples="$newSamples"/>
</div>
<div class="divider"></div>
<div class="blog-container">
    <p class="blog-heading">Today's Blog Post Choice</p>
    <x-todays-blog-posts :todayBlogPosts="$todayBlogPosts"/>
</div>
<div class="divider"></div>
<div class="today-picks-box">
    <div class="today-picks-text">
        <p>Today's Top Picks</p>
    </div>
    <x-this-weeks-samples :todaySamples="$todaySamples"/>
</div>
<div class="divider"></div>
<div class="this-weeks-creators-text">
    <p>Top Creators This Week</p>
</div>
<div class="this-weeks-creators-container">
    <x-this-weeks-creators :thisWeeksTopCreators="$thisWeeksTopCreators"/>
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

