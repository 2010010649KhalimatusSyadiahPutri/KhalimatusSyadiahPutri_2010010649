<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - KORAMIL KAPUAS HULU</title>
    <style>
        body {
            font-family: sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .container {
            width: 100%;
            padding: 20px;
            display: flex;
            flex-direction: column;
            flex: 1;
            justify-content: center;
            align-items: center;
        }

        .header {
            background-color: #364afc;
            color: white;
            padding: 15px;
            text-align: center;
            width: 100%;
        }

        .content {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
        }

        .login {
            background-color: white;
            padding: 30px;
            border: 1px solid #ddd;
            border-radius: 10px;
            width: 400px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .login img {
            display: block;
            max-width: 100%;
            max-height: 150px;
            width: auto;
            height: auto;
            margin: 0 auto 20px auto;
        }

        .login h1 {
            font-size: 24px;
            margin-bottom: 10px;
            color: #333;
        }

        .login h2 {
            margin-top: 0;
            font-size: 22px;
            color: #333;
        }

        .login form {
            margin-top: 20px;
            text-align: left;
        }

        .login input[type="email"],
        .login input[type="password"] {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
        }

        .login button {
            background-color: #0018f3;
            padding: 12px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            margin-top: 10px;
            color: white;
        }

        .login button:hover {
            background-color: #45a049;
        }

        .login .remember {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin: 10px 0;
        }

        .login .forgot-password {
            font-size: 0.9em;
            color: #333;
        }

        .footer {
            background-color: #333;
            color: white;
            padding: 5px 0;
            text-align: center;
            width: 100%;
        }
    </style>
</head>

<body>

    <div class="header">
        {{-- <h1>KORAMIL KAPUAS HULU</h1> --}}
    </div>

    <div class="container">
        <div class="content">
            <div class="login">
                <img src="img/Lambang_Kodam_Tanjungpura.png" alt="Lambang Kodam Tanjungpura">
                <h1>KORAMIL KAPUAS HULU</h1>
                <h2>Login</h2>

                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email Address -->
                    <div>
                        <input type="email" name="email" placeholder="Email" :value="old('email')" required
                            autofocus autocomplete="username">
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div>
                        <input type="password" name="password" placeholder="Password" required
                            autocomplete="current-password">
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Remember Me & Forgot Password -->
                    <div class="remember">
                        <label>
                            <input type="checkbox" name="remember"> Remember Me
                        </label>

                        @if (Route::has('password.request'))
                            <a class="forgot-password" href="{{ route('password.request') }}">
                                Forgot your password?
                            </a>
                        @endif
                    </div>

                    <!-- Login Button -->
                    <button type="submit">Login</button>
                </form>
            </div>
        </div>
    </div>

    <div class="footer">
        <p>&copy; 2024 KORAMIL KAPUAS HULU</p>
    </div>
</body>

</html>
