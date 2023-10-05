<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="{{asset('css/signupPageStyle.css')}}">
</head>
<body>
<div class="signup-header">
    <p class="signup-header-text">Are you a new creator signup here!</p>
</div>
<div class="signup-form">
<form id="signupForm">
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" required><br><br>
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required><br><br>
    <input type="submit" value="Signup">
</form>
</div>
<script src="{{ asset('js/loginJS.js') }}"></script>
</body>
</html>
