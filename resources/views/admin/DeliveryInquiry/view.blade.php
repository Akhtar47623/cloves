@extends('layouts.admin.app')
@section('title','Delivery Inquiry')
@section('content')
<div class="container-fluid bg-white mt-5">
    <div class="row">
        <div class="col-sm-12">
            <div class="white-box card">
                <div class="card-body">
                    <h3 class="box-title pull-left">Delivery Inquiry </h3>

                    <a href="{{url('/admin/delivery-inquiry/')}}" class="btn waves-effect waves-light btn-rounded btn-primary float-right">Back</a>

                        <!-- <a class="btn btn-success pull-right" href="{{ url('/admin/request/inquiries') }}">
                            <i class="icon-arrow-left-circle" aria-hidden="true"></i> Back</a> -->

                    <div class="clearfix"></div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table">
                            <tbody>
                            @if($delivery_inquiry->first_name != null)
                            <tr>
                                <th> First Name :</th>
                                <td> {{ $delivery_inquiry->first_name }} </td>
                            </tr>
                            @endif
                            @if($delivery_inquiry->last_name != null)
                            <tr>
                                <th> Last Name :</th>
                                <td> {{ $delivery_inquiry->last_name }} </td>
                            </tr>
                            @endif
                             @if($delivery_inquiry->name != null)
                            <tr>
                                <th> Name :</th>
                                <td> {{ $delivery_inquiry->name }} </td>
                            </tr>
                            @endif
                              @if($delivery_inquiry->pharmacy_name != null)
                            <tr>
                                <th>Pharmacy Name :</th>
                                <td> {{ $delivery_inquiry->pharmacy_name }} </td>
                            </tr>
                            @endif
                            @if($delivery_inquiry->address != null)
                            <tr>
                                <th>Address :</th>
                                <td> {{ $delivery_inquiry->address }} </td>
                            </tr>
                            @endif
                            @if($delivery_inquiry->phone != null)
                            <tr>
                                <th> Phone :</th>
                                <td> {{ $delivery_inquiry->phone }} </td>
                            </tr>
                            @endif
                             @if($delivery_inquiry->time != null)
                            <tr>
                                <th> Time :</th>
                                <td> {{ $delivery_inquiry->time }} </td>
                            </tr>
                            @endif
                             @if($delivery_inquiry->daily_delivery != null)
                            <tr>
                                <th> Estimated Delivery :</th>
                                <td> {{ $delivery_inquiry->daily_delivery }} </td>
                            </tr>
                            @endif
                            @if($delivery_inquiry->organization != null)
                             <tr>
                                <th> Organization :</th>
                                <td> {{ $delivery_inquiry->organization }} </td>
                            </tr>
                            @endif
                              @if($delivery_inquiry->title != null)
                             <tr>
                                <th> Title :</th>
                                <td> {{ $delivery_inquiry->title }} </td>
                            </tr>
                            @endif
                            @if($delivery_inquiry->message != null)
                            <tr>
                                <th> Message :</th>
                                <td> <?= html_entity_decode($delivery_inquiry->message) ?> </td>
                            </tr>
                            @endif
                            @if($delivery_inquiry->deliver_to != null)
                            <tr>
                                <th> Where do you deliver? :</th>
                                <td> {{ $delivery_inquiry->deliver_to }} </td>
                            </tr>
                            @endif
                              @if($delivery_inquiry->delivery_destination != null)
                            <tr>
                                <th> Farthest Delivery Destinations :</th>
                                <td> {{ $delivery_inquiry->delivery_destination }} </td>
                            </tr>
                            @endif
                            @if($delivery_inquiry->street_address != null)
                            <tr>
                                <th> Street Adress :</th>
                                <td> {{ $delivery_inquiry->street_address }} </td>
                            </tr>
                            @endif
                            @if($delivery_inquiry->street_line != null)
                            <tr>
                                <th> Street Adress Line 2 :</th>
                                <td> {{ $delivery_inquiry->street_line }} </td>
                            </tr>
                            @endif
                            @if($delivery_inquiry->email != null)
                            <tr>
                                <th> Email :</th>
                                <td> {{ $delivery_inquiry->email }} </td>
                            </tr>
                            @endif
                            @if($delivery_inquiry->city != null)
                            <tr>
                                <th> City :</th>
                                <td> {{ $delivery_inquiry->city }} </td>
                            </tr>
                            @endif
                            @if($delivery_inquiry->region != null)
                            <tr>
                                <th> Region :</th>
                                <td> {{ $delivery_inquiry->region }} </td>
                            </tr>
                            @endif
                            @if($delivery_inquiry->postal != null)
                            <tr>
                                <th> Postal / Zip Code :</th>
                                <td> {{ $delivery_inquiry->postal }} </td>
                            </tr>
                            @endif
                            @if($delivery_inquiry->medicine_name != null)
                            <tr>
                                <th> Medicine Name :</th>
                                <td> {{ $delivery_inquiry->medicine_name }} </td>
                            </tr>
                            @endif
                            @if($delivery_inquiry->type != null)
                            <tr>
                                <th> Type :</th>
                                <td> {{ $delivery_inquiry->type }} </td>
                            </tr>
                            @endif
                            @if($delivery_inquiry->quantity != null)
                            <tr>
                                <th> Quantity :</th>
                                <td> {{ $delivery_inquiry->quantity }} </td>
                            </tr>
                            @endif
                            @if($delivery_inquiry->description != null)
                            <tr>
                                <th> Additional Information :</th>
                                <td> {{ $delivery_inquiry->description }} </td>
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

