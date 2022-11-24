@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @foreach ($users as $user)
                <div class="profile-user">
                    <div class="col-md-4">
                        @if($user->image)
                        <div class="container-avatar">
                            <img src="{{ route('user.avatar', ['filename'=>$user->image]) }}" class="avatar" alt="">
                        </div>
                        @endif
                    </div>
                    <div class="user-info">
                        <h2>{{$user->nick}}</h2>
                        <br>
                        <h5><b>{{$user->name.' '.$user->surname}}</b></h5>
                        <p>Se unió: {{ $user->created_at->diffForHumans(null, false, false, 1) }}</p>
                        <a href="{{ route('profile', ['id'=>$user->id]) }}" class="btn btn-success">Ver Perfil</a>
                    </div>
                </div>
            <br>
            @endforeach
        </div>
    </div>
</div>
@endsection