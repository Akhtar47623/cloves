@extends('layouts.admin.app')
@section('title', 'Orders-Error')
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
                        <h5 class="card-title m-b-0 align-center">Errors occur in Order Form Please Try Again!</h5>
                        <div class="ml-auto text-light-blue">
                             <ul class="nav nav-tabs customtab default-customtab list-inline text-uppercase lp-5 font-medium font-12" role="tablist">
                                @if(auth()->user()->hasRole('user'))
                                <a href="{{url('/user/order')}}" class="btn waves-effect waves-light btn-rounded btn-primary float-right">Back</a>
                                @elseif(auth()->user()->hasRole('admin'))
                                <a href="{{url('/admin/order')}}" class="btn waves-effect waves-light btn-rounded btn-primary float-right">Back</a>
                                @elseif(auth()->user()->hasRole('vendor'))
                                <a href="{{url('/vendor/order')}}" class="btn waves-effect waves-light btn-rounded btn-primary float-right">Back</a>
                                @endif
                            </ul>
                        </div>
                    </div>
                    @if($failures)
                    <div class="table-responsive m-t-10">
                        <table id="myTable" class="table color-table table-bordered product-table table-hover">
                            <tbody>
                                @foreach($failures as $key => $failure)
                                @foreach($failure->errors() as $error)
                                <tr>
                                    <td class="bg-danger text-white">Error#{{$key + 1}} - {{$error}} at line no {{$failure->row()}}.</td>
                                </tr>
                                @endforeach
                                @endforeach
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
<script type="text/javascript">
    $(document).ready(function(){
        $('#import').change(function(){
            $('#doc').submit();
        });
    });
</script>
<script>
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
