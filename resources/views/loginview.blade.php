<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>Login Form</title>
    <link rel="stylesheet" href="{{ asset('style.css') }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
    <script>
        $(".login_button").click(function(event){
            event.preventDefault();
        
            $('.form').fadeOut(500);
            $('.wrapper').addClass('form-success');
        });
    </script>
    <div class="wrapper">
        <div class="container">
            <h1>welcome</h1>
            <form method="POST" action="{{ route('login') }}" class="form">
                @csrf
                <div>
                    <input id="name" type="text" name="name" required autocomplete="name" placeholder="Name">
                    <input id="password" type="password" name="password" required autocomplete="current-password" placeholder="Password">
                </div>
                <div class="form-group">
                    <input type="checkbox" name="remember" id="remember" style="all: revert;" class="remember">
                    <label for="remember">ログイン状態を保持する</label>
                </div>
                <button type="submit" class="login_button">ログイン</button>
                <div>
                    <a href="/register">まだ登録してない方</a>
                </div>
            </form>
            <ul class="bg-bubbles">
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
            </ul>
        </div>
    </div>
</body>