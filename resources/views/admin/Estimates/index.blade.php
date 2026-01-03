@extends('layouts.admin.app')
@section('title', 'Estimate')
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
                        <h5 class="card-title m-b-0 align-self-center">estimates</h5>
                        <div class="ml-auto text-light-blue">
                            <ul class="nav nav-tabs customtab default-customtab list-inline text-uppercase lp-5 font-medium font-12" role="tablist">
                                <li>
                                    <a href="{{url('admin/estimate/create/')}}" class="btn waves-effect waves-light btn-rounded btn-primary">Add estimate</a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    @if($estimates)
                    <div class="table-responsive m-t-10">
                        <table id="myTable" class="table color-table table-bordered product-table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Doc_NO</th>
                                    <th>Email</th>
                                    <th>City</th>
                                    <th>Qty</th>
                                    <th>Unit Price</th>
                                    <th>Amount</th>
                                    <th>Total Amount</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(is_array($estimates) || is_object($estimates)) 
                                    @foreach($estimates as $key => $estimate)
                                    <tr>
                                        <td>{{ $key +1 }}</td>
                                        <td>{{ $estimate->DocNumber }}</td>
                                        <td>{{ $estimate->BillEmail->Address }}</td>
                                        @if($estimate->Line[1]->Description)
                                        <td>{{ $estimate->Line[1]->Description }}</td>
                                        @else
                                        <td>Not found</td>
                                        @endif
                                        <td>{{$estimate->Line[0]->SalesItemLineDetail->Qty}}</td>
                                        <td>{{$estimate->Line[0]->SalesItemLineDetail->UnitPrice}}</td>
                                        <td>{{$estimate->Line[0]->Amount}}</td>
                                        <td>{{ $estimate->TotalAmt }}</td>
                                         <td class="text-center">
                                            <a href="{{ url('/admin/estimate-pdf/'.$estimate->Id) }}" target="_blank"><i class="fas fa-file"></i></a>
                                            <a href="{{ url('/admin/estimate/'.$estimate->Id.'/edit/') }}"><i class="fas fa-edit"></i></a>
                                             <form style="display: inline-block;" method="POST" action="{{ url('/admin/estimate',$estimate->Id) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button onclick='return confirm("Confirm delete?")' style="border: none;outline: none;padding:0;background: #fff;" type="submit"><i class="fas fa-trash-alt text-danger"></i></button>
                                            </form>
                                        </td>
                                    </tr>
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
