@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
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
                            <span class="nickname">{{ ' - @' . $image->user->nick }}</span>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="image-container">
                            <img class="post-img" src="{{ route('image.file', ['filename' => $image->image_path]) }}"
                                alt="post-img">
                        </div>

                        <div class="description">
                            <p>{{ $image->description }}</p>
                        </div>
                        <div class="comment_likes">
                            <h3 class="btn-comments">Comentarios ({{ count($image->comments) }})</h3>
                            {{-- usando el count() se puede mostrar la cantidad de algo que halla en la DB vinculado a algo en este caso los coments --}}
                            <i class="heart fa fa-heart fa-2x"></i>
                        </div>

                        <div class="comment-container">

                            <div class="show-comments">
                                @foreach ($image->comments as $comment)
                                    <div class="detail_comments">
                                        <div class="detail_comment">
                                            {{ $comment->content }}
                                        </div>
                                        <span class="nickname">
                                            @if(Auth::check() && (($comment->user_id == Auth::user()->id || $comment->image->user_id == Auth::user()->id)))
                                            <a href="{{ route('comment.delete', ['id' => $comment->id]) }}"
                                                class="fa fa-trash"></a>
                                            @endif
                                            {{ ' - @' . $comment->user->nick }} {{ $comment->created_at->diffForHumans() }}
                                        </span>
                                    </div>
                                @endforeach
                            </div>

                            <form action="{{ route('comment.save') }}" method="POST">
                                @csrf
                                <input type="hidden" name="image_id" value="{{ $image->id }}" />
                                <p>
                                    <textarea class="form-control {{ $errors->has('content') ? 'is-invalid' : '' }}" name="content" cols="30"
                                        rows="10"></textarea>
                                </p>
                                @if ($errors->any())
                                    <div class="text-danger">
                                        <p>{{ $errors->first('content') }}</p>
                                    </div>
                                @endif
                                @if (session('status'))
                                    <div class="alert alert-success">
                                        {{ session('status') }}
                                    </div>
                                @endif
                                <button type="submit" class="btn btn-comments btn-success">Enviar</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
