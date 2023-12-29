<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Top Page</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/3384d5aaf5.js" crossorigin="anonymous"></script>
    <style>
        .navbar-custom {
            background-color: #007bff; /* 青色の背景 */
            color: #fff; /* テキスト色を白に設定 */
        }

        .navbar-custom .navbar-nav .nav-link {
            color: #fff; /* ナビゲーションリンクの色を白に設定 */
        }

        .navbar-custom .navbar-brand {
            color: #fff; /* ナビゲーションブランドの色を白に設定 */
        }
    </style>
</head>
<body>
    <!-- resources/views/layouts/app.blade.php の <body> 内 -->
    <nav class="navbar navbar-expand-lg navbar-custom navbar-light">
        <!-- 他のナビゲーションバーの内容 -->
        <a class="navbar-brand" href="/top">Match</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
        <!-- ドロップダウンメニューの追加 -->
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Menu
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="/planning">有料プラン</a>
                        <a class="dropdown-item" href="/profile">プロフィール</a>
                        <a class="dropdown-item" href="/search">検索</a>
                        <a class="dropdown-item" href="/chat">チャット</a>
                        <!-- 他のドロップダウン項目 -->
                    </div>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <a class="nav-link" href="/profile/{{ Auth::user()->id }}">{{ Auth::user()->name }}さん</a>
                <a class="nav-link" href="/search">無料期間中(残り1日)</a>
                <li class="nav-item">
                    <a class="nav-link" href="/logout">ログアウト</a>
                </li>
            </ul>
        </div>
    </nav>
    @yield('content')
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
