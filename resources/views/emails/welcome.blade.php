<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome to Uzi-Shop</title>
    <style>
        /* Email styles */
        body {
            background-color: #f5f5f5;
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            font-size: 16px;
            line-height: 1.4;
            color: #444;
            padding: 0;
            margin: 0;
        }
        table {
            border-collapse: separate;
            mso-table-lspace: 0;
            mso-table-rspace: 0;
            width: 100%;
        }
        td {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            font-size: 16px;
            vertical-align: top;
            padding-bottom: 20px;
        }
        .wrapper {
            background-color: #ffffff;
            margin: 0;
            padding: 20px;
        }
        /* Header */
        .header {
            background-color: #000000;
            color: #ffffff;
            margin-bottom: 20px;
            padding: 20px;
            text-align: center;
        }
        /* Logo */
        .logo {
            display: block;
            margin: 0 auto;
            max-width: 200px;
        }
        /* Button */
        .button {
            background-color: #cc0000;
            border-radius: 4px;
            color: #ffffff;
            display: inline-block;
            font-size: 16px;
            line-height: 1.4;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
        }
        .button:hover {
            background-color: #990000;
        }
    </style>
</head>
<body>
<table>
    <tr>
        <td>
            <div class="wrapper">
                <!-- Header -->
                <div class="header">
                    <img src="{{ $message->embed(public_path().'/home/images/logo2.png') }}" alt="Uzi-Shop Logo" class="logo">
                </div>
                <!-- Content -->
                <h1>Welcome to Uzi-Shop, {{ $user->name }}!</h1>
                <p>Thank you for registering with us. We're excited to have you on board!</p>
            </div>
        </td>
    </tr>
</table>
</body>
</html>
