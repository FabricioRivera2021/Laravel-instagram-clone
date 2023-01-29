@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @foreach ($images as $image)
                    @include('includes.publication', ['image' => $image])
                @endforeach
            </div>
            <div class="clearfix">
                {{$images->links()}}
            </div>
        </div>
    </div>
@endsection
