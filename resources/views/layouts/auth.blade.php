<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }} - Login</title>
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
</head>
<style>
    a {
        text-decoration: none;
    }
    .login-page {
        width: 100%;
        height: 100vh;
        display: inline-block;
        display: flex;
        align-items: center;
    }
    .form-right i {
        font-size: 100px;
    }
</style>
<body>
    <div class="">
        @yield('content')
    </div>
</body>
</html>
