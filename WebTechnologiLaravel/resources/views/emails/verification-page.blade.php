<!DOCTYPE html>
<html lang="en">
<head>
    <title>Verification</title>
    <link rel="stylesheet" href="{{asset('css/loginPageStyle.css')}}">
</head>
<body>
<form id="verificationForm" method="post" action="{{ route('verify.verify') }}">
    <label>We have send a verification code to your email.</label>
    @csrf
    <label for="verification_code">Enter the verification code to login:</label>
    <input type="text" id="verification_code" name="verification_code" required><br><br>
    <button type="submit" class="login-button">Verify</button>
</form>
</body>
</html>
