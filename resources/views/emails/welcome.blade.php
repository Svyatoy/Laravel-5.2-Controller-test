<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta name="viewport" content="width=device-width" /><!-- IMPORTANT -->
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Password Reset</title>
</head>
<body bgcolor="#FFFFFF">
    <h4>Password Reset</h4>

    <h3>Dear {{ $user->name }},</h3>
    <p></p>
    <p>You have requested to have your password reset for your account at REST API</p>
    <p></p>
    <p>Please use this code "{{$token->token}}" to change your password. Regards, your Intersog team</p>
    <p></p>
    <p>If you received this email in error, you can safely ignore this email.</p>
</body>
</html>