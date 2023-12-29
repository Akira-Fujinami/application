@extends('bar')

@section('content')
<div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form action="{{ route('user.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- 写真アップロード -->
                    <div style="display: flex; align-items: center; margin-bottom: 20px;">
                        <div style="margin-right: 20px; margin-top: -60px">
                            @if (!empty($firstPhoto))
                                <img src="{{ Storage::url($firstPhoto) }}" style="width: 100px; height: auto;">
                            @elseif ($user->gender == 'male')
                                <img src="/storage/20代の男性の顔.png" style="width: 150px; height: auto;">
                            @else
                                <img src="/storage/20代の女性の顔.png" style="width: 150px; height: auto;">
                            @endif
                        </div>
                    
                        <div style="flex-grow: 1;">
                            <div class="form-group" style="display: flex; align-items: center;">
                                <label for="name" style="margin-right: 10px;"><strong>名前:</strong>{{$user->name}}</label>
                            </div>
                            <div class="form-group" style="display: flex; align-items: center;">
                                <label for="name" style="margin-right: 10px;"><strong>住んでいる場所:</strong>{{$user->live}}</label>
                            </div>
                            <div class="form-group" style="display: flex; align-items: center;">
                                <label for="name" style="margin-right: 10px;"><strong>年齢:</strong>{{$user->age}}</label>
                            </div>
                            <div style="margin-bottom: 10px;"><strong>趣味:</strong>
                                @foreach($user->hobbies as $hobby)
                                    {{ $hobby }}@if(!$loop->last), @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="container mt-4">
                        <div class="row"> 
                        @for ($i = 1; $i < 5; $i++)
                            <div class="col-2">
                                <div>
                                    <img class="img-fluid" 
                                        src="{{ isset($photos[$i]) ? Storage::url($photos[$i]) : '' }}">
                                </div>
                            </div>
                        @endfor

                        </div>
                    </div>

                    <!-- 一言コメント -->             
                    <div class="form-group">
                        <label for="tagline"><strong>一言コメント</strong></label>
                        <div>{{ isset($userDetail) ? $userDetail->oneWord : '' }}</div>
                    </div>
                    <!-- 自己紹介文 -->
                    <div class="form-group">
                        <label for="bio"><strong>自己紹介文</strong></label>
                        <div>{{ isset($userDetail) ? $userDetail->introduction : '' }}</div>
                    </div>


                    <button type="submit" class="btn btn-primary">更新</button>
                </form>
            </div>
        </div>
    </div>
@endsection
