@extends('bar')

@section('content')
<style>
.custom-file-upload {
    display: block;
    padding: 6px 12px;
    cursor: pointer;
    text-align: center;
    margin-bottom: 10px;
}

.img-wrap {
    padding: 5px;
    display: flex;
    justify-content: center;
    align-items: center;
    border: 1px solid #ddd; /* ボーダーラインを追加 */
    border-radius: 10px; /* 角丸のボーダーにする */
    margin-bottom: 10px; /* 下部の余白を追加 */
    background-color: #fff; /* 背景色を白に設定 */
    height: 100px; /* 高さを設定 */
    width: 100%; /* 幅を100%に設定 */
}


/* 未設定文言のスタイル */
.no-file-text {
    text-align: center;
    color: #666; /* 文言の色を暗めの色に設定 */
    font-size: 0.8em; /* 文言のサイズを小さめに設定 */
    margin-top: 10px; /* 上の余白を設定 */
}

.form-group {
    margin-bottom: 15px;
}

.form-group label {
    display: block;
    margin-bottom: 5px;
    color: #333;
    font-size: 1.1em;
    font-weight: bold;
}

.form-control {
    display: block;
    width: 100%;
    padding: 8px 10px;
    font-size: 1em;
    font-family: Arial, sans-serif;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-shadow: inset 0 1px 3px #ddd;
    transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
}

.form-control:focus {
    border-color: #66afe9;
    outline: 0;
    box-shadow: inset 0 1px 3px #ddd, 0 0 8px rgba(102, 175, 233, .6);
}

.form-control.textarea {
    height: auto;
    min-height: 100px;
    resize: vertical;
}

/* Styling for the button, if you have one */
.btn-primary {
    background-color: #007bff;
    border-color: #007bff;
    color: white;
    padding: 10px 20px;
    font-size: 1em;
    line-height: 1.5;
    border-radius: 5px;
    transition: background-color .15s ease-in-out, border-color .15s ease-in-out;
}

.btn-primary:hover {
    background-color: #0056b3;
    border-color: #004085;
}

</style>
<script>
    function previewImage(index) {
    var input = document.getElementById('photo-upload-' + index);
    var preview = document.getElementById('photo-preview-' + index);
    var noFileText = document.getElementById('no-file-selected-' + index);
    var imgWrap = preview.closest('.img-wrap');

        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
                noFileText.style.display = 'none';
                imgWrap.style.border = 'none'; // 写真が表示されるときにボーダーを削除
            };

            reader.readAsDataURL(input.files[0]);
        } else {
            preview.style.display = 'none';
            noFileText.style.display = 'block';
            imgWrap.style.border = ''; // 写真がないときにデフォルトのスタイルを維持または追加
        }
    }

</script>   
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form action="{{ route('user.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- 写真アップロード -->
                    <div style="display: flex; align-items: center; margin-bottom: 20px;">
                        <div style="margin-right: 20px; margin-top: -60px">
                            @if (Auth::user()->gender == 'male')
                                <img src="/storage/20代の男性の顔.png" style="width: 150px; height: auto;">
                            @else
                                <img src="/storage/20代の女性の顔.png" style="width: 150px; height: auto;">
                            @endif
                            
                        </div>

                        
                        <div style="flex-grow: 1;">
                            <div class="form-group" style="display: flex; align-items: center;">
                                <label for="name" style="margin-right: 10px;"><strong>名前:</strong></label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" style="width: 200px;">
                            </div>
                            <div class="form-group" style="display: flex; align-items: center;">
                                <label for="name" style="margin-right: 10px;"><strong>住んでいる場所:</strong></label>
                                <input type="text" class="form-control" id="live" name="live" value="{{ $user->live }}" style="width: 200px;">
                            </div>
                            <div class="form-group" style="display: flex; align-items: center;">
                                <label for="name" style="margin-right: 10px;"><strong>年齢:</strong></label>
                                <input type="text" class="form-control" id="age" name="age" value="{{ $user->age }}" style="width: 50px;">
                            </div>
                            <div style="margin-bottom: 10px;"><strong>趣味:</strong>
                                @foreach(Auth::user()->hobbies as $hobby)
                                    {{ $hobby }}@if(!$loop->last), @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="container mt-4">
                        <div class="row"> 

                        @for ($i = 0; $i < 5; $i++)
                            <div class="col-2">
                                <div class="img-wrap" style="{{ isset($photos[$i]) ? 'border: none;' : '' }}">
                                    <img id="photo-preview-{{ $i }}" class="img-fluid" 
                                        src="{{ isset($photos[$i]) ? Storage::url($photos[$i]) : '' }}" 
                                        style="{{ isset($photos[$i]) ? 'display:block;' : 'display:none;' }}">
                                    <div id="no-file-selected-{{ $i }}" class="no-file-text" 
                                        style="{{ isset($photos[$i]) ? 'display:none;' : 'display:block;' }}">未設定</div>
                                </div>
                                <input id="photo-upload-{{ $i }}" type="file" name="photos{{ $i }}" 
                                    style="display:block; opacity:0; width:100%; height:100%; position:absolute; left:0; top:0;"
                                    onchange="previewImage({{ $i }});" accept="image/*">
                            </div>
                        @endfor

                        </div>
                    </div>

                    <!-- 一言コメント -->             
                    <div class="form-group">
                        <label for="tagline">一言コメント</label>
                        <input type="text" class="form-control" id="tagline" name="tagline" value="{{ isset($userDetail) ? $userDetail->oneWord : '' }}">
                    </div>
                    <!-- 自己紹介文 -->
                    <div class="form-group">
                        <label for="bio">自己紹介文</label>
                        <textarea class="form-control textarea" id="bio" name="bio" rows="6">{{ isset($userDetail) ? $userDetail->introduction : '' }}</textarea>
                    </div>


                    <button type="submit" class="btn btn-primary">更新</button>
                </form>
            </div>
        </div>
    </div>
@endsection
