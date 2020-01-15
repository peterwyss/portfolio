@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                <textarea class="description" name="description"></textarea>
<script src="{{ asset('node_modules/tinymce/tinymce.js') }}"></script>
<script>
    tinymce.init({
        selector:'textarea.description',
        width: 900,
        height: 300,
        plugins: 'image',
        toolbar: 'image'
    });
</script> 

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
