@extends('layouts.admin.app')
@section('title', 'Our Location')
@push('before-css')
<link href="{{ asset('https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css') }}" rel="stylesheet">
@endpush
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex m-b-10 no-block">
                            <h5 class="card-title m-b-0 align-self-center">Update Location</h5>
                        </div>
                        <form action="{{url('/admin/location/'.$locations->id)}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('put')

                            @if($locations->location != null)
                            <div class="form-group">
                                <label for="location">Current Location :</label>
                                <input type="text" class="form-control" id="location" name="location" value="{{$locations->location}}">
                            </div>
                            @endif
                            <button class="btn btn-success pull-center" type="submit">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.admin.includes.templates.footer')
    </div>
@endsection
@push('js')
<script src="{{ asset('https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js') }}"></script>
<script>
    $(document).ready(function(){
        $('#description').summernote({
            tabsize: 2,
            height: 100
        });
    });
</script>
@endpush
