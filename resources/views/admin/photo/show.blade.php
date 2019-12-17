@extends('layouts.admin')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Photo</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    @foreach($photos as $photo)
                    
                    <div >
                    @if($photo->visible == 'true')
                      <div class="alert alert-primary"> <p>Sichtbar: {{$photo->title}}</p></div>
                    @endif  
                    <a href="/admin/photo/edit/{{$photo->id}}" >
                    <h4>{{$photo->title}}</h4> 
                    </a>
                    
                    <img src="{{asset($photo->thumbnail_url) }}" alt="{{$photo->title}}" />
                                           
                    <p>{{$photo->description}}</p>
                    </div>
                    @if($photo->visible == 'true')
                      <div class="alert alert-primary"> </div>
                    @endif  
                    @endforeach 
                    
                  
                </div>
            </div>
        </div>
    </div>
</div>
@endsection