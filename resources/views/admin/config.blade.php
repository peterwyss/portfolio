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
                            value="{{config('global.name')}}" >
                        </div>
                        <div class="form-group">
                            <label for="photo-description">Untertitel:</label>
                            <input type='text' name='sub-title' class='form-control   
                            ' id='sub-titel' aria-describedby="descriptionDescription" 
                             value="{{config('global.sub-title')}}" >
                        </div>
                        <div class="form-group">
                            <label for="photo-description">Debug:</label>
                            <input type='text' name='debug' class='form-control   
                            ' id='debug' aria-describedby="descriptionDescription" 
                            value="{{config('global.debug')}}">
                        </div>
                        <div class="form-group">
                            <label for="appToken">App-Token:</label>
                            <input type='text' name='appToken' class='form-control   
                            ' id='appToken' aria-describedby="descriptionDescription" 
                            value="{{config('global.appToken')}}">
                        </div>
                        <div class="form-group">
                            <label for="clientId">Client Identifier:</label>
                            <input type='text' name='clientId' class='form-control   
                            ' id='clientId' aria-describedby="descriptionDescription" 
                            value="{{config('global.clientId')}}">
                        </div>
                        <div class="form-group">
                            <label for="clientSecret">Client Secret:</label>
                            <input type='text' name='clientSecret' class='form-control   
                            ' id='clientSecret' aria-describedby="descriptionDescription" 
                            value="{{config('global.clientSecret')}}">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>    
                        </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
