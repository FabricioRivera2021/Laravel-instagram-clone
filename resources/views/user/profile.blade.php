@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="data-user-profile">
                    <div class="user-info">
                        <h1>{{'@'.$user -> nick }}</h1>
                        <h2>{{ $user->name.' '.$user->surname }}</h2>
                    </div>
                    <div>
                        @if ($user->image)
                            <div class="profile-avatar">
                                <img class="avatar-profile" src="{{ route('user.avatar', ['filename' => $user->image]) }}"
                                    alt="avatar">
                            </div>
                        @endif
                    </div>
                </div>
                <div class="publications-profile">
                    <h4>Publicaciones</h4>
                </div>

                @foreach ($user->images as $image)
                    @include('includes.publication', ['image' => $image])
                @endforeach
            </div>
        </div>
    </div>
@endsection
