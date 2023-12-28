@extends('layouts.main')
@section('content')
    <head>
        <meta charset="UTF-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Upload Sample</title>
        <link rel="stylesheet" href="{{asset('css/uploadSampleForm.css')}}">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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


            <div class="form-group">

                <label for="file">File</label>
                <p>Allowed file types: m4a, mp3, wav, wma</p>
                <p>Maximum file size: 10,240 KB</p>
                <input type="file" name="file" id="file" class="form-control" required>
                <progress id="uploadProgress" value="0" max="100"></progress>
                <span id="progressText">0%</span>
                <div id="fileUploadErrorMessage" class="error-message"></div>
            </div>

            <button type="submit" id="submitSample" class="submit-button" disabled>Upload Sample</button>
        </form>
    </div>
    <script> const uploadRoute = '{{ route('fileUpload') }}';</script>
    <script src="{{ asset('js/sampleUpload.js') }}"></script>
@endsection
