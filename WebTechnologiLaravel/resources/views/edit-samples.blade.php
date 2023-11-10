@extends('layouts.main')
@section('content')
    <head>
        <meta charset="UTF-8">
        <title>Upload Sample</title>
        <link rel="stylesheet" href="{{asset('css/uploadSampleForm.css')}}">
    </head>
    <body>
    <div class="sample-form">
        <h1>Edit Sample</h1>

        <form action="{{ route('samples.update',  $sample->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" class="form-control" value="{{ $sample->title }}" required>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control" rows="3">{{ $sample->description }}</textarea>
            </div>

            <div class="form-group">
                <label for="url">Sample URL</label>
                <input type="text" name="url" id="url" class="form-control" value="{{ $sample->url }}" required>
            </div>

            <div class="form-group">
                <label for="bpm">BPM</label>
                <input type="number" name="bpm" id="bpm" class="form-control" value="{{ $sample->bpm }}">
            </div>

            <div class="form-group">
                <label for="key">Key</label>
                <input type="text" name="key" id="key" class="form-control" value="{{ $sample->key }}">
            </div>

            <div class="form-group">
                <label for="genre">Genre</label>
                <input type="text" name="genre" id="genre" class="form-control" value="{{ $sample->genre }}">
            </div>

            <div class="form-group">
                <label for="instrument">Instrument</label>
                <input type="text" name="instrument" id="instrument" class="form-control" value="{{ $sample->instrument }}">
            </div>

            <button type="submit" class="submit-button">Update Sample</button>
            <button type="button" class="submit-button" onclick="window.location.href = '{{ route('my-page-creator') }}'">Cancel</button>
        </form>
    </div>
@endsection

