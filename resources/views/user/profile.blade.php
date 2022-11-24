@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="profile-user">
                <div class="col-md-4">
                    @if($user->image)
                    <div class="container-avatar">
                        <img src="{{ route('user.avatar', ['filename'=>$user->image]) }}" class="avatar" alt="">
                    </div>
                    @endif
                </div>
                <div class="user-info">
                    <h1>{{$user->nick}}</h1>
                    <br>
                    <br>
                    <h5><b>{{$user->name.' '.$user->surname}}</b></h5>
                    <p>Se unió: {{ $user->created_at->diffForHumans(null, false, false, 1) }}</p>
                </div>
                
            </div>
            @foreach ($user->images as $image)
            @include('includes.image', ['image'=>$image])
            <br>
            @endforeach
        </div>
    </div>
</div>
@endsection