@extends('layouts.admin.app')
@section('title','Membership')
@section('content')
<div class="container-fluid bg-white mt-5">
    <div class="row">
        <div class="col-sm-12">
            <div class="white-box card">
                <div class="card-body">
                    <h3 class="box-title pull-left">Membership Details </h3>

                    <a href="{{url('/admin/membership/')}}" class="btn waves-effect waves-light btn-rounded btn-primary float-right">Back</a>

                        <!-- <a class="btn btn-success pull-right" href="{{ url('/admin/request/inquiries') }}">
                            <i class="icon-arrow-left-circle" aria-hidden="true"></i> Back</a> -->

                    <div class="clearfix"></div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table">
                            <tbody>
                            @if($membership->description != null)
                            <tr>
                                <th> Membership Description :</th>
                                <td> <?= html_entity_decode($membership->description) ?> </td>
                            </tr>
                            @endif
                           <!--  @if($membership->link != null)
                            <tr>
                                <th> Link :</th>
                                <td> {{ $membership->link }} </td>
                            </tr>
                            @endif -->
                            @if($membership->image_path != null)
                            <tr>
                            <th>Image: </th>
                            <td>
                            <img src="{{asset($membership->image_path) }}" class="img-responsve" width="250" height="200">
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

