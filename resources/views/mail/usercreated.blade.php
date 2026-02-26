<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>mail content</title>
</head>
<body>
    <h1>Hello world</h1>
    <h2>Welcome, {{ $user->name }}!</h2>
<p>You have been successfully registered with the <strong>ABC Residence Association</strong>.</p>
<p>Your registered email is: {{ $user->email }}</p>
<br>
<p>Regards,<br>Association Management Team</p>
</body>
</html>