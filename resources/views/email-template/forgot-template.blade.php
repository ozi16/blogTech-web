<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        table {
            border-spacing: 0;
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
        }

        img {
            display: block;
            max-width: 100%;
            height: auto;
        }

        td {
            padding: 20px;
            text-align: center;
        }

        h1 {
            font-size: 24px;
            color: #333333;
            margin: 0;
        }

        p {
            font-size: 16px;
            color: #666666;
            line-height: 1.5;
            margin: 20px 0;
        }

        a {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            font-size: 16px;
            color: #ffffff;
            background-color: #007bff;
            text-decoration: none;
            border-radius: 5px;
        }

        a:hover {
            background-color: #0056b3;
        }

        @media (max-width: 600px) {
            h1 {
                font-size: 20px;
            }

            p {
                font-size: 14px;
            }

            a {
                font-size: 14px;
                padding: 8px 16px;
            }
        }
    </style>
</head>

<body>
    <table>
        <tr>
            <td>
                <h1>Reset Your Password</h1>
                <p>
                    Hello, {{ $user->name }} <br>
                    We received a request to reset your password. Click the button below to set a new password:
                </p>
                <a href="{{ $actionLink }}" target="_blank">
                    Reset Password
                </a>
                <p>
                    If you didn't request a password reset, you can safely ignore this email. <br>
                    This link will expire in 24 hours.
                </p>
                <p style="font-size: 12px; color: #999;">
                    &copy; {{ date('Y') }} Your Company. All rights reserved.
                </p>
            </td>
        </tr>
    </table>
</body>

</html>
