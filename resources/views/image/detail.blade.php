@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            @include('includes.message')
            <div class="card pub_image pub_image_detail">
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

                    <a href="#" class="btn-menu" data-bs-toggle="modal" data-bs-target="#Modaldelete">
                        <img src="{{asset('img/button-menu.png')}}" alt="">
                    </a>

                </div>

                <div class="card-body">
                    <div class="image-container image-detail">
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
                    <br>
                    <div class="description">
                        <b><a href="{{route('profile', ['id' => $image->user->id])}}" class="description-user">{{ $image->user->nick }}</a></b> {{ $image->description }}
                        <br>
                        <span class="fecha">{{ $image->created_at->diffForHumans(null, false, false, 1) }}</span>

                    </div>
                    <div class="comments">
                        <h3>Comentarios ({{count($image->comments)}})</h3>
                        <hr>

                        <form action="{{route('comment.save')}}" method="post">
                            @csrf
                            <input type="hidden" name="image_id" value="{{$image->id}}">
                            <p>
                                <textarea name="content" class="form-control {{$errors->has('content') ? 'is-invalid' : ''}}"></textarea>
                                @error('content')
                                <span class="invalid-feedback d-block alert alert-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </p>
                            <button type="submit" class="btn btn-primary">
                                Enviar
                            </button>
                        </form>
                        <hr>
                        @foreach($image->comments as $comment)
                        <div class="comment">
                            <b><a href="{{ route('profile', ['id' => $comment->user->id]) }}" class="comment-user">{{ $comment->user->nick }}</a></b> {{ $comment->content }} <a href="#" class="btn-menu" data-bs-toggle="modal" data-bs-target="#Modaldelete2"><img src="{{asset('img/button-menu.png')}}" alt=""></a>
                            <br>
                            <span class="fecha">{{ $comment->created_at->diffForHumans(null, false, false, 1) }}</span>

                        </div>
                        <br>
                        @endforeach
                    </div>
                </div>
            </div>
            <br>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="Modaldelete" tabindex="-1" aria-labelledby="ModaldeleteLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-body">
                @if(Auth::user() && Auth::user()->id == $image->user->id)
                <button type="button" class="btn btn-eliminar" data-bs-toggle="modal" data-bs-target="#Modaldelete1">Eliminar</button>
                <hr>
                <a href="{{ route('image.edit', ['id'=>$image->id]) }}" class="btn btn-editar">Editar</a>
                <hr>
                @else
                <button type="button" class="btn-denunciar">Denunciar</button>
                <hr>
                @endif
                <button type="button" class="btn-cancelar" data-bs-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="Modaldelete1" tabindex="-1" aria-labelledby="Modaldelete1Label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <h4>¿Eliminar publicación?</h4>
                <h6>¿Seguro que quieres eliminar esta publicación?</h6>
                <hr>
                <a href="{{ route('image.delete', ['id'=>$image->id]) }}" class="btn btn-eliminar">Eliminar</a>
                <hr>
                <button type="button" class="btn-cancelar" data-bs-dismiss="modal">Cancelar</button>
            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="Modaldelete2" tabindex="-1" aria-labelledby="Modaldelete2Label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-body">
                @if(count($image->comments) >= 1)
                    @if(Auth::check() && ($comment->user_id == Auth::user()->id || $comment->image->user_id == Auth::user()->id ))
                    <a href="{{ route('comment.delete', ['id'=>$comment->id]) }}" class="btn btn-eliminar">Eliminar</a>
                    <hr>
                    @else
                    <button type="button" class="btn-denunciar" data-bs-toggle="modal" data-bs-target="#Modaldelete3">Denunciar</button>
                    <hr>
                    @endif
                    <button type="button" class="btn-cancelar" data-bs-dismiss="modal">Cancelar</button>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="Modaldelete3" tabindex="-1" aria-labelledby="Modaldelete3Label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <h4><b>Gracias por informarnos</b></h4>
                <div class="report">
                    Tus comentarios son importantes para ayudarnos a conseguir que la comunidad de LopeFoto siga siendo un lugar seguro.
                </div>
                <hr>
                <button type="button" class="btn-cancelar" data-bs-dismiss="modal">Cerrar</button>
            </div>

        </div>
    </div>
</div>
@endsection