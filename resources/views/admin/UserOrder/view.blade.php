@extends('layouts.admin.app')
@section('title', 'Order')
@section('content')
    <div class="container-fluid bg-white mt-5">
        <!-- .row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box card">
                <div class="card-body">
                    <h3 class="box-title pull-left">Order-{{$user_orders->order_id}} </h3>
                    @if(auth()->user()->hasRole('vendor'))
                        <a href="{{url('/vendor/order')}}" class="btn waves-effect waves-light btn-rounded btn-primary float-right">Back</a>
                    @elseif(auth()->user()->hasRole('user'))
                        <a href="{{url('/user/order')}}" class="btn waves-effect waves-light btn-rounded btn-primary float-right">Back</a>
                    @endif
                    <div class="clearfix"></div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table">
                            <tbody>
                            <tr>
                                <th>Product</th>
                                <td>{{$user_orders->product}} </td>
                                <th>Date</th>
                                <td>{{$user_orders->current_date}} </td>
                            </tr>
                                @if($user_orders->pickup_location_id != null)
                                <th>Pickup Location ID </th>
                                <td>{{$user_orders->pickup_location_id}}</td>
                                @endif
                                @if($user_orders->delivery_location_id)
                                <th>Delivery Location ID </th>
                                <td>{{$user_orders->delivery_location_id}}</td>
                                @endif
                            </tr>
                            <tr>
                                <th>Full Name</th>
                                <td>
                                    {{$user_orders->full_name}}
                                </td>
                                <th>Email  </th>
                                <td>{{$user_orders->email}}</td>
                                @if($user_orders->organization != null)
                                <th>Organization/Pharmacy  </th>
                                <td>{{$user_orders->organization}}</td>
                                @endif
                            </tr>

                            <tr>
                                <th>Time Windows</th>
                                <td>
                                    {{$user_orders->time_from}} - {{$user_orders->time_to}}
                                </td>
                                <th>Boxes  </th>
                                <td>{{$user_orders->boxes}}</td>
                                <th>Duration</th>
                                <td>{{$user_orders->duration}}</td>
                            </tr>
                             <!-- <tr>
                                <th>Priority</th>
                                @if($user_orders->priority == 'L')
                                <td>Low</td>
                                @endif
                                @if($user_orders->priority == 'H')
                                <td>High</td>
                                @endif
                                @if($user_orders->priority == 'M')
                                <td>Medium</td>
                                @endif
                                <th>Delivery Type</th>
                                @if($user_orders->delivery_type =='D')
                                    <td>Delivery</td>
                                @endif
                                @if($user_orders->delivery_type =='T')
                                    <td>Task</td>
                                @endif
                                @if($user_orders->delivery_type =='P')
                                <td>Pickup</td>
                                @endif
                                
                            </tr> -->
                            </tbody>
                        </table>
                        <div class="table-responsive">
                        <table class="table table">
                            <tbody>
                                <tr>
                                <th>Location </th>
                                <td>{{$user_orders->location}}</td>
                            </tr>
                            <tr>
                                <th>Notes</th>
                                <td>{{$user_orders->notes}} </td>
                            </tr>
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.admin.includes.templates.footer')
</div>
@endsection

