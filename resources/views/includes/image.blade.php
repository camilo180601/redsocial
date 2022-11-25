<div class="card pub_image">
    <div class="card-header">
        @if($image->user->image)
        <div class="container-avatar">
            <img src="{{ route('user.avatar', ['filename'=>$image->user->image]) }}" class="avatar" alt="">
        </div>
        @endif
        <div class="data-user">
            <a href="{{route('profile', ['id' => $image->user->id])}}">
                {{ $image->user->nick }}
            </a>
        </div>
    </div>

    <div class="card-body">
        <div class="image-container">
            <img src="{{ route('image.file', ['filename' => $image->image_path]) }}" alt="">
        </div>
        <div class="likes">
            <!--comprobar like del usuario -->
            <?php $user_like = false; ?>
            @foreach($image->likes as $like)
            @if($like->user->id == Auth::user()->id)
            <?php $user_like = true; ?>
            @endif
            @endforeach
            @if($user_like)
            <img src="{{asset('img/hearts-red.png')}}" data-id="{{$image->id}}" class="btn-dislike" alt="Like">
            @else
            <img src="{{asset('img/hearts-black.png')}}" data-id="{{$image->id}}" class="btn-like" alt="Like">
            @endif
        </div>
        @if(count($image->likes)!=0)
        <div class="likes">
            <b>{{count($image->likes)}} Me gusta</b>
        </div>
        @endif
        <div class="description">
            <b><a href="{{ route('profile', ['id'=>$image->user->id]) }}" class="description-user">{{ $image->user->nick }}</a></b> {{ $image->description }}
            <br>
            <span class="fecha">{{ $image->created_at->diffForHumans(null, false, false, 1) }}</span>

        </div>
        <a href="{{route('image.detail', ['id'=>$image->id])}}" class="btn btn-warning btn-comments">Comentarios ({{count($image->comments)}})</a>
    </div>
</div>