@extends('layouts.admin.app')
@section('title', 'Invoice')
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
                        <h5 class="card-title m-b-0 align-self-center">Add Invoice</h5>
                        <div class="ml-auto text-light-blue">
                            <ul class="nav nav-tabs customtab default-customtab list-inline text-uppercase lp-5 font-medium font-12" role="tablist">
                            </ul>
                        </div>
                    </div>
                    <form action="{{url('/admin/invoice')}}" method="POST" enctype="multipart/form-data" id="invoice-form">
                        @csrf
                        <div class="form-group">
                            <!-- <label for="DocNumber">Document Number:</label> -->
                            <input type="hidden" class="form-control" id="DocNumber" name="DocNumber" value="{{old('DocNumber')}}" placeholder="Document Number">
                            @error('DocNumber')
                            <p class="error-message">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="
                            customer">Customer: <span class="text-danger">*</span></label>
                            <select name="customer" class="form-control" id="cust" value="{{old('customer')}}">
                                 <option disabled="" selected="">Select Customer</option>
                                @foreach($customers as $customer)
                                        @if(isset($customer->PrimaryEmailAddr->Address))
                                            @php $user = \App\model\User::where('email',$customer->PrimaryEmailAddr->Address)->first();@endphp
                                        @if(isset($user))
                                    @if(isset($customer->DisplayName) && isset($customer->Id))
                                    <option  value="{{$customer->Id}}"  {{old ('customer') == $customer->Id ? 'selected' : ''}}>{{$customer->DisplayName}}</option>
                                    @else
                                    <option>NA</option>
                                    @endif
                                    @endif
                                    @endif
                                    
                                @endforeach
                            </select>
                                @error('customer')
                                <p class="error-message">{{ $message }}</p>
                                @enderror
                                @foreach($customers as $key => $customer)
                                    @if(isset($customer->Id) && ($customer->Active='true'))
                                    <input type="text" name="" id="{{$customer->Id}}" value="{{(isset($customer->PrimaryEmailAddr->Address)? $customer->PrimaryEmailAddr->Address:'')}}" hidden>
                                    @endif
                                @endforeach
                        </div>
                         <div class="form-group">
                            <label for="email">Email: <span class="text-danger">*</span></label>
                            <input class="form-control" id="email" name="email" rows="3" placeholder="Email" readonly value="{{old('email')}}">
                            @error('email')
                            <p class="error-message">{{ $message }}</p>
                            @enderror
                        </div>
                        <h5>Billing Address</h5>
                        <div class="row form-group">
                            <div class="col-6">
                                <label for="country">Country: <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="billing_country" name="billing_country"  placeholder="country" value="{{old('billing_country')}}">
                                @error('billing_country')
                                <p class="error-message">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-6">
                                <label for="city">City: <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="billing_city" name="billing_city"  placeholder="City" value="{{old('billing_city')}}">
                                @error('billing_city')
                                <p class="error-message">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>      
                        <div class="row form-group">
                            <div class="col-6">
                                <label for="line1">Line1: <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="billing_line1" name="billing_line1"  placeholder="line1" value="{{old('billing_line1')}}">
                                @error('billing_line1')
                                <p class="error-message">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-6">
                                <label for="postal_code">Postal Code: <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="billing_postal_code" name="billing_postal_code"  placeholder="Postal Code" value="{{old('billing_postal_code')}}">
                                @error('billing_postal_code')
                                <p class="error-message">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <h5>Shipping Address</h5>
                        <div class="row form-group">
                            <div class="col-6">
                                <label for="country">Country: <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="shipping_country" name="shipping_country"  placeholder="Country" value="{{old('shipping_country')}}">
                                @error('shipping_country')
                                <p class="error-message">{{ $message }}</p>
                                @enderror
                            </div>
                             <div class="col-6">
                                <label for="city">City: <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="shipping_city" name="shipping_city"  placeholder="City" value="{{old('shipping_city')}}">
                                @error('shipping_city')
                                <p class="error-message">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-6">
                                <label for="line1">Line1: <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="shipping_line1" name="shipping_line1"  placeholder="Line1" value="{{old('shipping_line1')}}">
                                @error('shipping_line1')
                                <p class="error-message">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-6">
                                <label for="postal_code">Postal Code: <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="shipping_postal_code" name="shipping_postal_code"  placeholder="Postal Code" value="{{old('shipping_postal_code')}}">
                                @error('shipping_postal_code')
                                <p class="error-message">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="row form-group">
                               <div class="col-4">
                                <label for="product">Product/Serivce: <span class="text-danger">*</span></label>
                                <select name="product" class="form-control" id="product" value="{{old('product')}}">
                                    <!-- <option disabled="" selected="">Select Product</option> -->
                                    @foreach($products as $product)
                                        <option value="{{$product->Id}}" >{{$product->Name}}</option>
                                    @endforeach
                                </select>
                                @error('product')
                                <p class="error-message">{{ $message }}</p>
                                @enderror   
                                 @foreach($products as $product)
                                    <input type="hidden" id="{{$product->Id}}" value="{{$product->UnitPrice}}">
                                @endforeach
                            </div>
                            <div class="col-4">
                                <label for="Shipping Date">Shipping Date: <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" id="shipping_date" name="shipping_date"  placeholder="Shipping Date" value="{{old('shipping_date')}}" min="<?= date('Y-m-d'); ?>">
                                @error('shipping_date')
                                <p class="error-message">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-4">
                                <label for="Due Date">Due Date: <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" id="due_date" name="due_date"  placeholder="Due Date" value="{{old('due_date')}}" min="<?= date('Y-m-d'); ?>">
                                @error('due_date')
                                <p class="error-message">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-6">
                                <label for="unit_price">Unit Price: <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="unit_price" name="unit_price"  placeholder="Unit Price" readonly="" value="{{old('unit_price')}}">
                                @error('unit_price')
                                <p class="error-message">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-6">
                                <label for="qty">Qty: <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="qty" name="qty"  placeholder="Quntity" value="{{old('qty')}}">
                                @error('qty')
                                <p class="error-message">{{ $message }}</p>
                                @enderror
                            </div>
                          <!--    <div class="col-4">
                                <label for="qty">Tax:(Tax in %) <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="tax" name="tax"  placeholder="Tax">
                                @error('tax')
                                <p class="error-message">{{ $message }}</p>
                                @enderror
                            </div> -->
                        </div>
                        <div class="form-group">
                            <label for="description">Description:</label>
                            <input type="text" class="form-control" id="description" name="description"  placeholder="Description" value="{{old('description')}}">
                            @error('description')
                            <p class="error-message">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-2 float-right">
                            <label for="TotalAmt">Total Amount: </label>
                            <input type="number" class="form-control text-secandary " value="{{old('TotalAmt')}}" id="TotalAmt" name="TotalAmt"  placeholder="00.00" readonly="">
                            @error('TotalAmt')
                            <p class="error-message">{{ $message }}</p>
                            @enderror
                        </div>
                        <br>
                        <br>
                        <br>
                        <br>
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
    $(document).ready(function () {
        var selectedProduct = $("#product").val();
       $('#product option').each(function() {
            if($(this).is(':selected')){
                var pro=$(this).val();
                var price = $('#'+pro).val();
                $('#unit_price').val(price);
            }
        });
    });
    $('#cust').on('change',function(){
       var cus =  $('#cust').val();
       var email = $('#'+cus).val();
       $('#email').val(email);
    })
      $('#product').on('change',function(){
       var pro =  $('#product').val();
       var price = $('#'+pro).val();
       $('#unit_price').val(price);
       change();
    })

    function change(){
        var unit_price=$('#unit_price').val();
        var qty=$('#qty').val();
        var totalVal=(qty * unit_price);
        $('#TotalAmt').val(totalVal); 
    }


    $('#unit_price').on('keyup change',function(){
        change();
    });
    $('#qty').on('change keyup',function(){
        change();
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
<script type="text/javascript">
    $("#cust").change(function() {
  var Text = $(this).val();
  Text = Text.toLowerCase();
  Text = Text.replace(/[^a-zA-Z0-9]+/g,'-');
  $("#DocNumber").val(Text);        
});
</script>
<script src="{{asset('plugins/vendors/styleswitcher/jQuery.style.switcher.js')}}"></script>
<script src="{{ asset('https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js') }}"></script>
@endpush
