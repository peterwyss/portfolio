@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create Photo</div>
               
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                            
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                            </ul>
                        </div>
                    @endif



                    <form  method="POST" action="/admin/photo/store" enctype="multipart/form-data">
                    @csrf
                        <div class="form-group">
                            <label for="photo-title">Titel:</label>
                            <input name='title' type='text' class='form-control' id='photo-title' aria-describedby="descriptionTitel" value="{{old('title')}}">
                            <small id='descriptionTitel' class='form-text text-muted'>Titel des Fotos</small>
                        </div>
                        <div class="form-group">
                            <label for="photo-description">Beschreibung</label>
                            <textarea name='description' class='form-control   ' id='photo-description' aria-describedby="descriptionDescription" >{{old('description')}}</textarea>
                            <small id='descriptionDescription' class='form-text text-muted'>Beschreibung des Fotos</small>
                        </div>
                        <div class="form-check">
                            <input type="hidden" name="visible" value="false"  />
                            <input name='visible' type='checkbox' class='form-check-input' id='visibleCheck' value="true" checked >
                            <label for="visibleCheck">Sichtbar</label>
                        </div>
                        <div class="form-group">
                            <label for="number">Position</label>
                            <input name='position' type='number' class='form-control' id='number' value="{{old('position')}}" >
                        </div>
                        <div class="form-group">
                            <label for="site">Seite</label>
                            <input name='site' type='number' class='form-control' id='site' value="{{old('site')}}" >
                        </div>
                        <div class="form-group">
                            <label for="formControlFile">Datei</label>
                            <input type='file' class='form-control-file' id='formControlFile' name="photo" value="{{old('photo')}}">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>    
                        </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
