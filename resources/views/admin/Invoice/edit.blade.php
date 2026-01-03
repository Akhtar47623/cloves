@extends('layouts.admin.app')
@section('title','Invoice')
@push('before-css')
<link href="{{asset('plugins/vendors/morrisjs/morris.css')}}" rel="stylesheet">
<link href="{{asset('plugins/vendors/c3-master/c3.min.css')}}" rel="stylesheet">
<link href="{{asset('plugins/vendors/toast-master/css/jquery.toast.css')}}" rel="stylesheet">
<link href="{{asset('plugins/vendors/vectormap/jquery-jvectormap-2.0.2.css')}}" rel="stylesheet"/>
<link href="{{asset('plugins/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css')}}" rel="stylesheet"type="text/css"/>
<link href="{{asset('assets/css/pages/google-vector-map.css')}}" rel="stylesheet">
<link href="{{ asset('https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css') }}" rel="stylesheet">
@endpush
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex m-b-10 no-block">
                        <h5 class="card-title m-b-0 align-self-center">Update Invoice</h5>
                        <div class="ml-auto text-light-blue">
                            <ul class="nav nav-tabs customtab default-customtab list-inline text-uppercase lp-5 font-medium font-12" role="tablist">
                            </ul>
                        </div>
                    </div>
                    <form action="{{url('/admin/invoice/'.$invoice->Id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <input type="hidden" name="SyncToken" value="{{$invoice->SyncToken}}">
                        <input type="hidden" name="billing_id" value="{{$invoice->BillAddr->Id}}">
                        <input type="hidden" name="shipping_id" value="{{$invoice->ShipAddr->Id}}">
                       <div class="form-group">
                            <!-- <label for="DocNumber">Document Number:</label> -->
                            <input type="hidden" class="form-control" id="DocNumber" name="DocNumber"  placeholder="Document Number" value="{{$invoice->DocNumber}}">
                            @error('DocNumber')
                            <p class="error-message text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="
                            customer">Customer:</label>                     
                            <select name="customerRef" class="form-control" id="cust" readonly>
                                @foreach($customers as $customer)
                                    @if($customer->Id == $invoice->CustomerRef)
                                    <option  value="{{($customer->Id)}}" {{($customer->Id == $invoice->CustomerRef)?'selected':''}} selected="">{{$customer->DisplayName}}</option>
                                    @else
                                    <option value="{{($customer->Id)}}">{{$customer->DisplayName}}</option>
                                    @endif
                                @endforeach
                            </select>
                                @foreach($customers as $customer)
                                    @if(isset($customer->DisplayName) && isset($customer->Id) && isset($customer->PrimaryEmailAddr->Address))
                                        <input type="text" name="emails" id="{{$customer->Id}}" value="{{$customer->PrimaryEmailAddr->Address}}" hidden>
                                    @endif
                                @endforeach
                        </div>
                         <div class="form-group">
                            <label for="email">Email:</label>
                            <input class="form-control" id="email" name="email" value="{{(isset($invoice->BillEmail->Address)? $invoice->BillEmail->Address:'')}}" rows="3" placeholder="Email" readonly>
                            @error('email')
                            <p class="error-message text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <h5>Billing Address</h5>
                        <div class="row form-group">
                            <div class="col-6">
                                <label for="country">Country:</label>
                                <input type="text" class="form-control" id="billing_country" name="billing_country"  placeholder="country" value="{{$invoice->BillAddr->Country}}">
                                @error('billing_country')
                                <p class="error-message text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-6">
                                <label for="city">City:</label>
                                <input type="text" class="form-control" id="billing_city" name="billing_city"  placeholder="City" value="{{$invoice->BillAddr->City}}">
                                @error('billing_city')
                                <p class="error-message text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>      
                        <div class="row form-group">
                            <div class="col-6">
                                <label for="line1">Line1:</label>
                                <input type="text" class="form-control" id="billing_line1" name="billing_line1"  placeholder="line1" value="{{$invoice->BillAddr->Line1}}">
                                @error('billing_line1')
                                <p class="error-message text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-6">
                                <label for="postal_code">Postal Code:</label>
                                <input type="number" class="form-control" id="billing_postal_code" name="billing_postal_code"  placeholder="Postal Code" value="{{($invoice->BillAddr->PostalCode != NULL)? $invoice->BillAddr->PostalCode:''}}">
                                @error('billing_postal_code')
                                <p class="error-message text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <h5>Shipping Address</h5>
                        <div class="row form-group">
                            <div class="col-6">
                                <label for="country">Country:</label>
                                <input type="text" class="form-control" id="shipping_country" name="shipping_country"  placeholder="Country" value="{{$invoice->ShipAddr->Country}}">
                                @error('shipping_country')
                                <p class="error-message text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                             <div class="col-6">
                                <label for="city">City:</label>
                                <input type="text" class="form-control" id="shipping_city" name="shipping_city"  placeholder="City" value="{{$invoice->ShipAddr->City}}">
                                @error('shipping_city')
                                <p class="error-message text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-6">
                                <label for="line1">Line1:</label>
                                <input type="text" class="form-control" id="shipping_line1" name="shipping_line1"  placeholder="Line1" value="{{$invoice->ShipAddr->Line1}}">
                                @error('shipping_line1')
                                <p class="error-message text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-6">
                                <label for="postal_code">Postal Code:</label>
                                <input type="number" class="form-control" id="shipping_postal_code" name="shipping_postal_code"  placeholder="Postal Code" value="{{$invoice->ShipAddr->PostalCode}}">
                                @error('shipping_postal_code')
                                <p class="error-message text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="row form-group">
                               <div class="col-4">
                                <label for="product">Product/Serivce:</label>
                                <select name="itemRef" class="form-control" id="product">
                                    @foreach($products as $product)
                                        @if($product->Id == $invoice->Line[0]->SalesItemLineDetail->ItemRef)
                                            <option value="{{$product->Id}}" {{($product->Id == $invoice->Line[0]->SalesItemLineDetail->ItemRef)?'selected':''}}>{{$product->Name}}</option>
                                        @else
                                            <option value="{{$product->Id}}">{{$product->Name}}</option>
                                        @endif
                                    @endforeach
                                </select>
            <!--                     @error('product')
                                <p class="error-message text-danger">{{ $message }}</p>
                                @enderror  -->  
                                 @foreach($products as $product)
                                    <input type="hidden" id="{{$product->Id}}" value="{{$product->UnitPrice}}">
                                @endforeach
                            </div>
                            <div class="col-4">
                                <label for="Shipping Date">Shipping Date:</label>
                                <input type="date" class="form-control" id="shipping_date" name="shipping_date" value="{{$invoice->ShipDate}}" placeholder="Shipping Date" min="<?= date('Y-m-d'); ?>">
                                @error('shipping_date')
                                <p class="error-message text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-4">
                                <label for="Due Date">Due Date:</label>
                                <input type="date" class="form-control" id="due_date" name="due_date"  placeholder="Due Date" value="{{$invoice->DueDate}}" min="<?= date('Y-m-d'); ?>">
                                @error('due_date')
                                <p class="error-message text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-6">
                                <label for="unit_price">Unit Price:</label>
                                <input type="text" class="form-control" id="unit_price" name="unit_price"  placeholder="Unit Price" readonly="" value="{{$invoice->Line[0]->SalesItemLineDetail->UnitPrice}}">
                                @error('unit_price')
                                <p class="error-message text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-6">
                                <label for="qty">Qty:</label>
                                <input type="number" class="form-control" min="1" id="qty" name="qty"  placeholder="Quantity" value="{{$invoice->Line[0]->SalesItemLineDetail->Qty}}">
                                @error('qty')
                                <p class="error-message text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="description">Description:</label>
                            <input type="text" class="form-control" id="description" name="description"  placeholder="Description" value="{{($invoice->CustomerMemo != NULL)?$invoice->CustomerMemo:''}}">
                            @error('description')
                            <p class="error-message text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-2 float-right">
                            <label for="TotalAmt">Total Amount:</label>
                            <input type="number" class="form-control text-secandary " id="TotalAmt" name="TotalAmt"  placeholder="00.00" readonly="" value="{{$invoice->Line[0]->Amount}}">
                            @error('TotalAmt')
                            <p class="error-message text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <button class="btn btn-success pull-center" type="submit">Update</button>
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
      $('#cust').on('change',function(){
       var cus =  $('#cust').val();
       var email = $('#'+cus).val();
       $('#email').val(email);
    })
      $('#product').on('change keyup',function(){
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


    $('#unit_price').on('change keyup',function(){
        change();
    });
    $('#qty').on('change keyup',function(){
        change();
    });
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
