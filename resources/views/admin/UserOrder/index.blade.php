@extends('layouts.admin.app')
@section('title', 'Orders')
@push('before-css')
<link href="{{asset('plugins/vendors/morrisjs/morris.css')}}" rel="stylesheet">
<link href="{{asset('plugins/vendors/c3-master/c3.min.css')}}" rel="stylesheet">
<link href="{{asset('plugins/vendors/toast-master/css/jquery.toast.css')}}" rel="stylesheet">
<link href="{{asset('plugins/vendors/vectormap/jquery-jvectormap-2.0.2.css')}}" rel="stylesheet"/>
<link href="{{asset('plugins/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('assets/css/pages/google-vector-map.css')}}" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/5.0.7/sweetalert2.min.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

<style type="text/css">
  /*.text-center{
  margin-top: 140px;
}*/
.modal{
    background-color: rgba(0,0,0,0) !important;
}
.modal-content {
    background: darkslategrey !important;
}
button.close {
    border: none !important;
    right: 40px !important;
    top: 25px !important;

}
.modal-body{
    padding:0px 50px 31px 50px !important;
}
.csv-guidlines p {
    text-transform: initial;
}
.csv-guidlines{
    padding:0px 0px 0px 0px !important;

}
.modal-header{
    justify-content: center !important; 
}
</style>
@endpush

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                                <!-- <div class="csv-guidlines mb-4">
                                    <p>"<b>Delivery Type</b>" in the CSV file should be specified as (D or P or T).<br>All <b>Fields</b> are required in <b>CSV </b>Form.</p>
                                </div> -->
                    <div class="d-flex m-b-10 no-block">
                        <h5 class="card-title m-b-0 align-self-center">Orders Detail</h5>
                        <div class="ml-auto text-light-blue">
                            <ul class="nav nav-tabs customtab default-customtab list-inline text-uppercase lp-5 font-medium font-12" role="tablist">
                                <li>
                                    @if(auth()->user()->hasRole('user'))
                                    <form action="{{url('user/import-orders')}}" method="POST" id="userDoc" enctype="multipart/form-data">
                                    @elseif(auth()->user()->hasRole('vendor'))
                                    <form action="{{url('vendor/import-orders')}}" method="POST" id="userDoc" enctype="multipart/form-data">
                                    @endif
                                        @csrf
                                        <div class="import">
                                        <a class="text-white button" data-toggle="modal" data-target="#exampleModal" >Import Batch Orders</a>
                                        </div>
                                           <!-- Modal -->
                                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                          <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <h5 class="modal-title text-white" id="exampleModalLabel">Form Attachment</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                  <span aria-hidden="true">&times;</span>
                                                </button>
                                              </div>
                                              <div class="modal-body">
                                                <div class="csv-guidlines mb-4">
                                                    <p class="text-center">Follow Instructions on the top of order Form  before uploading!</p>
                                                </div>
                                                <input type="file" id="ID12" class="attach_csv" name="upload_file" value="" />
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                        <!-- Modal -->
                                    </form>
                    

                                </li>
                                <li>
                                    <a class="btn btn-success" href="{{asset('uploads/admin/Doc/orders.xlsx?'.rand(0, 99999))}}">Download Form</a>
                                </li>
                                  <li>
                                    @if(auth()->user()->hasRole('user'))
                                    <a href="{{url('user/order/create/')}}" style="border-radius: 5px !important; height: 37px;" class="btn waves-effect waves-light btn-rounded btn-primary">Create Order</a>
                                    @elseif(auth()->user()->hasRole('vendor'))
                                    <a href="{{url('vendor/order/create/')}}" style="border-radius: 5px !important; height: 37px;" class="btn waves-effect waves-light btn-rounded btn-primary">Create Order</a>
                                    @else
                                    <a href="{{url('admin/order/create/')}}" style="border-radius: 5px !important; height: 37px;" class="btn waves-effect waves-light btn-rounded btn-primary">Create Order</a>
                                    @endif
                                </li>
                            </ul>
                        </div>
                    </div>
                    @if(Auth::check())
                        @if($user_orders)
                        <div class="table-responsive m-t-10">
                            <table id="myTable" class="table color-table table-bordered product-table table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Order No</th>
                                        <th>Product</th>
                                        <th>Order Type</th>
                                        <th>Full Name</th>
                                        <th>Email</th>
                                        <th>Delivery date</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($user_orders as $key => $order)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$order->order_id}}</td>
                                        <td>{{$order->product}}</td>
                                        @if(isset($order->order_type))
                                        @if($order->order_type=='D')
                                        <td>Delivery</td>
                                        @endif
                                        @if($order->order_type=='T')
                                        <td>Task</td>
                                        @endif
                                        @if($order->order_type=='P')
                                        <td>Pickup</td>
                                        @endif
                                        @else
                                        <td>not mention</td>
                                        @endif
                                        <td>{{$order->full_name}}</td>
                                        <td>{{$order->email}}</td>
                                        <td>{{$order->current_date}}</td>
                                        @if($order->order_status =='1')
                                        <td>
                                            <span  class="badge badge-success">Order Placed</span>
                                        </td>
                                        @endif
                                        <td class="text-center">
                                            @if(auth()->user()->hasRole('admin'))
                                            <a href="{{ url('/admin/order',$order->order_id) }}"><i class="fas fa-eye"></i></a>
                                            <form style="display: inline-block;" method="POST" action="{{ url('/admin/order',$order->order_id) }}">
                                             @csrf
                                                @method('DELETE')
                                                <button onclick='return confirm("Confirm delete?")' style="border: none;outline: none;padding:0;background: #fff;" type="submit"><i class="fas fa-trash-alt text-danger"></i></button>
                                            </form>
                                            @elseif(auth()->user()->hasRole('vendor'))
                                            <a href="{{ url('/vendor/order',$order->order_id) }}"><i class="fas fa-eye"></i></a>
                                            @elseif(auth()->user()->hasRole('user'))
                                            <a href="{{ url('/user/order',$order->order_id) }}"><i class="fas fa-eye"></i></a>
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
    $(document).on('hide.bs.modal', '#exampleModal', function (e) {
        if ($('#ID12').val() != '') {
            const CancelUploadConfirmation =  false;
            if (!CancelUploadConfirmation) {
                e.preventDefault();
                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: 'btn btn-danger mr-2',
                        cancelButton: 'btn btn-success'
                    },
                    buttonsStyling: false
                })
                swalWithBootstrapButtons.fire({
                    title: 'Are you sure? 🤔',
                    text: "Do you really want to Cancel the Personal Picture Upload?",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, I am! 🥺',
                    cancelButtonText: "No, I'm Not 😊",
                    showClass: {
                        popup: 'animated fadeInDown faster'
                    },
                    hideClass: {
                        popup: 'animated fadeOutUp faster'
                    }
                }).then((CancelConfirmationResult) => {
                    if (CancelConfirmationResult.value) {
                      return CancelUploadConfirmation === true;
                    } else if (CancelConfirmationResult.dismiss === Swal.DismissReason.cancel) 
                    {
                        swalWithBootstrapButtons.fire({
                            title: 'Fantastic 🤗',
                            text: "We are happy 🎉 that you still want to Upload your Own Personal picture!",
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 1800,
                            showClass: {
                                popup: 'animated fadeInDown faster'
                            },
                            hideClass: {
                                popup: 'animated fadeOutUp faster'
                            }
                        })
                    }
                });
            }
        }
    });
</script>
<script>
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
     $(document).ready(function(){
        $('.attach_csv').on('change keyup',function(){
            $('#userDoc').submit();
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
    });
</script>
<script src="{{asset('plugins/vendors/styleswitcher/jQuery.style.switcher.js')}}"></script>
@endpush
