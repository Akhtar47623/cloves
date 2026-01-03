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
                    @if(auth()->user()->hasRole('user'))
                    <a href="{{url('/user/order')}}" class="btn waves-effect waves-light btn-rounded btn-primary float-right">Back</a>
                    @elseif(auth()->user()->hasRole('admin'))
                    <a href="{{url('/admin/order')}}" class="btn waves-effect waves-light btn-rounded btn-primary float-right">Back</a>
                    @elseif(auth()->user()->hasRole('vendor'))
                    <a href="{{url('/vendor/order')}}" class="btn waves-effect waves-light btn-rounded btn-primary float-right">Back</a>
                    @endif

                    <div class="clearfix"></div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table">
                            <tbody>
                            <tr>
                                <th><h4>Customer Information</h4></th>
                            </tr>
                            <tr>
                                <th>Full Name</th>
                                <td>{{$user_orders->full_name}}</td>
                               <!--  <th>Last Name</th>
                                <td>{{$user_orders->last_name}}</td> -->
                            </tr>
                            @if($user_orders->email != null)
                            <tr>
                                <th>Mail Address</th>
                                <td>{{$user_orders->email}} </td>
                                @if(isset($user_orders->organization))
                                <th>Organization</th>
                                <td>{{$user_orders->organization}} </td>
                                @endif
                            </tr>
                            @endif
                            <tr>
                                @if($user_orders->country != null)
                                    <th>Country</th>
                                    <td>{{$user_orders->country}} </td>
                                @endif
                                @if($user_orders->country != null)
                                    <th>City</th>
                                    <td>{{$user_orders->city}} </td>
                                @endif
                            </tr>
                          <!--   <tr>
                                <th>Customer Location</th>
                                <td>{{$user_orders->location}} </td>
                            </tr> -->
                            <tr><th><hr><th></tr>
                            <tr>
                                <th><h4>Order Information</h4></th>
                            </tr>
                            <tr>
                                <th>Date</th>
                                <td>{{$user_orders->current_date}} </td>
                             <!--    <th>Status</th>
                                @if($user_orders->status=='1')
                                <td><span class="badge badge-success">Order Placed</span></td>
                                @endif
                                @if($user_orders->status=='0')
                                <td><span class="badge badge-warning">Order Pending</span></td>
                                @endif -->
                                <th>Order Id</th>
                                <td>{{$user_orders->order_id}}</td>
                            </tr>
                            
                            <tr>
                                @if($user_orders->product != null)
                                <th>Product :</th>
                                <td>{{$user_orders->product}}</td>
                                @endif
                                @if($user_orders->order_type != null)  
                                    <th>Order Type : </th>
                                    @if($user_orders->order_type == 'D')
                                        <td>Delivery</td>
                                    @endif
                                    @if($user_orders->order_type == 'T')
                                        <td>Task</td>
                                    @endif
                                    @if($user_orders->order_type == 'P')
                                        <td>Pickup</td>
                                    @endif
                                @endif
                            </tr>                              
                            <tr>
                                <th>Priority : </th>
                                @if($user_orders->priority =='H')
                                <td>High</td>
                                @endif
                                @if($user_orders->priority =='M')
                                <td>Medium</td>
                                @endif
                                @if($user_orders->priority =='L')
                                <td>Low</td>
                                @endif
                                <th>Time Windows</th>
                                <td>
                                    {{$user_orders->time_from}} - {{$user_orders->time_to}}
                                </td>
                                
                            </tr>
                            <tr>
                                <th>Boxes  </th>
                                <td>{{$user_orders->boxes}}</td>
                                <th>Uploading Duration</th>
                                <td>{{$user_orders->duration}} minutes</td>
                            </tr>
                            </tbody>
                        </table>
                        <div class="table-responsive">
                        <table class="table table">
                            <tbody>
                                <tr>
                                <th>Location</th>
                                <td>{{$user_orders->location}}</td>
                            </tr>
                            <!-- <tr>
                                <th>Delivery Location </th>
                                <td>{{$user_orders->delivery_location}}</td>
                            </tr> -->
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

