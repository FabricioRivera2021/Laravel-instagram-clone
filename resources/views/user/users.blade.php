@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h2>Usuarios</h2>
                @foreach ($users as $user)
                <div class="data-users">
                    <div class="users-info">
                        @if ($user->image)
                            <div class="profile-avatar">
                                <img class="avatar-profile" src="{{ route('user.avatar', ['filename' => $user->image]) }}"
                                    alt="avatar">
                            </div>
                        @endif
                        <div>
                            <h3>{{'@'.$user -> nick }}</h3>
                            <h4>{{ $user->name.' '.$user->surname }}</h4>
                            <a href="{{ route('profile', ['id' => $user->id]) }}" class="btn btn-sm btn-success" >Ver perfil</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="clearfix">
                {{ $users->links() }}
            </div>
        </div>
    </div>
@endsection
