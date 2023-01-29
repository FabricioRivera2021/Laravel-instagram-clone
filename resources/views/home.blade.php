@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                @foreach ($images as $image)
                    @include('includes.publication', ['image' => $image])
                @endforeach
            </div>
            <div class="clearfix">
                {{ $images->links() }}
            </div>
        </div>
    </div>
@endsection
