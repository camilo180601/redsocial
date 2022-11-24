@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Subir nueva imagen
                </div>
                <div class="card-body">
                    <form action="{{ route('image.save') }}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="image_path"class="col-md-3 col-form-label">Imagen</label>
                            <div class="col-md-7">
                                <input type="file" id="image_path" name="image_path" class="form-control {{$errors->has('image_path') ? 'is-invalid' : ''}}" >
                                @error('image_path')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <br>

                        <div class="form-group row">
                            <label for="description"class="col-md-3 col-form-label">Descripción</label>
                            <div class="col-md-7">
                                <textarea class="form-control {{$errors->has('description') ? 'is-invalid' : ''}}" type="text-area" id="description" name="description" ></textarea>
                                @error('description')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <br>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-3">
                                <input type="submit" class="btn btn-primary" value="Subir Imagen">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
