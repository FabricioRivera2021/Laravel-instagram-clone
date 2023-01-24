@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @foreach ($images as $image)
                    <div class="card pub_image">
                        <div class="card-header">
                            
                            <div class="container-avatar">
                                @if ($image->user->image)
                                <img class="avatar" src="{{ route('user.avatar', ['filename' => $image->user->image]) }}"
                                alt="avatar">
                                @endif
                            </div>

                            <div class="data-user">
                                {{ $image->user->name . ' ' . $image->user->surname }}
                                <span class="nickname">{{ ' - @'.$image->user->nick }}</span>
                                <span class="date">
                                    {{ $image->created_at->diffForHumans() }}
                                </span>
                            </div>

                        </div>

                        <div class="card-body">
                            <a href="{{ route('image.detail', ['id' => $image->id]) }}">
                            <div class="image-container">
                                    <img class="post-img" src="{{ route('image.file', ['filename'=>$image->image_path]) }}" alt="post-img">
                                </div>
                            </a>
                            <div class="likes">
                            </div>
                            <div class="description">
                                <p>{{$image->description}}</p>
                            </div>
                            <div class="comment_likes">
                                <a href="#" class="btn btn-warning btn-sm btn-comments">Comentarios ({{count($image->comments)}}) </a>
                                {{-- usando el count() se puede mostrar la cantidad de algo que halla en la DB vinculado a algo en este caso los coments --}}
                                <i class="heart fa fa-heart fa-2x"></i>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="clearfix">
                {{$images->links()}}
            </div>
        </div>
    </div>
@endsection
