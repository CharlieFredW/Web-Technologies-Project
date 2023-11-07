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

    <form action="{{ route('samples.store') }}" method="POST">
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
            <label for="url">Sample URL</label>
            <input type="text" name="url" id="url" class="form-control" required>
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

        <button type="submit" class="submit-button">Upload Sample</button>
    </form>
</div>
@endsection

