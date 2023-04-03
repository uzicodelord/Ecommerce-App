<!DOCTYPE html>
<html>
<head>
    <title>Thank you for your order</title>
    <style type="text/css">
        body {
            font-family: Arial, sans-serif;
            font-size: 16px;
            line-height: 1.4;
            color: #333;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
            text-align: center;
        }
        .logo {
            margin-bottom: 20px;
        }
        .logo img {
            max-width: 100px;
            height: auto;
        }
        .title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
        }
        .text {
            margin-bottom: 20px;
        }
        .order-number {
            font-weight: bold;
        }
        .footer {
            font-size: 12px;
            color: #999;
            margin-top: 20px;
        }
    </style>
</head>
<body>
<div class="container">

    <div class="title">
        Thank you for your order
    </div>
    <div class="text">
        Dear {{ $name }},<br>
        Thank you for your order. Your order number is <span class="order-number">{{ $order->id }}</span>.<br>
        We will process your order and keep you updated with the status.
    </div>
    <div class="footer">
        Best regards,<br>
        Uzi-Shop<br>
    </div>
</div>
</body>
</html>
