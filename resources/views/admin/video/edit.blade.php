@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card" style="width: 68rem" >
                <div class="card-body">
                @if (session('status'))
                  <div class="alert alert-success" >
                      {{ session('status')}}
                  </div>
                @endif 
                @foreach ($video_list as $vimeo)

                <form method="POST"    action="/admin/video/store" enctype="multipart/form-data" >
                      @csrf
                      @php
                      $url = $vimeo['link'];
                      $video_id = substr($url,strrpos($url,"/")+1);
                      @endphp
                      <h3>{{$vimeo['name']}}</h3>
                      @if ($vimeo['exist'] == 'true')
                            <p>Visible</p>
                      @endif
                      <img src="{{$vimeo['picture']}}" />
                      <input type="hidden" name="picture" value="{{$vimeo['picture']}}" />

                      <input type="hidden" name="database_id" value="{{$vimeo['id']}}" />

                      <input type="text" name="title" value="{{$vimeo['name']}}" />
                      <input type="text" name="description" value="{{$vimeo['description']}}" />
                      <input type="text" name="videoId" value="{{$video_id}}" />
                      <input type="hidden" name="visible" value="false"  />

                      <input type="checkbox" name="visible" value="true" checked/>
                      <input type="number" name="position" value="{{$loop->index}}"/>
                      <input type="number" name="page" />

                      <input type="submit" name="action" value="Speichern" />

                </form>
                @endforeach


                
            </div>
            </div>
        </div>
    </div>
</div>
@endsection