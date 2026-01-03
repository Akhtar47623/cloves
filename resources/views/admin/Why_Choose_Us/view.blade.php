@extends('layouts.admin.app')
@section('title', 'Services')
@section('content')
    <div class="container-fluid bg-white mt-5">
        <!-- .row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box card">
                <div class="card-body">
                    <h3 class="box-title pull-left">Service # {{$why_choose_us->id}}</h3>

                    <a href="{{url('/admin/why-choose-us')}}" class="btn waves-effect waves-light btn-rounded btn-primary float-right">Back</a>

                    <div class="clearfix"></div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table">
                            <tbody>
                            <tr>
                                <th>ID</th>
                                <td>{{ $why_choose_us->id }}</td>
                            </tr>
                            <tr><th> Title: </th>
                            <td> {{ $why_choose_us->title }} </td>
                            </tr>
                           
                            <tr><th>Description </th>
                            <td> {!!$why_choose_us->description!!}</td>
                            </tr>
                            <tr><th>Image: </th>
                            <td>
                            <img src="{{asset($why_choose_us->image_path) }}" class="img-responsve" width="250" height="200">
                            </td>
                            </tr>
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

