<!DOCTYPE html>
<html>

<head>
    <title>Medical Prescriptio Pro. Password Reset Link</title>
</head>

<body>
    Dear {{ $user->name }},
    <p>Your password reset link is below.</p>
    <a href="{{ route('reset.password', $user->password_reset_token) }}" target="_blank">Reset Password</a>
    <br />
    <br />
    Regards,<br />
    Team Medical Prescription Pro.
</body>

</html>