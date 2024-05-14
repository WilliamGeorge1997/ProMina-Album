<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">

</head>
<body class="vh-80 d-flex justify-content-center align-items-center">
  <div>

    <h1>Welcome Back, Please Login</h1>
    <form action="{{ Route('login') }}" method="post">
        @csrf
        <div>
        <label for="email">Email</label>
        <input class="ms-2" type="email" id="email" name="email" value="{{ old('email') }}">
        @error('email')
        <div class="alert-danger">{{ $message }}</div>
    @enderror
        </div>
       <div>
        <label for="password">Password</label>
        <input type="password" id="password" name="password">
        @error('password')
        <div class="alert-danger">{{ $message }}</div>
    @enderror
       </div>
       <div class="text-center">
        <button class="mb-2" type="submit">Login</button>
      <div><span>You're not a member? </span> <a href="{{ Route('register') }}">Register now.</a></div>
       </div>
    </form>
    @if (session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif
  </div>

</body>
</html>
