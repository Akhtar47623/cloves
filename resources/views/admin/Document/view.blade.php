@extends('layouts.admin.app')
@section('title','Document')
@section('content')
<style type="text/css">
    tr, td{
        text-transform: capitalize;
    }
</style>
<div class="container-fluid bg-white mt-5">
    <div class="row">
        <div class="col-sm-12">
            <div class="white-box card">
                <div class="card-body">
                    <h3 class="box-title pull-left">Document # {{$documents->id}}</h3>
                    <a href="{{url('/admin/document')}}" class="btn waves-effect waves-light btn-rounded btn-primary float-right">Back</a>
                    <div class="clearfix"></div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table">
                             <tbody>
                               
                                <td><h5>Document :</h5></td>
                                    <td>

                                        <a href="{{asset($documents->upload_file)}}" style="width:550px; height:450px;" frameborder="1">download <i class="fa fa-arrow-down"></i></a>
                                    </td>
                                </tr>
                                </table>
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