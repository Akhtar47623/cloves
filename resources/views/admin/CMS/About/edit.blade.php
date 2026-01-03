@extends('layouts.admin.app')
@section('title','About Us')
@push('before-css')
<link href="{{asset('plugins/vendors/morrisjs/morris.css')}}" rel="stylesheet">
<link href="{{asset('plugins/vendors/c3-master/c3.min.css')}}" rel="stylesheet">
<link href="{{asset('plugins/vendors/toast-master/css/jquery.toast.css')}}" rel="stylesheet">
<link href="{{asset('plugins/vendors/vectormap/jquery-jvectormap-2.0.2.css')}}" rel="stylesheet"/>
<link href="{{asset('plugins/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('assets/css/pages/google-vector-map.css')}}" rel="stylesheet">
<link href="{{ asset('https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css') }}" rel="stylesheet">
@endpush
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex m-b-10 no-block">
                        <h5 class="card-title m-b-0 align-self-center">CMS Content</h5>
                        <div class="ml-auto text-light-blue">
                            <ul class="nav nav-tabs customtab default-customtab list-inline text-uppercase lp-5 font-medium font-12" role="tablist">
                            </ul>
                        </div>
                    </div>
                    <form action="{{url('/admin/about-us/'.$about_cms->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        @if($about_cms->title != null && $about_cms->page_section =='Location Section')
                        <div class="form-group">
                            <label for="heading">Title:</label>
                            <input type="text" class="form-control" id="heading" name="heading" value="{{$about_cms->title}}">
                        </div>
                        <div class="form-group">
                            <label for="title">Location 1:</label>
                            <input type="text" class="form-control" id="title1" name="title1" value="{{$about_cms->title1}}">
                        </div>
                        <div class="form-group">
                            <label for="title">Location 2:</label>
                            <input type="text" class="form-control" id="title2" name="title2" value="{{$about_cms->title2}}">
                        </div>
                        <div class="form-group">
                            <label for="title">Location 3:</label>
                            <input type="text" class="form-control" id="title3" name="title3" value="{{$about_cms->title3}}">
                        </div>
                        @endif
                         @if($about_cms->image_path != null)
                        <div class="form-group">
                            <label for="image">Map Image:</label>
                            <img alt="map" style="height: 280px;width: 200px;" id="input-preview" src="{{ isset($about_cms)?asset($about_cms->image_path):asset('images/upload.jpg') }}">
                            <div class="upload-photo">
                                <input type="file" name="image_path" id="image_path" class="dropify" />
                            </div>
                        </div>
                        @endif
                        @if($about_cms->title != null && $about_cms->page_section == 'Certifications and Memberships Section')
                        <div class="form-group">
                            <label for="heading">Title:</label>
                            <input type="text" class="form-control" id="heading" name="heading" value="{{$about_cms->title}}">
                        </div>
                        @endif
                          @if($about_cms->description != null && $about_cms->page_section =="How it works Section")
                        <div class="form-group">
                            <label for="heading">Title:</label>
                            <input type="text" class="form-control" id="heading" name="heading" value="{{$about_cms->title}}">
                        </div>
                        <div class="form-group">
                            <label for="description">Description:</label>
                            <textarea class="form-control" id="description" name="description" rows="3" value="{{$about_cms->description}}">{{$about_cms->description}}</textarea>
                        </div>
                         @if($about_cms->image_path != null)
                        <div class="form-group">
                            <label for="image">Image:</label>
                            <img alt="Website Logo" style="height: 280px;width: 200px;" id="input-preview" src="{{ isset($about_cms)?asset($about_cms->image_path):asset('images/upload.jpg') }}">
                            <div class="upload-photo">
                                <input type="file" name="image_path" id="image_path" class="dropify" />
                            </div>
                        </div>
                        @endif
                        @endif
                           @if($about_cms->description != null && $about_cms->page_section =="About Us Section")
                        <div class="form-group">
                            <label for="heading">Title:</label>
                            <input type="text" class="form-control" id="heading" name="heading" value="{{$about_cms->title}}">
                        </div>
                        <div class="form-group">
                            <label for="description">Description:</label>
                            <textarea class="form-control" id="description" name="description" rows="3" value="{{$about_cms->description}}">{{$about_cms->description}}</textarea>
                        </div>
                         @if($about_cms->image_path != null)
                        <div class="form-group">
                            <label for="image">Image:</label>
                            <img alt="Website Logo" style="height: 280px;width: 200px;" id="input-preview" src="{{ isset($about_cms)?asset($about_cms->image_path):asset('images/upload.jpg') }}">
                            <div class="upload-photo">
                                <input type="file" name="image_path" id="image_path" class="dropify" />
                            </div>
                        </div>
                        @endif
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
<script src="{{asset('plugins/vendors/d3/d3.min.js')}}"></script>
<script src="{{asset('plugins/vendors/c3-master/c3.min.js')}}"></script>
<script src="{{asset('plugins/vendors/knob/jquery.knob.js')}}"></script>
<script src="{{asset('plugins/vendors/sparkline/jquery.sparkline.min.js')}}"></script>
<script src="{{asset('plugins/vendors/raphael/raphael-min.js')}}"></script>
<script src="{{asset('plugins/vendors/morrisjs/morris.js')}}"></script>
<script src="{{asset('plugins/vendors/toast-master/js/jquery.toast.js')}}"></script>
<script src="{{asset('plugins/vendors/datatables/jquery.dataTables.min.js')}}"></script>
<script>
    $(document).ready(function(){
        $('#description').summernote({
            tabsize: 2,
            height: 100
        });
        $('#text1').summernote({
            tabsize: 2,
            height: 100
        });
         $('#text2').summernote({
            tabsize: 2,
            height: 100
        });
    });
</script>
<script src="{{asset('plugins/vendors/styleswitcher/jQuery.style.switcher.js')}}"></script>
<script src="{{ asset('https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js') }}"></script>
@endpush



