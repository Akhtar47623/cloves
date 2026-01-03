@extends('layouts.admin.app')
@section('title', 'Estimate')
@push('before-css')
<link href="{{asset('plugins/vendors/morrisjs/morris.css')}}" rel="stylesheet">
<link href="{{asset('plugins/vendors/c3-master/c3.min.css')}}" rel="stylesheet">
<link href="{{asset('plugins/vendors/toast-master/css/jquery.toast.css')}}" rel="stylesheet">
<link href="{{asset('plugins/vendors/vectormap/jquery-jvectormap-2.0.2.css')}}" rel="stylesheet"/>
<link href="{{asset('plugins/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css')}}" rel="stylesheet"type="text/css"/>
<link href="{{asset('assets/css/pages/google-vector-map.css')}}" rel="stylesheet">
<link href="{{ asset('https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css') }}" rel="stylesheet">
<style type="text/css">
    p.error-message {
        color: #df0a0a;
        font-weight: 500;
        font-size: 14px;
    }
</style>
@endpush
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex m-b-10 no-block">
                        <h5 class="card-title m-b-0 align-self-center">Add Estimate</h5>
                        <div class="ml-auto text-light-blue">
                            <ul class="nav nav-tabs customtab default-customtab list-inline text-uppercase lp-5 font-medium font-12" role="tablist">
                            </ul>
                        </div>
                    </div>
                    <form action="{{url('/admin/estimate')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="
                            customer">Customer:</label>
                            <select name="customer" class="form-control">
                                @foreach($customers as $customer)
                                    @if(isset($customer->DisplayName) && isset($customer->BillAddr->Id))
                                    <option  value="{{$customer->BillAddr->Id}}" selected="">{{$customer->DisplayName}}</option>
                                    @else
                                    <option>Please Add Customer before creating estimate.</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input class="form-control" id="news_dcription" name="email" rows="3" placeholder="Email">
                            @error('email')
                            <p class="error-message">**{{ $message }}</p>
                            @enderror
                        </div>
                        <h5>Billing Address</h5>
                        <div class="row form-group">
                            <div class="col-6">
                                <label for="country">Country:</label>
                                <input type="text" class="form-control" id="billing_country" name="billing_country"  placeholder="country">
                                @error('billing_country')
                                <p class="error-message">**{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-6">
                                <label for="city">City:</label>
                                <input type="text" class="form-control" id="billing_city" name="billing_city"  placeholder="City">
                                @error('billing_city')
                                <p class="error-message">**{{ $message }}</p>
                                @enderror
                            </div>
                        </div>      
                        <div class="row form-group">
                            <div class="col-6">
                                <label for="line1">Line1:</label>
                                <input type="text" class="form-control" id="billing_line1" name="billing_line1"  placeholder="line1">
                                @error('billing_line1')
                                <p class="error-message">**{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-6">
                                <label for="postal_code">Postal Code:</label>
                                <input type="text" class="form-control" id="billing_postal_code" name="billing_postal Code"  placeholder="Postal Code">
                                @error('billing_postal_code')
                                <p class="error-message">**{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <h5>Shipping Address</h5>
                        <div class="row form-group">
                            <div class="col-6">
                                <label for="country">Country:</label>
                                <input type="text" class="form-control" id="shipping_country" name="shipping_country"  placeholder="Country">
                                @error('shipping_country')
                                <p class="error-message">**{{ $message }}</p>
                                @enderror
                            </div>
                             <div class="col-6">
                                <label for="city">City:</label>
                                <input type="text" class="form-control" id="shipping_city" name="shipping_city"  placeholder="City">
                                @error('shipping_city')
                                <p class="error-message">**{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-6">
                                <label for="line1">Line1:</label>
                                <input type="text" class="form-control" id="shipping_line1" name="shipping_line1"  placeholder="Line1">
                                @error('shipping_line1')
                                <p class="error-message">**{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-6">
                                <label for="postal_code">Postal Code:</label>
                                <input type="text" class="form-control" id="shipping_postal_code" name="shipping_postal_code"  placeholder="Postal Code">
                                @error('shipping_postal_code')
                                <p class="error-message">**{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="product">Product/Serivce:</label>
                            <input type="text" class="form-control" id="product" name="product"  placeholder="Product">
                            @error('product')
                            <p class="error-message">**{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="row form-group">
                            <div class="col-4">
                                <label for="unit_price">Unit Price:</label>
                                <input type="text" class="form-control" id="unit_price" name="unit_price"  placeholder="unit_price">
                                @error('unit_price')
                                <p class="error-message">**{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-4">
                                <label for="rate">Rate:</label>
                                <input type="number" class="form-control" id="rate" name="rate"  placeholder="rate">
                                @error('rate')
                                <p class="error-message">**{{ $message }}</p>
                                @enderror
                            </div>
                             <div class="col-4">
                                <label for="qty">Qty:</label>
                                <input type="number" class="form-control" id="qty" name="qty"  placeholder="qty">
                                @error('qty')
                                <p class="error-message">**{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="total_amount">Total Amount:</label>
                            <input type="number" class="form-control" id="total_amount" name="total_amount"  placeholder="Total Amount">
                            @error('total_amount')
                            <p class="error-message">**{{ $message }}</p>
                            @enderror
                        </div>
                         <div class="form-group">
                            <label for="description">Description:</label>
                            <input type="text" class="form-control" id="description" name="description"  placeholder="Description">
                            @error('description')
                            <p class="error-message">**{{ $message }}</p>
                            @enderror
                        </div>
                        <button class="btn btn-success pull-center" type="submit">Add</button>
                    </form>
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
        // Order by the grouping
        $('#example tbody').on('click', 'tr.group', function () {
            var currentOrder = table.order()[0];
            if (currentOrder[0] === 2 && currentOrder[1] === 'asc') {
                table.order([2, 'desc']).draw();
            } else {
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
</script>
<script>
    $(document).ready(function(){
        $('#news_description').summernote({
            placeholder: 'Type News Details',
            tabsize: 2,
            height: 100
        });
    });

</script>
<script src="{{asset('plugins/vendors/styleswitcher/jQuery.style.switcher.js')}}"></script>
<script src="{{ asset('https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js') }}"></script>
@endpush
