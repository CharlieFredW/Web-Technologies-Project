@extends('layouts.main')
@section('content')
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="{{asset('css/editProfilePage.css')}}">
</head>
<div class="flex-column">
    <img class="avatar-picture" src="{{asset('images/avatar/PoyiRJw.png')}}" alt="yee">
    <h2>{{ $user->name }}</h2>
</div>
<div class="edit-profile-form">
    <form method="post" action="{{ route('update.username') }}">
        @csrf
        @method('put')
        <label for="name">Username:</label>
        <input type="text" id="name" name="name" value="{{ $user->name }}" required><br><br>
        <button type="submit" class="signup-button">Change username</button>
        @if(session('username_success'))
            <div class="alert alert-success">{{ session('username_success') }}</div>
        @endif
    </form>
</div>
<div class="edit-profile-form">
    <form method="post" action="{{ route('update.password') }}">
        @csrf
        @method('put')
        <label for="current_password">Current password:</label>
        <input type="password" id="current_password" name="current_password" required><br><br>
        <label for="new_password">New password:</label>
        <input type="password" id="new_password" name="new_password" required><br><br>
        <button type="submit" class="signup-button">Change password</button>
        @if(session('password_success'))
            <div class="alert alert-success">{{ session('password_success') }}</div>
        @endif
        @error('current_password')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </form>
</div>
@endsection
