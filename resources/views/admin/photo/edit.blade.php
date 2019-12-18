@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Photo {{$photo->title}}</div>



                <div class="card-body">
                <img src="{{asset('storage/thump/'.$photo->name.'_thump.jpg') }}" 
                      alt="{{$photo->titel}}"  />
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form action="/admin/photo/update" method="POST"  >
                    @method('PATCH')
                    @csrf
                    <img src="{{url($photo->thumbnail_url)}}" class="img-thumbnail" />

                    <input type="text" class="form-control" name="title" value="{{$photo->title}}" /> 
                   <input type="hidden" name="id" class="form-controll" value="{{$photo->id}}" />

                    <input type="hidden" name="visible" class="form-controll" value="false" />
                    
                    <input type="checkbox" name="visible" class="form-controll" value="true" />

                    <input type="textarea" class="form-control" name="description" value="{{$photo->description}}"/> 
                    <input type="number" class="form-control" name="site" value="{{$photo->site}}"/> 
                    <input type="number" class="form-control" name="position" value="{{$photo->position}}"/> 

                    
                    <input type="submit" class="btn btn-primary" />
                    </form>
                    <div class="card">
                    <form action="/admin/photo/delete/{{$photo->id}}" method="POST" >
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Löschen</button>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection