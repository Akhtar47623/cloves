@extends('layouts.admin.app')
@section('title', 'Main Banner')
<style type="text/css">
@import url(//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css);

fieldset, label { margin: 0; padding: 0; }
body{ margin: 0px; }
h1 { font-size: 1.5em; margin: 10px; }

/****** Style Star Rating Widget *****/

.rating { 
  border: none;
  float: left;
  padding-left: 25px;
}

.rating > input { display: none; } 
.rating > label:before { 
  margin: 0px;
  font-size: 1.25em;
  font-family: FontAwesome;
  display: inline-block;
  content: "\f005";
}

.rating > .half:before { 
  content: "\f089";
  position: absolute;
}

.rating > label { 
  color: #ddd; 
 float: right; 
}
span.error {
    font-size: 15px;
    padding-left: 13px;
    color:red;
}

/***** CSS Magic to Highlight Stars on Hover *****/

.rating > input:checked ~ label, /* show gold star when clicked */
.rating:not(:checked) > label:hover, /* hover current star */
.rating:not(:checked) > label:hover ~ label { color: #FFD700;  } /* hover previous stars in list */

.rating > input:checked + label:hover, /* hover current star when changing rating */
.rating > input:checked ~ label:hover,
.rating > label:hover ~ input:checked ~ label, /* lighten current selection */
.rating > input:checked ~ label:hover ~ label { color: #FFED85;  } 
.jumbotron {padding-top: -4px;
}
</style>
@push('before-css')
<style type="text/css">
    p.error-message {
        color: #df0a0a;
        font-weight: 500;
        font-size: 14px;
    }
</style>
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
                            <h5 class="card-title m-b-0 align-self-center">Update Banner Info</h5>
                        </div>
                        <form action="{{url('/admin/main-banner/'.$banner->id)}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('put')

                            @if($banner->title != null)
                            <div class="form-group">
                                <label for="title">Title :</label>
                                <input type="text" class="form-control" id="title" name="title" value="{{$banner->title}}">
                            </div>
                            @endif
                            @if($banner->description != null)
                            <div class="form-group">
                                <label for="description">Short Description :</label>
                                <input type="text" class="form-control" id="desc" name="description" value="{{$banner->description}}">
                            </div>
                            @endif
                            @if($banner->banner_description != null)
                            <div class="form-group">
                                <label for="sub_text">Banner Description :</label>
                                <textarea class="form-control" id="banner_description" name="banner_description" rows="2">{{$banner-> banner_description}}</textarea>
                            </div>
                            @endif
                            @if($banner->button_name != null)
                            <div class="form-group">
                                <label for="sub_text">Button Name :</label>
                                <input type="text" class="form-control" id="button_name" name="button_name" value="{{$banner->button_name}}">
                            </div>
                            @endif
                            @if($banner->button_link != null)
                            <div class="form-group">
                                <label for="sub_text">Button Link :</label>
                                <input type="text" class="form-control" id="button_link" name="button_link" value="{{$banner->button_link}}">
                            </div>
                            @endif
                            <div class="form-group">
                                <label>Banner Background :</label>
                                <img alt="Main Banner" style="width:340px;" id="input-preview" src="{{ isset($banner)?asset($banner->image_path):asset('images/upload.jpg') }}">
                                <div class="upload-photo">
                                    <input type="file" name="image_path" id="image_path" class="dropify" />
                                    @error('image_path')
                                    <p class="error-message text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                             @if($banner->image5 != null)
                              <div class="form-group">
                                <label>Image 5 :</label>
                                <img alt="image" style="width:344px;" id="input-preview" src="{{ isset($banner)?asset($banner->image5):asset('images/upload.jpg') }}">
                                <div class="upload-photo">
                                    <input type="file" name="image5" id="image5" class="dropify" />
                                    @error('image5')
                                    <p class="error-message text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            @endif
                            <h4>Banner Testimonials(optional)</h4>
                            @if($banner->image1 != null)
                            <div class="form-group">
                                <label>Image 1 :</label>
                                <img alt="image" style="width:80px;" id="input-preview" src="{{ isset($banner)?asset($banner->image1):asset('images/upload.jpg') }}">
                                <div class="upload-photo">
                                    <input type="file" name="image1" id="image1" class="dropify" />
                                    @error('image1')
                                    <p class="error-message text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            @endif
                            @if($banner->image2 != null)
                              <div class="form-group">
                                <label>Image 2 :</label>
                                <img alt="image" style="width:80px;" id="input-preview" src="{{ isset($banner)?asset($banner->image2):asset('images/upload.jpg') }}">
                                <div class="upload-photo">
                                    <input type="file" name="image2" id="image2" class="dropify" />
                                    @error('image2')
                                    <p class="error-message text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            @endif
                            @if($banner->image3 != null)
                              <div class="form-group">
                                <label>Image 3 :</label>
                                <img alt="image" style="width:80px;" id="input-preview" src="{{ isset($banner)?asset($banner->image3):asset('images/upload.jpg') }}">
                                <div class="upload-photo">
                                    <input type="file" name="image3" id="image3" class="dropify" />
                                    @error('image3')
                                    <p class="error-message text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            @endif
                            @if($banner->image4 != null)
                              <div class="form-group">
                                <label>Image 4 :</label>
                                <img alt="image" style="width:80px;" id="input-preview" src="{{ isset($banner)?asset($banner->image4):asset('images/upload.jpg') }}">
                                <div class="upload-photo">
                                    <input type="file" name="image4" id="image4" class="dropify" />
                                    @error('image4')
                                    <p class="error-message text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            @endif
                            @if($banner->rating != null)

                             <div class="form-row pb-2">
                                  <label for="rating" class="pl-2">Star Rating :</label>
                                <div class="col">
                                  <fieldset class="rating" >
                                    <input type="radio" id="star5" name="rating" value="5" {{ ($banner->rating == 5) ? 'checked' : '' }} /><label class = "full" for="star5" title="Awesome - 5 stars"></label>
                                    <input type="radio" id="star4" name="rating" value="4" {{ ($banner->rating == 4) ? 'checked' : '' }}/><label class = "full" for="star4" title="Pretty good - 4 stars"></label>
                                    <input type="radio" id="star3" name="rating" value="3" {{ ($banner->rating == 3) ? 'checked' : '' }}/><label class = "full" for="star3" title="Meh - 3 stars"></label>
                                    <input type="radio" id="star2" name="rating" value="2" {{ ($banner->rating == 2) ? 'checked' : '' }}/><label class = "full" for="star2" title="Kinda bad - 2 stars"></label>
                                    <input type="radio" id="star1" name="rating" value="1" {{ ($banner->rating == 1) ? 'checked' : '' }}/><label class = "full" for="star1" title="Sucks big time - 1 star"></label>
                                  </fieldset>
                                </div>
                              </div>
                              @error('rating')
                              <span class="error" class="text-danger">**{{ $message }}</span>
                              @enderror
                              @endif
                                @if($banner->reviews != null)
                                <div class="form-group">
                                    <label for="Reviews">Reviews :</label>
                                    <input type="text" class="form-control" id="reviews" name="reviews" value="{{$banner->reviews}}">
                                </div>
                                @endif
                              <div class="form-group">
                                 <label for="occupation">Status:</label>
                                  @if($banner->status == 0)
                                  <select class="form-select form-control" aria-label="Default select example" name="status" >
                                    <option value="0" selected class="form-control">Inactive</option>
                                    <option value="1" class="form-control">Active</option>
                                  </select>
                                  @elseif($banner->status == 1)
                                  <select class="form-control" aria-label="Default select example" name="status">
                                    <option value="1" selected class="form-control">Active</option>
                                    <option value="0" class="form-control">InActive</option>
                                  </select>
                                   @endif
                                </div>
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
