@extends('layouts.admin.app')
@section('title', 'Invoice')
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
                        <h5 class="card-title m-b-0 align-self-center">Invoices</h5>
                        <div class="ml-auto text-light-blue">
                            <ul class="nav nav-tabs customtab default-customtab list-inline text-uppercase lp-5 font-medium font-12" role="tablist">
                                <li>
                                    <a class="btn waves-effect waves-light btn-rounded btn-success" href="{{ route('invoiceExport') }}">Export Invoices</a>
                                    <a href="{{url('admin/invoice/create/')}}" class="btn waves-effect waves-light btn-rounded btn-primary">Add Invoice</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    @if(Auth::check())
                    @if($invoices)
                        
                    <table>
                        <tbody>
                            <tr>
                                <td>
                                    <select class="select-filter" name="filterData" id="filter-by-date">
                                        <option value="All">All</option>
                                        <option value="<?= date('Y-m-d')?>">Today</option>
                                        <option value="<?= date("Y-m-d", strtotime("yesterday"))?>">Yesterday</option>
                                        <option value="<?= date("Y-m-d", strtotime('1 weeks ago'))?>">This Week</option>
                                        <option value="<?= date("Y-m-d", strtotime('2 weeks ago'))?>">Last Week</option>
                                        <option value="This Month">This Month</option>
                                        <option value="Last Month">Last Month</option>
                                        <option value="This Year">This Year</option>
                                        <option value="Last Year">Last Year</option>
                                        <option value="Last 10 Years">Last 10 Years</option>
                                    </select>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="table-responsive m-t-10">
                        <!-- <a class="btn btn-success" href="{{url('admin/order/add/')}}" role="button">Add FAQ</a> -->

                        <table id="myTable" class="table color-table table-bordered product-table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Doc_NO</th>
                                    <th>Item</th>
                                    <th>Customer</th>
                                    <th>Org</th>
                                    <th>Email</th>
                                    <th>Total Amount</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody id="show_all">
                                @foreach($customers as $customer)
                                <!-- <td>{{$customer->Id}}</td> -->
                                @endforeach
                                @if(is_array($invoices) || is_object($invoices)) 
                                    @foreach($invoices as $key => $invoice)
                                    <tr>
                                        <td>{{ $key +1 }}</td>
                                        <td>{{ $invoice->DocNumber }}</td>

                                        @foreach($items as $item)
                                            @if($invoice->Line[0]->SalesItemLineDetail->ItemRef == $item->Id)
                                            <td>{{$item->Name}}</td>
                                            @endif
                                        @endforeach

                                        @foreach($customers as $customer)
                                        @if($invoice->CustomerRef == $customer->Id && $customer->Active == 'true')
                                        <td>{{$customer->DisplayName }}</td>  
                                        @endif
                                        @endforeach
                                        @foreach($customers as $customer)
                                        @if($invoice->CustomerRef == $customer->Id)
                                            @if(isset($customer->CompanyName))
                                            <td>{{ $customer->CompanyName }}</td> 
                                            @else
                                            <td>NA</td> 
                                            @endif
                                        @endif
                                        @endforeach
                                         @if(isset($invoice->BillEmail))
                                        <td>{{ $invoice->BillEmail->Address }}</td>
                                        @else
                                        <td>NA</td>
                                        @endif
                                     <!--    @if(isset($invoice->BillAddr->City))
                                        <td>{{ $invoice->BillAddr->City }}</td>
                                        @else
                                        <td>NA</td>
                                        @endif -->
                                        <td>{{ $invoice->TotalAmt }}</td>
                                         <td class="text-center">
                                            <a href="{{ url('/admin/invoice/'.$invoice->Id) }}"><i class="fas fa-eye"></i></a>
                                            <a href="{{ url('/admin/invoice/'.$invoice->Id.'/edit/') }}"><i class="fas fa-edit"></i></a>
                                             <form style="display: inline-block;" method="POST" action="{{ url('/admin/invoice',$invoice->Id) }}">
                                                @csrf
                                                @method('DELETE')
                                                <input type="hidden" name="SyncToken" value="{{$invoice->SyncToken}}">
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
       $('#filter-by-date').on('change keyup',function() {
            dateFilter=$(this).val();
            $.ajax({
              url: "{{ route('invoiceFilter') }}",
              type:"POST",
              data:{
                "_token": "{{ csrf_token() }}",
                dateFilter:dateFilter,
              },
              success:function(response){
                $('#show_all').html(response);
           
              },
              error: function(response) {
              }
              });
    });
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
