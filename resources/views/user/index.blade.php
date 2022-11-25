@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form action="{{ route('user.index') }}" method="get" id="buscador">
                <div class="row">
                    <div class="form-group col">
                        <input type="text" id="search" class="form-control">
                    </div>
                    <div class="form-group col btn-search">
                        <input type="submit" value="Buscar" class="btn btn-primary">
                    </div>
                </div>
            </form>
            <hr>
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