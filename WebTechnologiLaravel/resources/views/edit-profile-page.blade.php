@extends('layouts.main')
@section('content')
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="{{asset('css/editProfilePage.css')}}">
</head>
<div class="flex-column">
    <img class="avatar-picture" src="{{asset('images/avatar/PoyiRJw.png')}}" alt="yee">
    <h2>USERNAME</h2>
</div>
<div class="edit-profile-form">
    <form id="signupForm" method="post" action="{{ route('signup') }}">
        @csrf
        <label for="name">Username:</label>
        <input type="text" id="name" name="name" required><br><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>
        <button type="submit" class="signup-button">Signup</button>
    </form>
</div>
@endsection
