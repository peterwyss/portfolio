@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Konfiguration</div>
               
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


                    <form  method="POST" action="/admin/config/store" enctype="multipart/form-data">
                    @csrf
                        <div class="form-group">
                            <label for="photo-title">Titel:</label>
                            <input name='name' type='text' class='form-control' 
                            id='app-name' aria-describedby="descriptionTitel" 
                            value="{{old('title')}}" placeholder="{{config('global.name')}}">
                        </div>
                        <div class="form-group">
                            <label for="photo-description">Untertitel:</label>
                            <input type='text' name='sub-title' class='form-control   
                            ' id='sub-titel' aria-describedby="descriptionDescription" 
                            >{{old('description')}}</input>
                        </div>
                        <div class="form-group">
                            <label for="photo-description">Debug:</label>
                            <input type='text' name='debug' class='form-control   
                            ' id='debug' aria-describedby="descriptionDescription" 
                            >
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>    
                        </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
