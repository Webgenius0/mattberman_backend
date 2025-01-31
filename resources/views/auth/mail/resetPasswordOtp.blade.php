<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Varification</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            line-height: 1.6;
        }
        .email-container {
            max-width: 600px;
            margin: 20px auto;
            background: #ffffff;
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .email-header {
            background-color: #4CAF50;
            color: white;
            text-align: center;
            padding: 20px;
        }
        .email-body {
            padding: 20px;
            color: #333333;
        }
        .email-footer {
            background-color: #f4f4f4;
            text-align: center;
            padding: 10px;
            font-size: 0.9em;
            color: #666666;
        }
        a.button {
            display: inline-block;
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            font-size: 1em;
            margin: 10px 0;
        }
        a.button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="email-header">
            <h1>Your Varifiction Code</h1>
        </div>
        <div class="email-body">
            <p>Your OTP code is: <strong>{{ $otp }}</strong></p>
            <p>This code is valid for a limited time only. Please use it to complete your registration.</p>
            <p>Thank you!</p>
        </div>
        <div class="email-footer">
            <p>&copy; {{ date('Y') }} . All rights reserved.</p>
        </div>
    </div>
</body>
</html>
