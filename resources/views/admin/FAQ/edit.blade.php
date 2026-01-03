@extends('layouts.admin.app')
@section('title', 'FAQS')
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
                            <h5 class="card-title m-b-0 align-self-center">Update FAQ</h5>
                        </div>
                        <form action="{{url('/admin/faqs/'.$faqs->id)}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('put')

                            @if($faqs->question != null)
                            <div class="form-group">
                                <label for="question">Question :</label>
                                <input type="text" class="form-control" id="question" name="question" value="{{$faqs->question}}">
                            </div>
                            @endif
                            @if($faqs->answer != null)
                            <div class="form-group">
                                <label for="answer">Answer :</label>
                                <input type="text" class="form-control" id="desc" name="answer" value="{{$faqs->answer}}">
                            </div>
                            @endif
                            @if($faqs->faqs_description != null)
                            <div class="form-group">
                                <label for="sub_text">faqs Description :</label>
                                <textarea class="form-control" id="faqs_description" name="faqs_description" rows="2">{{$faqs-> faqs_description}}</textarea>
                            </div>
                            @endif
                            @if($faqs->button_name != null)
                            <div class="form-group">
                                <label for="sub_text">Button Name :</label>
                                <input type="text" class="form-control" id="button_name" name="button_name" value="{{$faqs->button_name}}">
                            </div>
                            @endif
                            @if($faqs->button_link != null)
                            <div class="form-group">
                                <label for="sub_text">Button Link :</label>
                                <input type="text" class="form-control" id="button_link" name="button_link" value="{{$faqs->button_link}}">
                            </div>
                            @endif
                            @if($faqs->image_path != null)
                            <div class="form-group">
                                <label>Image :</label>
                                <img alt="Main faqs" style="width:340px;" id="input-preview" src="{{ isset($faqs)?asset($faqs->image_path):asset('images/upload.jpg') }}">
                                <div class="upload-photo">
                                    <input type="file" name="image_path" id="image_path" class="dropify" />
                                    @error('image_path')
                                    <p class="error-message text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            @endif
                              <div class="form-group">
                                 <label for="occupation">Status:</label>
                                  @if($faqs->status == 0)
                                  <select class="form-select form-control" aria-label="Default select example" name="status" >
                                    <option value="0" selected class="form-control">Inactive</option>
                                    <option value="1" class="form-control">Active</option>
                                  </select>
                                  @elseif($faqs->status == 1)
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
