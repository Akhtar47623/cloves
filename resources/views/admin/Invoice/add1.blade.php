@extends('layouts.admin.app')
@section('title', 'Invoice')
@push('before-css')
<link href="{{asset('plugins/vendors/morrisjs/morris.css')}}" rel="stylesheet">
<link href="{{asset('plugins/vendors/c3-master/c3.min.css')}}" rel="stylesheet">
<link href="{{asset('plugins/vendors/toast-master/css/jquery.toast.css')}}" rel="stylesheet">
<link href="{{asset('plugins/vendors/vectormap/jquery-jvectormap-2.0.2.css')}}" rel="stylesheet"/>
<!-- <link href="{{asset('plugins/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css')}}" rel="stylesheet"type="text/css"/> -->
<link href="{{asset('assets/css/pages/google-vector-map.css')}}" rel="stylesheet">
<link href="{{ asset('https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css') }}" rel="stylesheet">
<link href = "https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css"
         rel = "stylesheet">
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
                        <h5 class="card-title m-b-0 align-self-center">Add Invoicdfe</h5>
                        <div class="ml-auto text-light-blue">
                            <ul class="nav nav-tabs customtab default-customtab list-inline text-uppercase lp-5 font-medium font-12" role="tablist">
                            </ul>
                        </div>
                    </div>
                    <form action="{{url('/admin/invoice')}}" method="POST" enctype="multipart/form-data">
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
                                @foreach($customers as $customer)
                                        @if(isset($customer->PrimaryEmailAddr->Address))
                                            @php $user = \App\model\User::where('email',$customer->PrimaryEmailAddr->Address)->first();@endphp
                                        @if(isset($user))
                                    @if(isset($customer->DisplayName) && isset($customer->Id))
                                    <option  value="{{$customer->Id}}" selected="">{{$customer->DisplayName}}</option>
                                    @else
                                    <option>NA</option>
                                    @endif
                                    @endif
                                    @endif
                                    
                                @endforeach
                            </select>
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
                            <div class="col-6">
                                <label for="Shipping Date">Shipping Date: <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="datepicker" name="shipping_date"  placeholder="" value="{{old('shipping_date')}}" min="<?= date('Y-m-d'); ?>">
                                @error('shipping_date')
                                <p class="error-message">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-6">
                                <label for="Due Date">Due Date: <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" id="due_date" name="due_date"  placeholder="Due Date" value="{{old('due_date')}}" min="<?= date('Y-m-d'); ?>">
                                @error('due_date')
                                <p class="error-message">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="description">Description:</label>
                            <input type="text" class="form-control" id="description" name="description"  placeholder="Description" value="{{old('description')}}">
                            @error('description')
                            <p class="error-message">{{ $message }}</p>
                            @enderror
                        </div>
                                <select hidden="">
                                    @foreach($products as $product)
                                        <option></option>
                                    @endforeach
                                </select>
                                    <table class="table" id="dynamic_field">
                                      <tr>
                                        <td>
                                                <select name="product[]" class="form-control pr-6" onchange="change('product-0')" id="product-0"  value="{{old('product')}}">
                                                    <option selected="" disabled="">Select Product</option>
                                                @foreach($products as $product)
                                                    <!-- <option value="{{$product->UnitPrice}} {{$product->Id}} {{$product->Name}}">{{$product->Name}}</option> -->
                                                    <option value="{{$product->Id}}">{{$product->Name}}</option>

                                                @endforeach
                                            </select>
                                                @error('product')
                                                <p class="error-message">{{ $message }}</p>
                                                @enderror  
                                                @foreach($products as $product)
                                                    <input type="hidden" id="{{$product->Id}}" value="{{$product->UnitPrice}}" >
                                                @endforeach 
                                                @foreach($products as $product)
                                                    <input type="hidden" id="pname-{{$product->Id}}" value="{{$product->Name}}" >
                                                @endforeach 
                                                    <input type="hidden" id="name-0" value="" name="pname[]" >

                                            </td>
                                            <td><input type="text" name="description[]" placeholder="Description" class="form-control name_email"/></td>
                                                <td> <input type="text" class="form-control" id="unit_price-0" name="unit_price[]" placeholder="Unit Price" value="" readonly>
                                            </td>
                                        <td>
                                            <input type="number" class="form-control" id="qty-0" onchange="qtyChange('qty-0')" name="qty[]"  placeholder="Quntity" value="" min="1">
                                            @error('qty')
                                            <p class="error-message">{{ $message }}</p>
                                            @enderror
                                        </td>
                                        <td>
                                            <input type="number" class="form-control text-secandary " id="TotalAmt-0" name="TotalAmt[]"  placeholder="00.00" readonly="">
                                            @error('TotalAmt')
                                            <p class="error-message">{{ $message }}</p>
                                            @enderror
                                        </td>
                                        <td><button type="button" name="add" id="add" class="btn btn-success"><i class="fa fa-plus"></i></button></td>  
                                      </tr>
                                    </table>
                         <!--          </form>
                                </div>
                              </div> -->
                          <!-- </div> -->
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
     // Add and Remove input field
         $(document).ready(function(){
   
  var i = 1;
  var length;
  //var addamount = 0;
   var addamount = 700;

  $("#add").click(function(){
    
   <!-- var rowIndex = $('#dynamic_field').find('tr').length;  -->
   <!-- console.log('rowIndex: ' + rowIndex); -->
   <!-- console.log('amount: ' + addamount); -->
   <!-- var currentAmont = rowIndex * 700; -->
   <!-- console.log('current amount: ' + currentAmont); -->
   <!-- addamount += currentAmont; -->
   
   addamount += 700;
   console.log('amount: ' + addamount);
   i++;
      $('#dynamic_field').append('<tr id="row'+i+'"><td><select name="product[]" class="form-control pr-6 product" value="{{old("product")}}" onchange="change(&#39;product-'+i+'&#39;)" id="product-'+i+'"><option selected="" disabled="">Select Product</option>@foreach($products as $product)<option value="{{$product->Id}}">{{$product->Name}}</option>@endforeach</select>@error("product")<p class="error-message">{{ $message }}</p>@enderror @foreach($products as $product)<input type="hidden" id="{{$product->Id}}" value="{{$product->UnitPrice}}">@endforeach  <input type="hidden" id="name-'+i+'" value="" name="pname[]" ></td><td><input type="text" name="description[]" placeholder="Description" class="form-control name_email"/></td> <td><input type="text" class="form-control" id="unit_price-'+i+'" name="unit_price[]"  placeholder="Unit Price" readonly="" value="{{old("unit_price")}}"></td><td> <input type="number" class="form-control" id="qty-'+i+'" name="qty[]" onchange="qtyChange(&#39;qty-'+i+'&#39;)"  placeholder="Quntity" value="{{old("qty")}}" min="1">@error("qty")<p class="error-message">{{ $message }}</p>@enderror</td><td><input type="text" id="TotalAmt-'+i+'" name="TotalAmt[]" value="" placeholder="Amount" class="form-control total_amount" readonly/></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');  
    });

  $(document).on('click', '.btn_remove', function(){  
  addamount -= 700;
  console.log('amount: ' + addamount);
  
  <!-- var rowIndex = $('#dynamic_field').find('tr').length;   -->
   <!-- addamount -= (700 * rowIndex); -->
   <!-- console.log(addamount); -->
   
    var button_id = $(this).attr("id");     
      $('#row'+button_id+'').remove();  
    });
  


    $("#submit").on('click',function(event){
    var formdata = $("#add_name").serialize();
    console.log(formdata);
    
    event.preventDefault()
      
      $.ajax({
        url   :"action.php",
        type  :"POST",
        data  :formdata,
        cache :false,
        success:function(result){
          alert(result);
          $("#add_name")[0].reset();
        }
      });
      
    });
  });
         // Add and Remove Input field
    $('#cust').on('change',function(){
       var cus =  $('#cust').val();
       var email = $('#'+cus).val();
       $('#email').val(email);
    });


    function change(id){
        // $('#unit_price').val(price);
        var productid=$('#'+id).val();
        var proid =id.split('-');
        var itemId=proid[1];
        var price=$('#'+productid).val();
        var name=$('#pname-'+productid).val();
        $('#name-'+itemId).val(name);
        $('#id-'+itemId).val(productid);
        $('#unit_price-'+itemId).val(price);
        var unit_price=$('#unit_price-'+itemId).val();
        var qty = $('#qty-'+itemId).val();
        var totalAmt=(qty * unit_price);
        $('#TotalAmt-'+itemId).val(totalAmt);
     }
       function qtyChange(id){ 
        var qtyid=$('#'+id).val();
        var proid =id.split('-');
        var itemId=proid[1];
        var priceId = $('#product-'+itemId).val();
        var unit_price=$('#unit_price-'+itemId).val();
        // var priceSplit=priceId.split(' ');
        // var price=priceSplit[0];
        // var passPrice=$('#product-'+priceId[0]).val();
        // var price=$('#product-'+priceId[0]).val();
        var totalAmt=(qtyid * unit_price);
        $('#TotalAmt-'+proid[1]).val(totalAmt);
            // console.log(qty);

     }

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
