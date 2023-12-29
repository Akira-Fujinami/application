<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>Login Form</title>
    <link rel="stylesheet" href="{{ asset('style.css') }}">
    <style>
        .form-section {
            display: none;
        }
        .form-section.active {
            display: block;
        }
        .form-navigation {
            cursor: pointer;
            display: block;
            margin-top: 10px;
        }
        input[type=checkbox] {
            display: none; /* ラジオボタンを非表示にする */
        }
        input[type="checkbox"]:checked + label {
            background: #31A9EE;/* マウス選択時の背景色を指定する */
            color: #ffffff; /* マウス選択時のフォント色を指定する */
        }
        .label:hover {
            background-color: #E2EDF9; /* マウスオーバー時の背景色を指定する */
        }
        .label {
            display: block; /* ブロックレベル要素化する */
            float: left; /* 要素の左寄せ・回り込を指定する */
            margin: 5px; /* ボックス外側の余白を指定する */
            width: 100px; /* ボックスの横幅を指定する */
            height: 45px; /* ボックスの高さを指定する */
            padding-left: 5px; /* ボックス内左側の余白を指定する */
            padding-right: 5px; /* ボックス内御右側の余白を指定する */
            color: #b20000; /* フォントの色を指定 */
            text-align: center; /* テキストのセンタリングを指定する */
            line-height: 45px; /* 行の高さを指定する */
            cursor: pointer; /* マウスカーソルの形（リンクカーソル）を指定する */
            border: 2px solid #006DD9;/* ボックスの境界線を実線で指定する */
            border-radius: 5px; /* 角丸を指定する */
        }
        input[type="radio"]:checked + label {
            background: #31A9EE;/* マウス選択時の背景色を指定する */
            color: #ffffff; /* マウス選択時のフォント色を指定する */
        }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
    <div class="wrapper">
        <div class="container">
            <form method="POST" action="{{ route('newRegister') }}">
                @csrf
                <div class="form-section active">
                    <div>
                        <input id="name" type="text" name="name" autocomplete="family-name" placeholder="名前">
                        @error('name')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <input id="age" type="text" name="age" placeholder="年齢">
                        @error('name')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label for="sex">性別を選んでください：</label>
                        <select id="sex" name="sex">
                            <option value="male">男性</option>
                            <option value="female">女性</option>
                        </select>
                    </div>
                    <div>
                        <label for="live">お住まいの地域：</label>
                        <select id="live" name="live">
                            <option value="北海道">北海道</option>
                            <option value="青森県">青森県</option>
                            <option value="岩手県">岩手県</option>
                            <option value="宮城県">宮城県</option>
                            <option value="秋田県">秋田県</option>
                            <option value="山形県">山形県</option>
                            <option value="福島県">福島県</option>
                            <option value="茨城県">茨城県</option>
                            <option value="栃木県">栃木県</option>
                            <option value="群馬県">群馬県</option>
                            <option value="埼玉県">埼玉県</option>
                            <option value="千葉県">千葉県</option>
                            <option value="東京都">東京都</option>
                            <option value="神奈川県">神奈川県</option>
                            <option value="新潟県">新潟県</option>
                            <option value="富山県">富山県</option>
                            <option value="石川県">石川県</option>
                            <option value="福井県">福井県</option>
                            <option value="山梨県">山梨県</option>
                            <option value="長野県">長野県</option>
                            <option value="岐阜県">岐阜県</option>
                            <option value="静岡県">静岡県</option>
                            <option value="愛知県">愛知県</option>
                            <option value="三重県">三重県</option>
                            <option value="滋賀県">滋賀県</option>
                            <option value="京都府">京都府</option>
                            <option value="大阪府">大阪府</option>
                            <option value="兵庫県">兵庫県</option>
                            <option value="奈良県">奈良県</option>
                            <option value="和歌山県">和歌山県</option>
                            <option value="鳥取県">鳥取県</option>
                            <option value="島根県">島根県</option>
                            <option value="岡山県">岡山県</option>
                            <option value="広島県">広島県</option>
                            <option value="山口県">山口県</option>
                            <option value="徳島県">徳島県</option>
                            <option value="香川県">香川県</option>
                            <option value="愛媛県">愛媛県</option>
                            <option value="高知県">高知県</option>
                            <option value="福岡県">福岡県</option>
                            <option value="佐賀県">佐賀県</option>
                            <option value="長崎県">長崎県</option>
                            <option value="熊本県">熊本県</option>
                            <option value="大分県">大分県</option>
                            <option value="宮崎県">宮崎県</option>
                            <option value="鹿児島県">鹿児島県</option>
                            <option value="沖縄県">沖縄県</option>
                        </select>
                    </div>
                    <span class="form-navigation next-step">次へ &raquo;</span>
                </div>
                <div class="form-section">
                    <div>
                        <p>趣味を選んでください：</p>
                        <input type="checkbox" id="スポーツ" name="hobby[]" value="スポーツ">
                        <label for="スポーツ" class="label">スポーツ</label>
                        <input type="checkbox" id="読書" name="hobby[]" value="読書">
                        <label for="読書" class="label">読書</label>
                        <input type="checkbox" id="旅行" name="hobby[]" value="旅行">
                        <label for="旅行" class="label">旅行</label>
                        <input type="checkbox" id="音楽" name="hobby[]" value="音楽">
                        <label for="音楽" class="label">音楽</label>
                        <input type="checkbox" id="絵画" name="hobby[]" value="絵画">
                        <label for="絵画" class="label">絵画</label>
                        <input type="checkbox" id="映画" name="hobby[]" value="映画">
                        <label for="映画" class="label">映画</label>
                    </div>
                    <div>
                        <input id="password" type="password" name="password" placeholder="パスワード">
                        @error('password')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <input id="password_confirmation" type="password" name="password_confirmation" placeholder="パスワード確認">
                    </div>
                    <button type="submit">新規登録</button>
                    <span class="form-navigation previous-step">&laquo; 前へ</span>
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
      
    <script>
        $(document).ready(function() {
            // Move to next form section
            $('.next-step').click(function() {
                var $currentSection = $(this).closest('.form-section');
                $currentSection.removeClass('active');
                $currentSection.next('.form-section').addClass('active');
            });
            
            // Move to previous form section
            $('.previous-step').click(function() {
                var $currentSection = $(this).closest('.form-section');
                $currentSection.removeClass('active');
                $currentSection.prev('.form-section').addClass('active');
            });
        });
    </script>
</body>