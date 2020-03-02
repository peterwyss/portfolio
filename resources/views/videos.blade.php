@extends('layouts.app')

@section('content')

<script>var w = Math.max(document.documentElement.clientWidth, window.innerWidth || 0);
document.write(w);
</script>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{__('photos.Fotos')}}</div>
                <div class="card-body ">
                <div class="row d-flex justify-content-center">
                @foreach ($page_one as $video)
                @if ($video->page == 1)

                    @if (($loop->index % 5) == 0)
                            <div class="w-100">

                            </div>
                    @endif 
                                <div data-toggle="modal" data-target="#lightbox">                       
                                    <a href="#my-car" data-slide-to="{{$loop->index}}" ><img src="{{$video->picture}}" class="img-thumbnail" /></a> 
                                </div>
                @endif                
                @endforeach
                </div>
                <div id="lightbox" class="modal fade " role="dialog" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered modal-lg" >
                        <div class="modal-content-video">
                            <div class="modal-body ">
                            <div  id="my-car" class="carousel slide "  data-ride="carousel" data-interval="false">
                  
                              <ol class="carousel-indicators" >
                                @foreach ($page_one as $video)
                                @if ($video->page == 1)

                                    @if ($loop->index == 0)
                                        <li data-target="#my-car" data-slide-to="{{$loop->index}}" class="active"/></li>
                                    @else
                                        <li data-target="#my-car" data-slide-to="{{$loop->index}}" /></li>
                                    @endif    
                                @endif                        
                                @endforeach
                                </ol>
                                <div class="carousel-inner">
                                    @foreach ($page_one as $video)
                                    @if ($video->page == 1)

                                            <div class="carousel-item {{$loop->first ? 'active' : ''}} responsive-video">
                                                <iframe class="d-block w-100" src="https://player.vimeo.com/video/{{$video->video_id}}"
                                                      frameborder="0"  allow="autoplay" portrait="false"; fullscreen" allowfullscreen ></iframe>
                                                <div class="carousel-caption d-none d-md-block  mb-4" >
                                                    <p>{!!$video->description!!}</p>
                                                </div>
                                            </div> <!-- item -->

                                    @endif                        
                                    @endforeach
                                </div> <!-- carousel-inner -->
                                    <a class=" carousel-control-prev"  href="#my-car" role="button" data-slide="prev" >
                                        <span class="carousel-control-prev-icon"><</span>
                                    </a>
                                    <a class=" carousel-control-next "  href="#my-car" role="button" data-slide="next" >
                                        <span class="carousel-control-next-icon"></span>
                                    </a>                       

                            </div>                
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
