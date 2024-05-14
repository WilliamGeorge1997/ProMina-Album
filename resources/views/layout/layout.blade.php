<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    <title>@yield('title')</title>
</head>
<body class="vh-80">
@include('navbar.navbar')
<div class="ms-4">
    @yield('content')
</div>
</body>
</html>
