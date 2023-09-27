<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="<?php echo asset('css/loginPageStyle.css')?>">
</head>
<body>
<form id="loginForm">
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" required><br><br>
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required><br><br>
    <input type="submit" value="Login">
</form>
<script src="{{ asset('js/loginJS.js') }}"></script>
</body>
</html>
