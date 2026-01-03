@extends('layouts.admin.app')
@section('title','Contact Us')
@section('content')
<div class="container-fluid bg-white mt-5">
    <div class="row">
        <div class="col-sm-12">
            <div class="white-box card">
                <div class="card-body">
                    <h3 class="box-title pull-left">Contact Us</h3>
                    <a href="{{url('admin/contact-us')}}" class="btn waves-effect waves-light btn-rounded btn-primary float-right">Back</a>
                    <div class="clearfix"></div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table">
                            <tbody>
                                <tr>
                                    <th>Title:</th>
                                    <td>{{ $contact_us->title }}</td>
                                </tr>
                                  <tr>
                                    <th>Form Title:</th>
                                    <td>{{ $contact_us->title1 }}</td>
                                </tr>
                                
                               <!--  <tr>
                                    <th>Image:</th>
                                    <td><img src="{{ asset($contact_us->image_path) }}"></td>
                                </tr> -->
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

