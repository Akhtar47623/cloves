@extends('layouts.admin.app')
@section('title', 'Invoice')
@push('before-css')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/datetime/1.3.0/css/dataTables.dateTime.min.css">
 <link rel="stylesheet" href="{{asset('assets/css/datatable-style.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/datatable.css')}}">
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
                    <div class="table-responsive m-t-10">
                        <select name="fdate" id="fdate">
                            <option value="all">
                                All
                            </option>
                            <option value="today">
                                Today
                            </option>
                            <option value="yesterday">
                                Yesterday
                            </option>
                            <option value="thisweeks">
                                This week
                            </option>
                            <option value="lastweeks">
                                Last week
                            </option>
                            <option value="thismonth">
                                This month
                            </option>
                            <option value="lastmonth">
                                Last month
                            </option>
                            <option value="lastsixmonth">
                                Last six month
                            </option>
                            <option value="this year">
                                This year
                            </option>
                            <option value="last year">
                                Last year
                            </option>
                        </select>
                        <table border="0" cellspacing="5" cellpadding="5" class="d-none">
                            <tbody><tr>
                                <td>Minimum date:</td>
                                <td><input type="text" id="min" name="min"></td>
                            </tr>
                            <tr>
                                <td>Maximum date:</td>
                                <td><input type="text" id="max" name="max"></td>
                            </tr>
                        </tbody></table>
                        <table id="example" class="table color-table table-bordered product-table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Doc_NO</th>
                                    <th>Item</th>
                                    <th>Customer</th>
                                    <th>Org</th>
                                    <th>Email</th>
                                    <th class="d-none">Start Date</th>
                                    <th>Total Amount</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
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
                                    <td class="d-none">{{$invoice->TxnDate}}</td>
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
<script src="{{asset('assets/js/datatable-jquery.js')}}"></script>
<script src="{{asset('assets/js/datatable.js')}}"></script>
<script src="{{asset('assets/js/moment.js')}}"></script>
<script src="{{asset('assets/js/datetime.js')}}"></script>
<script>
   var minDate, maxDate;
 
   $('#fdate').on('change',function(){
    if($(this).val() == 'all'){
        var table = $('#example').DataTable();
        minDate.val('');
        maxDate.val('');
        table.draw();
    }
    else if($(this).val() == 'today'){
        var table = $('#example').DataTable();
        var tnow = new Date();
        var tmnow = new Date(tnow.getFullYear(), tnow.getMonth(), tnow.getDate());
        tmnow.setDate(tmnow.getDate());
        minDate.val(tmnow);
        maxDate.val(tmnow);
        table.draw();
    }
    else if($(this).val() == 'yesterday'){
        var table = $('#example').DataTable();
        var ynow = new Date();
        var ymnow = new Date(ynow.getFullYear(), ynow.getMonth(), ynow.getDate()-1);
        ymnow.setDate(ymnow.getDate());
        minDate.val(ymnow);
        maxDate.val(ymnow);
        table.draw();

    }else if($(this).val() == 'thisweeks'){
        var table = $('#example').DataTable();
        var minvalue = new Date();
        minvalue.setDate(minvalue.getDate()-7);
        var maxvalue = new Date();
        maxvalue.setDate(maxvalue.getDate());
        minDate.val(minvalue);
        maxDate.val(maxvalue);
        table.draw();
    }else if($(this).val() == 'lastweeks'){
        var table = $('#example').DataTable();
        var minvalue = new Date();
        minvalue.setDate(minvalue.getDate()-14);
        var maxvalue = new Date();
        maxvalue.setDate(maxvalue.getDate()-7);
        minDate.val(minvalue);
        maxDate.val(maxvalue);
        table.draw();
    }else if($(this).val() == 'thismonth'){
        var table = $('#example').DataTable();
        var ndate = new Date();
        var minvalue = new Date(ndate.getFullYear(), ndate.getMonth(), 1);
        minvalue.setDate(minvalue.getDate());
        var maxvalue = new Date(ndate.getFullYear(), ndate.getMonth(), ndate.getDate());
        maxvalue.setDate(maxvalue.getDate());
        minDate.val(minvalue);
        maxDate.val(maxvalue);
        table.draw();
    }else if($(this).val() == 'lastmonth'){
        var table = $('#example').DataTable();
        var lsmndate = new Date();
        var minvalue = new Date(lsmndate.getFullYear(), lsmndate.getMonth()-1, 1);
        minvalue.setDate(minvalue.getDate());
        var lsmmdate = new Date();
        var maxvalue = new Date(lsmmdate.getFullYear(), lsmmdate.getMonth(), 0);
        maxvalue.setDate(maxvalue.getDate());
        minDate.val(minvalue);
        maxDate.val(maxvalue);
        table.draw();
    }
    else if($(this).val() == 'lastsixmonth'){
        var table = $('#example').DataTable();
        var ndate = new Date();
        ndate.setDate(1);
        ndate.setMonth(ndate.getMonth()-6);
        var minvalue = new Date(ndate.getFullYear(), ndate.getMonth(), 1);
        minvalue.setDate(minvalue.getDate());
        var mdate = new Date();
        var maxvalue = new Date(mdate.getFullYear(), mdate.getMonth(), 0);
        maxvalue.setDate(maxvalue.getDate());
        minDate.val(minvalue);
        maxDate.val(maxvalue);
        table.draw();
    }
    else if($(this).val() == 'this year'){
        var table = $('#example').DataTable();
        var ndate = new Date();
        var minvalue = new Date(ndate.getFullYear(), 0, 1);
        minvalue.setDate(minvalue.getDate());
        var mdate = new Date();
        var maxvalue = new Date(mdate.getFullYear(), mdate.getMonth(), mdate.getDate());
        maxvalue.setDate(maxvalue.getDate());
        minDate.val(minvalue);
        maxDate.val(maxvalue);
        table.draw();
    }
     else if($(this).val() == 'last year'){
        var table = $('#example').DataTable();
        var ndate = new Date();
        var minvalue = new Date(ndate.getFullYear()-1, 0, 1);
        minvalue.setDate(minvalue.getDate());
        var mdate = new Date();
        var maxvalue = new Date(mdate.getFullYear()-1, 12, 0);
        maxvalue.setDate(maxvalue.getDate());
        minDate.val(minvalue);
        maxDate.val(maxvalue);
        table.draw();
    }

 });
 // Custom filtering function which will search data in column four between two values
 $.fn.dataTable.ext.search.push(
     function( settings, data, dataIndex ) {
        // console.log(minDate.val());
         var min = minDate.val();
         var max = maxDate.val();
         var date = new Date( data[6] );
  
         if (
             ( min === null && max === null ) ||
             ( min === null && date <= max ) ||
             ( min <= date   && max === null ) ||
             ( min <= date   && date <= max )
         ) {
             return true;
         }
         return false;
     }
 );
  
 $(document).ready(function() {
     // Create date inputs
     minDate = new DateTime($('#min'), {
         format: 'YYYY-M-D'
     });
     maxDate = new DateTime($('#max'), {
         format: 'YYYY-M-D'
     });
  
     // DataTables initialisation
     var table = $('#example').DataTable();
  
     // Refilter the table
     $('#min, #max').on('change', function () {
         table.draw();
     });
 });

</script>

@endpush
