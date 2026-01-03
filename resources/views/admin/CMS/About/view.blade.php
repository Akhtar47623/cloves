@extends('layouts.admin.app')
@section('title','About Us')
@section('content')
<div class="container-fluid bg-white mt-5">
    <div class="row">
        <div class="col-sm-12">
            <div class="white-box card">
                <div class="card-body">
                    <h3 class="box-title pull-left">About Us</h3>
                    <a href="{{url('admin/about-us')}}" class="btn waves-effect waves-light btn-rounded btn-primary float-right">Back</a>
                    <div class="clearfix"></div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table">
                            <tbody>
                                <tr>
                                    <th>Title:</th>
                                    <td>{{ $about_cms->title }}</td>
                                </tr>
                                    @if($about_cms->description != null)
                                 <tr>
                                    <th>Description:</th>
                                    <td><?= html_entity_decode($about_cms->description) ?> </td>
                                </tr>
                                    @endif
                                    @if($about_cms->title1 != null)
                                <tr>
                                    <th>Location 1:</th>
                                    <td>{{ $about_cms->title1 }}</td>
                                </tr>
                                    @endif
                                    @if($about_cms->text1 != null)
                                <tr>
                                    <th>Short Description:</th>
                                    <td><?= html_entity_decode($about_cms->text1) ?> </td>
                                </tr>
                                    @endif
                                    @if($about_cms->title2 != null)
                                 <tr>
                                    <th>Location 2:</th>
                                    <td>{{ $about_cms->title2 }}</td>
                                </tr>
                                    @endif
                                    @if($about_cms->title3 != null)
                                 <tr>
                                    <th>Location 3:</th>
                                    <td>{{ $about_cms->title3 }}</td>
                                </tr>
                                    @endif
                                @if($about_cms->text2 != null)
                                <tr>
                                    <th>Description:</th>
                                    <td><?= html_entity_decode($about_cms->text2) ?> </td>
                                </tr>
                                @endif
                                @if($about_cms->image_path != null)
                                <tr>
                                    <th>Image:</th>
                                    <td><img style="width: 300px;height: 320px;" src="{{ asset($about_cms->image_path) }}"></td>
                                </tr>
                                @endif
                                @if($about_cms->image1 != null)
                                <tr>
                                    <th>Image2:</th>
                                    <td><img style="width: 300px;height: 320px;" src="{{ asset($about_cms->image1) }}"></td>
                                </tr>
                                @endif
                                @if($about_cms->video_path != null)
                                <tr>
                                    <th>Video:</th>
                                    <td>
                                        <video width="320" height="240" controls>
                                            <source src="{{ asset($about_cms->video_path) }}" type="video/mp4">
                                            <source src="{{ asset($about_cms->video_path) }}" type="video/ogg">
                                            Your browser does not support the video tag.
                                        </video>
                                    </td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.admin.includes.templates.footer')
</div>
@endsection

