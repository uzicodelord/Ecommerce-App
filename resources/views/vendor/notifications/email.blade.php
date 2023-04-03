<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hello from Uzi-Shop!</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
            line-height: 1.5;
            color: #555555;
            background-color: #f6f6f6;
            padding: 0;
            margin: 0;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 6px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            font-size: 28px;
            margin: 0 0 20px;
            color: #333333;
            text-align: center;
        }
        p {
            margin: 0 0 10px;
        }
        a {
            color: #ffffff;
            text-decoration: none;
        }
        .button {
            display: inline-block;
            background-color: #3490dc;
            border-radius: 4px;
            padding: 10px 20px;
            color: #ffffff;
            font-size: 16px;
            line-height: 1;
            text-align: center;
            text-decoration: none;
            margin: 0;
        }
        .button:hover {
            background-color: #2779bd;
        }
        .footer {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #cccccc;
            font-size: 12px;
            color: #999999;
            text-align: center;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Hello from Uzi-Shop!</h1>

    <p>Thank you for registering with us. Please click the button below to verify your email address.</p>

    <table class="action" align="center" width="100%" cellpadding="0" cellspacing="0" role="presentation">
        <tr>
            <td>
                <table width="100%" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                        <td align="center">
                            <a href="{{ $actionUrl }}" class="button" target="_blank" rel="noopener noreferrer">Verify Email Address</a>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <p>If you did not create an account, no further action is required.</p>
            </td>
        </tr>
    </table>

    <p>Regards,</p>
    <p>Uzi-Shop Team</p>
    @if (isset($displayableActionUrl))
        @component('mail::subcopy')
            @lang(
                "If you're having trouble clicking the \":actionText\" button, copy and paste the URL below\n".
                'into your web browser:',
                [
                    'actionText' => $actionText,
                ]
            )
            <br>
            <a style="color: #333;" href="{{ $displayableActionUrl }}">{{ $displayableActionUrl }}</a>
        @endcomponent
    @endif
</div>

