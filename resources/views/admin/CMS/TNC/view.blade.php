@extends('layouts.admin.app')
@section('title','Terms And Conditions')
@section('content')
<div class="container-fluid bg-white mt-5">
    <div class="row">
        <div class="col-sm-12">
            <div class="white-box card">
                <div class="card-body">
                    <h3 class="box-title pull-left">Terms And Conditions</h3>
                    <a href="{{url('admin/terms-conditions')}}" class="btn waves-effect waves-light btn-rounded btn-primary float-right">Back</a>
                    <div class="clearfix"></div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table">
                            <tbody>
                                <tr>
                                    <th>Title:</th>
                                    <td>{{ $tns_cms->title }}</td>
                                </tr>
                                <tr>
                                    @if($tns_cms->description !=null)
                                    <th>Description:</th>
                                    <td>{!! $tns_cms->description !!}</td>
                                    @endif
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

