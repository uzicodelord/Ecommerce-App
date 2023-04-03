<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>New Contact Form Submission</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 16px;
            color: #333;
        }

        h1 {
            color: #008080;
            font-size: 24px;
        }

        p {
            margin: 10px 0;
        }

        label {
            font-weight: bold;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>New Contact Form Submission</h1>
    <p><label>Name:</label> {{ $name }}</p>
    <p><label>Email:</label> {{ $email }}</p>
    <p><label>Message:</label> {{ $messages }}</p>
</div>
</body>
</html>
