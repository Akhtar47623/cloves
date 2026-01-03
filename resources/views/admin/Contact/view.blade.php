@extends('layouts.admin.app')
@section('title','Contact')
@section('content')
<div class="container-fluid bg-white mt-5">
    <div class="row">
        <div class="col-sm-12">
            <div class="white-box card">
                <div class="card-body">
                    <h3 class="box-title pull-left">Contact Inquiry Details </h3>

                    <a href="{{url('/admin/inquiry/')}}" class="btn waves-effect waves-light btn-rounded btn-primary float-right">Back</a>

                        <!-- <a class="btn btn-success pull-right" href="{{ url('/admin/request/inquiries') }}">
                            <i class="icon-arrow-left-circle" aria-hidden="true"></i> Back</a> -->

                    <div class="clearfix"></div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table">
                            <tbody>
                            <tr>
                            @if(isset($contact_inquiry->organization))
                                <th>Orgainzation Name :</th>
                                <td> {{ $contact_inquiry->organization }} </td>
                            @else
                                <th>Name :</th>
                                <td> {{ $contact_inquiry->name }} </td>
                            @endif
							</tr>
                            @if($contact_inquiry->last_name != null)
                            <tr>
                                <th> Last Name :</th>
                                <td> {{ $contact_inquiry->last_name }} </td>
                            </tr>
                            @endif
                         <!--    <tr>
                                <th> Phone Number </th>
                                <td> {{ $contact_inquiry->phone_number }} </td>
                            </tr> -->
                            @if($contact_inquiry->phone != null)
                            <tr>
                                <th> Best Phone Number :</th>
                                <td> {{ $contact_inquiry->phone }} </td>
                            </tr>
                            @endif
                            @if($contact_inquiry->purpose != null)
                            <tr>
                                <th> Purpose :</th>
                                <td> {{ $contact_inquiry->purpose }} </td>
                            </tr>
                            @endif
                            @if($contact_inquiry->address != null)
                            <tr>
                                <th> Address :</th>
                                <td> {{ $contact_inquiry->address }} </td>
                            </tr>
                            @endif
                            @if($contact_inquiry->message != null)
                            <tr>
                                <th> Additional Information :</th>
                                <td> <?= html_entity_decode($contact_inquiry->message) ?> </td>
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

