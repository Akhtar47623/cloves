@extends('layouts.admin.app')
@section('title', 'Customer')
@push('before-css')
<link href="{{asset('plugins/vendors/morrisjs/morris.css')}}" rel="stylesheet">
<link href="{{asset('plugins/vendors/c3-master/c3.min.css')}}" rel="stylesheet">
<link href="{{asset('plugins/vendors/toast-master/css/jquery.toast.css')}}" rel="stylesheet">
<link href="{{asset('plugins/vendors/vectormap/jquery-jvectormap-2.0.2.css')}}" rel="stylesheet"/>
<link href="{{asset('plugins/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('assets/css/pages/google-vector-map.css')}}" rel="stylesheet">
@endpush
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex m-b-10 no-block">
                        <h5 class="card-title m-b-0 align-self-center">Customer</h5>
                        <div class="ml-auto text-light-blue">
                            <ul class="nav nav-tabs customtab default-customtab list-inline text-uppercase lp-5 font-medium font-12" role="tablist">
                                <li>
                                    <a href="{{url('admin/customer/create/')}}" class="btn waves-effect waves-light btn-rounded btn-primary">Add Customer</a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    @if($customers)
                    <div class="table-responsive m-t-10">
                        <table id="myTable" class="table color-table table-bordered product-table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Customer Id</th>
                                    <th>Customer Name</th>
                                    <th>Customer Email</th>
                                    <th>Customer Country</th>
                                    <th>Customer City</th>
                                    <!-- <th>Status</th> -->
                                    <!-- <th>City</th> -->
                                    <!-- <th>Total Amount</th> -->
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(is_array($customers) || is_object($customers)) 
                                    @foreach($customers as $key => $customer)
                                    @if(isset($customer->PrimaryEmailAddr->Address))
                                    @php $user = \App\Model\User::where('email',$customer->PrimaryEmailAddr->Address)->first();@endphp
                                        @if(isset($user))
                                        <tr>
                                            <td>{{ $key +1 }}</td>
                                            <!-- <td>{{ $customer->Id }}</td> -->
                                            @if(isset($customer->BillAddr->Id))
                                            <td>{{ $customer->BillAddr->Id}}</td>
                                            @else
                                            <td>Not Found</td>
                                            @endif

                                            <td>{{ $customer->DisplayName }}</td>
                                            @if(isset($customer->BillAddr))
                                            <td>{{ $customer->BillAddr->Country}}</td>
                                            @else
                                            <td>Country Not Found</td>
                                            @endif

                                            @if(isset($customer->BillAddr))
                                            <td>{{ $customer->BillAddr->City}}</td>
                                            @else
                                            <td>City Not Found</td>
                                            @endif

                                            @if(isset($customer->PrimaryEmailAddr->Address))
                                            <td>{{ $customer->PrimaryEmailAddr->Address}}</td>
                                            @else
                                            <td>Email Not Found</td>
                                            @endif

                                            <!-- <td>{{ $customer->Active }}</td> -->
                                             <td class="text-center">
                                                <!-- <a href="{{ url('/admin/customer-pdf/'.$customer->Id) }}" target="_blank"><i class="fas fa-file"></i></a> -->
                                                <a href="{{ url('/admin/customer/'.$customer->Id.'/edit/') }}"><i class="fas fa-edit"></i></a>
                                                 <form style="display: inline-block;" method="POST" action="{{ url('/admin/customer',$customer->Id) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button onclick='return confirm("Confirm delete?")' style="border: none;outline: none;padding:0;background: #fff;" type="submit"><i class="fas fa-trash-alt text-danger"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endif
                                      @else
                                        <!-- <td>Email Not Found</td> -->
                                    @endif
                                        @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @include('layouts.admin.includes.templates.footer')
</div>
@endsection
@push('js')
<script src="{{asset('plugins/vendors/d3/d3.min.js')}}"></script>
<script src="{{asset('plugins/vendors/c3-master/c3.min.js')}}"></script>
<script src="{{asset('plugins/vendors/knob/jquery.knob.js')}}"></script>
<script src="{{asset('plugins/vendors/sparkline/jquery.sparkline.min.js')}}"></script>
<script src="{{asset('plugins/vendors/raphael/raphael-min.js')}}"></script>
<script src="{{asset('plugins/vendors/morrisjs/morris.js')}}"></script>
<script src="{{asset('plugins/vendors/toast-master/js/jquery.toast.js')}}"></script>
<script src="{{asset('plugins/vendors/datatables/jquery.dataTables.min.js')}}"></script>
<script>
    $(function () {
        $('#myTable').DataTable({
            "order": [[ 2, "desc" ]]
        });
    });
</script>
<script src="{{asset('plugins/vendors/styleswitcher/jQuery.style.switcher.js')}}"></script>
@endpush
