@extends('layouts.main')
@section('content')
<head>
    <meta charset="UTF-8">
    <title>Upload Sample</title>
    <link rel="stylesheet" href="{{asset('css/uploadSampleForm.css')}}">
</head>
<body>
<div class="sample-form">
    <h1>Upload Sample</h1>

    <form action="{{ route('samples.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control" rows="3"></textarea>
        </div>

        <!-- Remove the Sample URL field -->

        <div class="form-group">
            <label for="bpm">BPM</label>
            <input type="number" name="bpm" id="bpm" class="form-control">
        </div>

        <div class="form-group">
            <label for="key">Key</label>
            <input type="text" name="key" id="key" class="form-control">
        </div>

        <div class="form-group">
            <label for="genre">Genre</label>
            <input type="text" name="genre" id="genre" class="form-control">
        </div>

        <div class="form-group">
            <label for="instrument">Instrument</label>
            <input type="text" name="instrument" id="instrument" class="form-control">
        </div>

{{--        <div class="custom-file">--}}
{{--            <input type="file" name="file" class="custom-file-input" id="chooseFile" required>--}}
{{--            <label class="custom-file-label" for="chooseFile">Select file</label>--}}
{{--        </div>--}}

{{--        <button type="submit" class="submit-button">Upload Sample</button>--}}
        <div class="container mt-5">
            <form action="{{route('fileUpload')}}" method="post" enctype="multipart/form-data">
                <h3 class="text-center mb-5">Upload File in Laravel</h3>
                @csrf
                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <strong>{{ $message }}</strong>
                    </div>
                @endif
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="custom-file">
                    <input type="file" name="file" class="custom-file-input" id="chooseFile">
                    <label class="custom-file-label" for="chooseFile">Select file</label>
                </div>
                <button type="submit" name="submit" class="btn btn-primary btn-block mt-4">
                    Upload Files
                </button>
            </form>

            {{--    <a href="{{ asset('storage/uploads/1701728082_file_example_MP3_1MG.mp3') }}">Download MP3 File</a>--}}
            {{--    <img class="avatar-picture" src="{{ asset('storage/uploads/music-example-image.jpg') }}">--}}
        </div>
    </form>
</div>

{{--<div class="container mt-5">--}}
{{--    <form action="{{route('fileUpload')}}" method="post" enctype="multipart/form-data">--}}
{{--        <h3 class="text-center mb-5">Upload File in Laravel</h3>--}}
{{--        @csrf--}}
{{--        @if ($message = Session::get('success'))--}}
{{--            <div class="alert alert-success">--}}
{{--                <strong>{{ $message }}</strong>--}}
{{--            </div>--}}
{{--        @endif--}}
{{--        @if (count($errors) > 0)--}}
{{--            <div class="alert alert-danger">--}}
{{--                <ul>--}}
{{--                    @foreach ($errors->all() as $error)--}}
{{--                        <li>{{ $error }}</li>--}}
{{--                    @endforeach--}}
{{--                </ul>--}}
{{--            </div>--}}
{{--        @endif--}}
{{--        <div class="custom-file">--}}
{{--            <input type="file" name="file" class="custom-file-input" id="chooseFile">--}}
{{--            <label class="custom-file-label" for="chooseFile">Select file</label>--}}
{{--        </div>--}}
{{--        <button type="submit" name="submit" class="btn btn-primary btn-block mt-4">--}}
{{--            Upload Files--}}
{{--        </button>--}}
{{--    </form>--}}

{{--    <a href="{{ asset('storage/uploads/1701728082_file_example_MP3_1MG.mp3') }}">Download MP3 File</a>--}}
{{--    <a href="{{ asset('storage/uploads/1703525138_file_example_MP3_1MG - polse.mp3') }}">Download MP3 File</a>--}}

{{--    <img class="avatar-picture" src="{{ asset('storage/uploads/music-example-image.jpg') }}">--}}
{{--</div>--}}
@endsection

