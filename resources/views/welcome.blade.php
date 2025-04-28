<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #FDFDFC;
            color: #1b1b18;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            text-align: center;
        }

        .auth-buttons {
            background: #fff;
            border-radius: 8px;
            padding: 40px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .auth-buttons a {
            display: inline-block;
            padding: 12px 32px;
            margin: 10px;
            border-radius: 6px;
            font-size: 16px;
            font-weight: 500;
            transition: 0.3s;
        }

        .auth-buttons a.login {
            background-color: #1D4ED8;
            color: #fff;
            border: 1px solid #1D4ED8;
        }

        .auth-buttons a.register {
            background-color: #10B981;
            color: #fff;
            border: 1px solid #10B981;
        }

        .auth-buttons a:hover {
            opacity: 0.8;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="auth-buttons">
        <a href="{{ route('login') }}" class="login">Login</a>
        <a href="{{ route('register') }}" class="register">Register</a>
    </div>
</div>
</body>
</html>

