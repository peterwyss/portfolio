@extends('layouts.admin')

@section('content')

<script>
    var video_list = @json($video_list);
    let _TOKEN = "{{ csrf_token() }}";

</script>

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
                <div id="testForm" />
  
                <p>  
                @if ($response['body']['page'] > 1 )
                    <a href="{{asset('/admin/video/create/' . ($response['body']['page'] -1) )}}">prev</a>
                @endif                
                @if ($response['body']['page'] * $response['body']['per_page'] < $response['body']['total'])
                    <a href="{{asset('/admin/video/create/' . ($response['body']['page'] +1) )}}">next</a>
                @endif
                </p>

                
            </div>
            </div>
        </div>
    </div>
</div>
@endsection