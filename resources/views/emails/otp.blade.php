<!-- resources/views/emails/otp.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>OTP Verification</title>
</head>
<body>
    <h1>Your OTP Code</h1>
    <p>Your OTP code is: <strong>{{ $otp }}</strong></p>
    <p>This code will expire in 10 minutes.</p>
</body>
</html>
