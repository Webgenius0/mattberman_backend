<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body, html {
            height: 100%;
            font-family: Arial, sans-serif;
        }

        .fullscreen-bg {
            background-image: url('build/assets/logo/mockup mattberman.png');
            background-size: cover;
            /* background-position: cover; */
            background-repeat: no-repeat;
            width: auto;
            height: 100%;
            position: relative;
        }

        .login-button {
            position: absolute;
            top: 20px;
            right: 20px;
            background-color: rgba(0, 0, 0, 0.7);
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .login-button:hover {
            background-color: rgba(0, 0, 0, 0.9);
        }
    </style>
</head>
<body>
    <div class="fullscreen-bg">
        <a href="{{ route('login') }}" class="login-button">Login</a>
    </div>
</body>
</html>