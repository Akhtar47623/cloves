@extends('layouts.admin.app')
@section('title', 'Orders')
@push('before-css')
<link href="{{asset('plugins/vendors/morrisjs/morris.css')}}" rel="stylesheet">
<link href="{{asset('plugins/vendors/c3-master/c3.min.css')}}" rel="stylesheet">
<link href="{{asset('plugins/vendors/toast-master/css/jquery.toast.css')}}" rel="stylesheet">
<link href="{{asset('plugins/vendors/vectormap/jquery-jvectormap-2.0.2.css')}}" rel="stylesheet"/>
<link href="{{asset('plugins/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('assets/css/pages/google-vector-map.css')}}" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<style type="text/css">
    select#delivery_status {
        background: #fff7f7;
        border-radius: 3px;
    }
</style>
@endpush
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
           <!--          <div class="csv-guidlines mb-4">
                        <p>"<b>Delivery Type</b>" and "<b>Priority</b>" in the CSV file should be specified as (D or P or T),(H or M or L) respectively.<br>All <b>Fields</b> are required in <b>CSV </b>Form.</p>
                    </div> -->
                    <div class="d-flex m-b-10 no-block">
                        <h5 class="card-title m-b-0 align-self-center">Orders Detail</h5>
                        <div class="ml-auto text-light-blue">
                            <ul class="nav nav-tabs customtab default-customtab list-inline text-uppercase lp-5 font-medium font-12" role="tablist">
                                  <li>
                                    <form action="{{ url('admin/order-import') }}" method="POST" id="doc" enctype="multipart/form-data">
                                        @csrf
                                        <div class="import">
                                            <input type="file" id="import" name="file" class="" value="Import All Orders">
                                        <a class="text-white" >Import Batch Orders</a>
                                        </div>
                                    </form>
                                </li>
                                <li>
                                    <a class="btn btn-success" href="{{ url('export/order?').rand() }}">Download Form</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    @if(auth()->user()->hasRole('admin'))
                    @if($orders)
                    <div class="table-responsive m-t-10">
                        <!-- <a class="btn btn-success" href="{{url('admin/order/add/')}}" role="button">Add FAQ</a> -->

                        <table id="myTable" class="table color-table table-bordered product-table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Order#</th>
                                    <!-- <th>Order Type</th> -->
                                    <th>Full Name</th>
                                    <th>Product</th>
                                    <th>Email</th>
                                    <th>Country</th>
                                    <!-- <th>City</th> -->
                                    <!-- <th>Org</th> -->
                                    <!-- <th>date</th> -->
                                    <th>status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $key => $order)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$order->order_id}}</td>
                               <!--      @if($order->order_type=='D')
                                    <td>Delivery</td>
                                    @endif -->
                                 <!--    @if($order->order_type=='T')
                                    <td>Task</td>
                                    @endif
                                    @if($order->order_type=='P')
                                    <td>Pickup</td>
                                    @endif -->
                                    <td>{{$order->full_name}}</td>
                                    @if($order->product != null)
                                    <td>{{$order->product}}</td>
                                    @else
                                    <td>NA</td>
                                    @endif
                                    <td>{{$order->email}}</td>
                                    @if(isset($order->country))
                                    <td>{{$order->country}}</td>
                                    @else
                                    <td>NA</td>
                                    @endif
                                    <td>
                                        @if($order->delivery_status =='delivered')
                                        <span class="badge badge-success float-right">delivered</span>
                                        @elseif($order->delivery_status=='dispatched')
                                        <span class="badge badge-info float-right">dispatched</span>
                                        @else
                                        <span class="badge badge-danger float-right">pending</span>
                                        @endif
                                        <form id="form-{{$order->order_id}}" method="POST" action="{{url('/admin/order/'.$order->order_id)}}">
                                        <input type="hidden" name="hiddenId" value="{{$order->order_id}}">
                                        @csrf
                                        @method('put')
                                            <select name="delivery_status"  onchange="submit();"  id="delivery_status">
                                                <option value="pending" selected="" {{$order->delivery_status=='pending'?'selected':''}}>Pending</option>
                                                <option value="delivered" {{$order->delivery_status=='delivered'?'selected':''}}>Delivered</option>
                                                <option value="dispatched" {{$order->delivery_status=='dispatched'?'selected':''}}>Dispatched</option>
                                            </select>
                                        </form>
                                    </td>
                             <!--        @if(isset($order->city))
                                    <td>{{$order->city}}</td>
                                    @endif -->
                             <!--        @if(isset($order->organization))
                                    <td>{{$order->organization}}</td>
                                    @else
                                    <td>NA</td>
                                    @endif -->
                                  <!--   <td>{{$order->date}}</td> -->
                                    <!-- @if($order->status == '0')
                                    <td><span class="badge badge-warning p-2"> Pending</span></td>
                                    @endif
                                    @if($order->status == '1')
                                    <td><span class="badge badge-success p-2">Success</span></td>
                                    @endif -->
                                    <td class="text-center">

                                        @if(auth()->user()->hasRole('admin'))
                                        <form style="display: inline-block;" method="POST" action="{{ url('/admin/order/create') }}">
                                         @csrf
                                            <input type="" name="order_id" value="{{$order->order_id}}" hidden="">
                                            <input type="" name="full_name" value="{{$order->full_name}}" hidden="">
                                            <input type="" name="organization" value="{{$order->organization}}" hidden="">
                                            <input type="" name="order_type" value="{{$order->order_type}}" hidden="">
                                            <input type="" name="priority" value="{{$order->priority}}" hidden="">
                                            <input type="" name="location" value="{{$order->location}}" hidden="">
                                            <input type="" name="date" value="{{$order->current_date}}" hidden="">
                                            <input type="" name="timeFrom" value="{{$order->time_from}}" hidden="">
                                            <input type="" name="timeTo" value="{{$order->time_to}}" hidden="">
                                            <input type="" name="duration" value="{{$order->duration}}" hidden="">
                                            <input type="" name="boxes" value="{{$order->boxes}}" hidden="">
                                            <input type="" name="notes" value="{{$order->notes}}" hidden="">
                                             <input type="" name="longitude" value="{{$order->langitude}}" hidden="" >
                                              <input type="" name="latitude" value="{{$order->latitude}}" hidden="" >
                                            @if($order->status =="0")
                                            <button  onclick='return confirm("Confirm Order?")'  style="border: none;outline: none;padding:0;background: #fff;" type="submit"><span class="badge badge-warning p-2">Place Order</span></button>
                                            @endif
                                            @if($order->status =="1")
                                             <button style="border: none;outline: none;padding:0;background: #fff;" type="submit"><span class="badge badge-success p-1">Order Created</span></button>
                                             @endif

                                        </form>
                                        <a href="{{ url('/admin/order',$order->order_id) }}">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ url('/admin/order/'.$order->id.'/edit/') }}">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        </span>
                                         <form style="display: inline-block;" method="POST" action="{{ url('/admin/order',$order->order_id) }}">
                                         @csrf
                                            @method('DELETE')
                                            <button onclick='return confirm("Confirm delete?")' style="border: none;outline: none;padding:0;background: #fff;" type="submit"><i class="fas fa-trash-alt text-danger "></i></button>
                                        </form>
                                        @elseif(auth()->user()->hasRole('user'))
                                        <a href="{{ url('/user/order',$order->order_id) }}"><i class="fas fa-eye"></i></a>
                                        <!-- <form style="display: inline-block;" method="POST" action="{{ url('/user/order',$order->order_id) }}"> -->
                                        @endif
                                             
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @endif
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
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('#import').change(function(){
            $('#doc').submit();
        });
    });

  @if(Session::has('warning'))
  toastr.options =
  {
    "closeButton": true,
    "debug": false,
    "newestOnTop": false,
    "progressBar": true,
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": "300",
    "hideDuration": "1000",
    "timeOut": "10000",
    "extendedTimeOut": "6000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
  }
  toastr.warning("{{ session('warning') }}");
  @endif
    $(function () {
        $('#myTable').DataTable();
        var table = $('#example').DataTable({
            "columnDefs": [{
                "visible": false,
                "targets": 2
            }],
            "order": [

            [2, 'asc']

            ],
            "displayLength": 18,
            "drawCallback": function (settings) {
                var api = this.api();
                var rows = api.rows({
                    page: 'current'
                }).nodes();
                var last = null;
                api.column(2, {
                    page: 'current'
                }).data().each(function (group, i) {
                    if (last !== group) {
                        $(rows).eq(i).before('<tr class="group"><td colspan="5">' + group + '</td></tr>');
                        last = group;
                    }
                });
            }
        });
        $('#example tbody').on('click', 'tr.group', function () {
            var currentOrder = table.order()[0];
            if (currentOrder[0] === 2 && currentOrder[1] === 'asc') {
                table.order([2, 'desc']).draw();
            }
            else {
                table.order([2, 'asc']).draw();
            }
        });
    });
    $('#example23').DataTable({
        dom: 'Bfrtip',
        buttons: [
        'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });

    $('.order_status').change(function(){
        var value = $(this).val();

        // var order_number = $(this).closest('tr');
        var row = $("selected td:nth-child(2)").html();
        console.log(row);
    })
</script>
<script src="{{asset('plugins/vendors/styleswitcher/jQuery.style.switcher.js')}}"></script>

@endpush
