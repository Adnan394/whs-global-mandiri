<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
    <style>
        body { font-family: sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 20px auto; padding: 20px; border: 1px solid #ddd; border-radius: 8px; }
        .button { 
            display: inline-block; 
            padding: 10px 20px; 
            margin: 20px 0;
            background-color: #e4002b; 
            color: white !important; 
            text-decoration: none; 
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Hello, {{ $name }}!</h2>
        <p>You are receiving this email because we received a password reset request for your account.</p>
        
        <p style="text-align: center;">
            <a href="{{ $resetLink }}" class="button" target="_blank">Reset My Password</a>
        </p>

        <p>This password reset link will **expire in {{ $expiryHours }} hours**.</p>
        <p>If you did not request a password reset, you can safely ignore this email. No further action is required.</p>

        <hr>
        <p style="font-size: 0.9em; color: #777;">
            If you are having trouble clicking the "Reset My Password" button, copy and paste the URL below into your web browser:<br>
            <a href="{{ $resetLink }}">{{ $resetLink }}</a>
        </p>
        
        <p>Regards,</p>
        <p>{{ config('app.name') }} Team</p>
    </div>
</body>
</html>