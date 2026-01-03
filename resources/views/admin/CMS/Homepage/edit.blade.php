@extends('layouts.admin.app')
@section('title','CMS Content')
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
                    <form action="{{url('/admin/homepage-content/'.$homepage_content->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                              <!-- info section -->
                         @if($homepage_content->page_section =='Location Section')
                        <div class="form-group">
                            <label for="title">Title:</label>
                            <input type="text" class="form-control" id="title" name="title" value="{{$homepage_content->title}}">
                        </div>
                         <div class="form-group">
                            <label for="title">Location 1:</label>
                            <input type="text" class="form-control" id="title1" name="title1" value="{{$homepage_content->title1}}">
                        </div>
                         <div class="form-group">
                            <label for="title">Location 2:</label>
                            <input type="text" class="form-control" id="title2" name="title2" value="{{$homepage_content->title2}}">
                        </div>
                         <div class="form-group">
                            <label for="title">Location 3:</label>
                            <input type="text" class="form-control" id="title3" name="title3" value="{{$homepage_content->title3}}">
                        </div>
                         <div class="form-group">
                            <label for="image">Map Image:</label>
                            <img alt="map" id="input-preview" width="200" height="200" src="{{ isset($homepage_content)?asset($homepage_content->image_path):asset('images/upload.jpg') }}">
                            <div class="upload-photo">
                                <input type="file" name="image_path" id="image_path" class="dropify" />
                            </div>
                        </div>
                        @endif
                           @if($homepage_content->page_section =='About Us Section')
                        <div class="form-group">
                            <label for="title">Title:</label>
                            <input type="text" class="form-control" id="title" name="title" value="{{$homepage_content->title}}">
                        </div>
                        @endif
                        @if($homepage_content->description != NULL && $homepage_content->page_section =='About Us Section' )
                        <div class="form-group">
                            <div class="form-group">
                            <label for="description">Description:</label>
                            <textarea type="text" class="form-control" id="description" name="description">{{$homepage_content->description}}</textarea>
                        </div>
                        @if($homepage_content->button1 != NULL)
                        <div class="form-group">
                            <label for="button1">Button Name:</label>
                            <input type="text" class="form-control" id="button1" name="button1" value="{{$homepage_content->button1}}">
                        </div>
                        @endif
                        @if($homepage_content->image1 != NULL)
                         <div class="form-group">
                            <label for="image">Image 1:</label>
                            <img alt="Image" id="input-preview" width="200" height="200" src="{{ isset($homepage_content)?asset($homepage_content->image1):asset('images/upload.jpg') }}">
                            <div class="upload-photo">
                                <input type="file" name="image1" id="image1" class="dropify" />
                            </div>
                        </div>
                        @endif
                        @if($homepage_content->image2 != NULL)
                         <div class="form-group">
                            <label for="image">Image 2:</label>
                            <img alt="Image" id="input-preview" width="200" height="200" src="{{ isset($homepage_content)?asset($homepage_content->image2):asset('images/upload.jpg') }}">
                            <div class="upload-photo">
                                <input type="file" name="image2" id="image2" class="dropify" />
                            </div>
                        </div>
                        @endif
                        @if($homepage_content->image3 != NULL)
                         <div class="form-group">
                            <label for="image">Image 3:</label>
                            <img alt="Image" id="input-preview" width="200" height="200" src="{{ isset($homepage_content)?asset($homepage_content->image3):asset('images/upload.jpg') }}">
                            <div class="upload-photo">
                                <input type="file" name="image3" id="image3" class="dropify" />
                            </div>
                        </div>
                        @endif
                        @endif
                        @if($homepage_content->title !=null && $homepage_content->page_section == 'Partner Section')
                          <div class="form-group">
                            <label for="title">Title:</label>
                            <input type="text" class="form-control" id="title" name="title" value="{{$homepage_content->title}}">
                        </div>
                        <div class="form-group">
                            <label for="image">Image:</label>
                            <img alt="Image" id="input-preview" width="200" height="200" src="{{ isset($homepage_content)?asset($homepage_content->image_path):asset('images/upload.jpg') }}">
                            <div class="upload-photo">
                                <input type="file" name="image_path" id="image_path" class="dropify" />
                            </div>
                        </div>
                        @endif
                         @if($homepage_content->image_path !=null && $homepage_content->page_section =='Services Section')
                          <div class="form-group">
                            <label for="title">Title:</label>
                            <input type="text" class="form-control" id="title" name="title" value="{{$homepage_content->title}}">
                        </div>
                        <div class="form-group">
                            <div class="form-group">
                            <label for="description">Short Description:</label>
                            <input type="text" class="form-control" id="des" name="description" value="{{$homepage_content->description}}">
                        </div>
                         <div class="form-group">
                            <label for="image">Background Image:</label>
                            <img alt="Image" id="input-preview" width="200" height="200" src="{{ isset($homepage_content)?asset($homepage_content->image_path):asset('images/upload.jpg') }}">
                            <div class="upload-photo">
                                <input type="file" name="image_path" id="image_path" class="dropify" />
                            </div>
                        </div>
                        @endif
                        <!-- info section -->
                        <!-- our speciality -->
                        <!-- our speciality -->
                        <!-- services -->
                         @if($homepage_content->title1 != null && $homepage_content->page_section =='Services Section' )
                        <div class="form-group">
                            <label for="title1">Title:</label>
                            <input type="text" class="form-control" id="title1" name="title1" value="{{$homepage_content->title1}}">
                        </div>
                         <div class="form-group">
                            <div class="form-group">
                            <label for="text1">Short Description:</label>
                            <input type="text" class="form-control" id="text1" name="text1" value="{{$homepage_content->text1}}">
                            </div>
                        </div>
                        @endif
                           @if($homepage_content->title != null && $homepage_content->page_section =='FAQS Section' )
                        <div class="form-group">
                            <label for="title">Title:</label>
                            <input type="text" class="form-control" id="title" name="title" value="{{$homepage_content->title}}">
                        </div>
                         <div class="form-group">
                            <div class="form-group">
                            <label for="description">Short Description:</label>
                            <input type="text" class="form-control" id="text1" name="description" value="{{$homepage_content->description}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="button">Button Name:</label>
                            <input type="text" class="form-control" id="button1" name="button1" value="{{$homepage_content->button1}}">
                        </div>
                         <div class="form-group">
                            <label for="image">Background Image:</label>
                            <img alt="Image" id="input-preview" width="200" height="200" src="{{ isset($homepage_content)?asset($homepage_content->image_path):asset('images/upload.jpg') }}">
                            <div class="upload-photo">
                                <input type="file" name="image_path" id="image_path" class="dropify" />
                            </div>
                        </div>
                        @endif
                         @if($homepage_content->title != null && $homepage_content->page_section =='Document Section' )
                        <div class="form-group">
                            <label for="title">Title:</label>
                            <input type="text" class="form-control" id="title" name="title" value="{{$homepage_content->title}}">
                        </div>
                         <div class="form-group">
                            <div class="form-group">
                            <label for="description">Short Description:</label>
                            <input type="text" class="form-control" id="text1" name="description" value="{{$homepage_content->description}}">
                            </div>
                        </div>
                        @endif
                         @if($homepage_content->title != null && $homepage_content->page_section =='Certifications and Memberships Section' )
                        <div class="form-group">
                            <label for="title">Title:</label>
                            <input type="text" class="form-control" id="title" name="title" value="{{$homepage_content->title}}">
                        </div>
                        
                        @endif
                         @if($homepage_content->page_section =='Why Choose Us Section' )
                        <div class="form-group">
                            <label for="title">Heading:</label>
                            <input type="text" class="form-control" id="title" name="title" value="{{$homepage_content->title}}">
                        </div>
                         <div class="form-group">
                            <div class="form-group">
                            <label for="description">Short Description:</label>
                            <input type="text" class="form-control" id="" name="description" value="{{$homepage_content->description}}">
                            </div>
                        </div>
                         <div class="form-group">
                            <label for="title1">Title1:</label>
                            <input type="text" class="form-control" id="title1" name="title1" value="{{$homepage_content->title1}}">
                        </div>
                          <div class="form-group">
                            <div class="form-group">
                            <label for="text1">Short Description:</label>
                            <input type="text" class="form-control" id="text1" name="text1" value="{{$homepage_content->text1}}">
                            </div>
                        </div>                        
                        <div class="form-group">
                            <label for="image">Image 1:</label>
                            <img alt="Image" id="input-preview" width="200" height="200" src="{{ isset($homepage_content)?asset($homepage_content->image_path):asset('images/upload.jpg') }}">
                            <div class="upload-photo">
                                <input type="file" name="image_path" id="image_path" class="dropify" />
                            </div>
                        </div>
                         <div class="form-group">
                            <label for="title">Title2:</label>
                            <input type="text" class="form-control" id="title2" name="title2" value="{{$homepage_content->title2}}">
                        </div>
                         <div class="form-group">
                            <div class="form-group">
                            <label for="text">Short Description:</label>
                            <input type="text" class="form-control" id="text2" name="text2" value="{{$homepage_content->text2}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="image">Image 2:</label>
                            <img alt="Image" id="input-preview" width="200" height="200" src="{{ isset($homepage_content)?asset($homepage_content->image1):asset('images/upload.jpg') }}">
                            <div class="upload-photo">
                                <input type="file" name="image1" id="image1" class="dropify" />
                            </div>
                        </div>
                         <div class="form-group">
                            <label for="title">title3:</label>
                            <input type="text" class="form-control" id="title3" name="title3" value="{{$homepage_content->title3}}">
                        </div>
                         <div class="form-group">
                            <div class="form-group">
                            <label for="text">Short Description:</label>
                            <input type="text" class="form-control" id="text3" name="text3" value="{{$homepage_content->text3}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="image">Image 3:</label>
                            <img alt="Image" id="input-preview" width="200" height="200" src="{{ isset($homepage_content)?asset($homepage_content->image2):asset('images/upload.jpg') }}">
                            <div class="upload-photo">
                                <input type="file" name="image2" id="image2" class="dropify" />
                            </div>
                        </div>
                 
                        @endif
                        <!-- services -->
                     <!--    @if($homepage_content->text6 != null)
                        <div class="form-group">
                            <label for="text6">Short Description:</label>
                            <input type="text" class="form-control" id="text6" name="text6" value="{{$homepage_content->text6}}">
                        </div>
                        @endif -->
                        @if($homepage_content->image6 != null)
                        <div class="form-group">
                            <label for="image">Image7:</label>
                            <img alt="Image" id="input-preview" width="200" height="200" src="{{ isset($homepage_content)?asset($homepage_content->image6):asset('images/upload.jpg') }}">
                            <div class="upload-photo">
                                <input type="file" name="image6" id="image6" class="dropify" />
                            </div>
                        </div>
                        @endif
                        <!-- Video -->
                            @if($homepage_content->page_name == 'Home Page' && $homepage_content->page_section == 'Video'  )
                               @if($homepage_content->image_path != null)
                                <div class="form-group">
                                    <label for="vidoe_path">Video:</label>
                                    <br>
                                    <video class="player"  width="700" height="400" allow="accelerometer;   clipboard-write; encrypted-media; gyroscope;" controls controlsList="nofullscreen noremoteplayback">
                                        <source src="{{asset($homepage_content->image_path)}}?autoplay=0" type="video/mp4">
                                        <source src="{{asset($homepage_content->image_path)}}?autoplay=0" type="video/ogg">
                                    </video>
                                    <br>
                                    <div class="">
                                        <input type="file" name="video" id="video" class="dropify form-control" placeholder="Trailer Path" value="{{$homepage_content->video}}" />
                                    </div>
                                   @error('video')
                                    <p class="error-message text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                @endif
                        @endif

                        <!-- Video -->
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
            placeholder: 'Type News Details',
            tabsize: 2,
            height: 100
        });
    });
</script>
<script src="{{asset('plugins/vendors/styleswitcher/jQuery.style.switcher.js')}}"></script>
<script src="{{ asset('https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js') }}"></script>
@endpush

