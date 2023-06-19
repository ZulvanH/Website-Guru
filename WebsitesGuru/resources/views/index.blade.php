<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('style.css') }}">
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('/css/style.css') }}"> --}}
    {{-- <link rel="stylesheet" href="{{ URL::asset('css/style.css') }}" /> --}}
</head>
<body>
    <div class="container">
        {{-- method="POST" --}}
        <form class="login-email" method="POST" action="{{ route('login.submit') }}">
            @csrf
            <p style="font-size: 2rem; font: weight 850px;">LOGIN</p>
            <div class="input-group">
                <input type="email" placeholder="Email" name="username" required>
                @error('username')
                    <span>{{ $message }}</span>
                @enderror
            </div>
            <div class="input-group">
                <input type="password" placeholder="Password" name="password" required>
                @error('password')
                    <span>{{ $message }}</span>
                @enderror
            </div>
            <div class="input-group">
                <button type="submit" class="btn">Login</button>
            </div>
        </form>
        </form>
    {{-- <p class="login-register-text">Don't Have an Account?</p>
    <a href="Beranda"></a>
   <p><a href="register">Register</a></p> --}}
    </form>

    </div>
</body>
</html>
