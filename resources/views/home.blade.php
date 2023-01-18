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
                            </div>

                        </div>

                        <div class="card-body">
                            <div class="image-container">
                                <img class="avatar" src="{{ route('image.file', ['filename'=>$image->image_path]) }}" alt="avatar">
                            </div>
                            <div class="likes">

                            </div>
                            <div class="description">
                                <p>{{$image->description}}</p>
                            </div>
                        </div>

                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
