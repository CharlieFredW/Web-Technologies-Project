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
    <div class="edit-profile">
        <button><a href="{{ asset('/edit-profile-page') }}" class="edit-profile-text">Edit Profile</a></button>
    </div>
</div>

<div class="upload-button-box">
    <a href="/samples/create" class="upload-button">Upload Sample</a>
</div>

<div class="my-samples-heading">
    <p class="my-samples-heading-text">My Samples</p>
</div>
<div class="my-samples-box">

    <div class="my-samples-images-container">
        @foreach($mySamples as $mySample)

            <div class="my-samples-image-container">
                <img class="sample-image" src="{{ $mySample->image_url }}" alt="{{ $mySample->title }}">
                <p class="my-samples-image-caption"><span class="sample-title">Title: {{ $mySample->title }}</span><br>
                    {{ $mySample->created_at }} <br>
                    <a href="{{ route('samples.edit', $mySample) }}">Edit</a>
                    <a href="{{ route('samples.destroy', $mySample) }}" >
                        <form action="{{ route('samples.destroy', $mySample) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="button-hyperlink">Delete</button>
                        </form>
                    </a>
                </p>
            </div>
        @endforeach
    </div>
</div>

<div class="space-between-elements"></div>
<div class="downloaded-samples-heading">
    <p class="downloaded-samples-text">Downloaded Samples</p>
</div>
<div class="my-samples-box">
    <div class="flex-row">
        <article class="my-page-list">

            <div class="sample">
                <a class="blog-preview-image" href="google.dk">
                    <img class="my-page-sample-preview"
                         src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/57/Treble_a.svg/1024px-Treble_a.svg.png"></a>
                <a class="my-page-sample-title" href="google.dk">
                    <h3>Title</h3>
                </a>
                <div class="my-page-sample-info"> Date</div>
            </div>
            <div class="my-samples">
                <a class="blog-preview-image" href="google.dk">
                    <img class="my-page-sample-preview"
                         src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/57/Treble_a.svg/1024px-Treble_a.svg.png"></a>
                <a class="my-page-sample-title" href="google.dk">
                    <h3>Title</h3>
                </a>
                <div class="my-page-sample-info"> Date</div>
            </div>


        </article>

    </div>

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
