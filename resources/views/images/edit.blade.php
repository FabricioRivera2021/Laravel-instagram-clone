@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Editar información
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('image.update') }}" enctype="multipart/form-data">
                            @csrf

                            <input type="hidden" name="image_id" value="{{$image->id}}">
                            <input type="hidden" name='image_old_path' value="{{$image_path}}">

                            <div class="form-group row">
                                <label for="image_path" class="col-md-4 col-form-label text-md-right">Imagen</label>
                                <div class="com-md-7">
                                    <div class="image-container">
                                        <img class="avatar" src="{{ route('image.file', ['filename' => $image->image_path]) }}"
                                            alt="post-img">
                                    </div>
                                    <input id="image_path" type="file" name="image_path" class="form-control{{ $errors->has('image_path') ? ' is-invalid' : '' }}">
                                    @if ($errors->any())
                                        <div class="text-danger">
                                            <p>{{ $errors->first('image_path') }}</p>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="description" class="col-md-4 col-form-label text-md-right">Descripcion</label>
                                <div class="com-md-7">
                                    <textarea id="description" name="description" class="form-control" required>{{ $image->description }}</textarea>
                                    @if ($errors->has('description'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('description') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="com-md-6 offset-md-0 mt-4">
                                    <input class="btn btn-primary" type="submit" value="Aceptar">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection