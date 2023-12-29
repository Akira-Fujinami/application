@extends('bar')
@section('content')
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
                            <a href="/users/{{ $user->id }}" class="btn btn-primary">プロフィールを見る</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection