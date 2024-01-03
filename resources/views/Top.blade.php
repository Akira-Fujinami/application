@extends('bar')
@section('content')
<style>
.like-and-profile .like-icon,
.like-and-profile .profile-link {
    display: block;
    width: 100%;
    margin-bottom: 10px; /* 適切なスペースを設定 */
}

.like-and-profile .like-icon a,
.like-and-profile .profile-link a {
    display: block;
    text-align: center; /* 中央揃え */
}

.card-body {
    display: flex;
    flex-direction: column;
    align-items: center;
}

.like-and-profile {
    width: 100%;
    text-align: center;
    margin-top: 10px; /* 上部に適切なスペースを追加 */
}

.like-icon,
.profile-link {
    margin-bottom: 10px; /* 各要素の間にスペースを追加 */
}


</style>
    <div class="container mt-4">
        @foreach ($usersNew as $userNew)
            {{ $userNew->name }}
        @endforeach
        <div class="row">
            @foreach ($users as $user)
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $user->name }}</h5>
                            @if (!empty($user->firstPhoto))
                                <img src="{{ Storage::url($user->firstPhoto) }}" style="width: 150px; height: auto;">
                            @elseif ($user->gender == 'male')
                                <img src="/storage/20代の男性の顔.png" style="width: 190px; height: auto;">
                            @else
                                <img src="/storage/20代の女性の顔.png" style="width: 150px; height: auto;">
                            @endif
                            <div class="like-and-profile">
                                @if (!in_array($user->id, $likes))
                                    <a href="/like/{{ Auth::user()->id }}/{{ $user->id }}" class="like-icon">
                                        <i class="fa-regular fa-heart like-button"></i>
                                    </a>
                                @else
                                    <a href="/like/{{ Auth::user()->id }}/{{ $user->id }}" class="like-icon">
                                        <i class="fa-solid fa-heart"></i>
                                    </a>
                                @endif
                                <a href="/users/{{ $user->id }}" class="btn btn-primary">プロフィールを見る</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection