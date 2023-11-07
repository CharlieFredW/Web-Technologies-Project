<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login</title>
    <link rel="stylesheet" href="{{asset('css/signupPageStyle.css')}}">
</head>
<body>
<div class="signup-header">
    <p class="signup-header-text">Are you a new creator signup here!</p>
</div>
<div class="signup-form">
<form id="signupForm" method="post" action="{{ route('signup') }}">
    @csrf
    <label for="name">Username:</label>
    <input type="text" id="name" name="name" required><br><br>
    <label for="email">Email:</label>
    <input type="text" id="email" name="email" required><br><br>
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required><br><br>
    <button type="submit" class="signup-button">Signup</button>
</form>
</div>
</body>
</html>
