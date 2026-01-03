@extends('layouts.admin.app')
@section('title','Invoice')
@section('content')
<div class="container-fluid bg-white mt-5">
    <div class="row">
        <div class="col-sm-12">
            <div class="white-box card">
                <div class="card-body">
                    <a href="" class="btn waves-effect waves-light btn-rounded btn-primary float-right">Back</a>

                    <div class="clearfix"></div>
                    <hr>
                    <h3 class="box-title pull-left text-info">INVOICE</h3>
                    <img class="float-right" src="{{asset(getImage())}}" width="200" height="70">
                    <div class="table-section">
                        <table class="table">
                            <tr>
                                <th class="text-bold"><h4>CUSTOMER INFORMATION</h4></th>
                                <!-- <th class="w-50">Billing Info</th> -->
                            </tr>
                            <tr>
                                <td class="col-7">
                                        <p><b>NAME </b>{{$customers->DisplayName}}</p>
                                        <p><b>EMAIL </b>{{$invoices->BillEmail->Address}}</p>
                                        <p><b>CITY </b>{{$invoices->BillAddr->City}}</p>
                                        <p><b>TOTAL AMOUNT </b>{{$invoices->TotalAmt}}</p>
                                </td>
                                <td class="col-5">
                                    <p><b>INVOICE # </b>{{ $invoices->DocNumber }}</p>
                                    <!-- <p><b>DATE </b></p> -->
                                    <p><b>DUE DATE </b>{{$invoices->DueDate}}</p>
                                    <p><b>SHIP DATE </b>{{$invoices->ShipDate}}</p>
                                </td>
                                
                            </tr>
                        </table>
                    </div>
                    <hr>
                    <div class="table-section">
                        <table class="table">
                            <tr>
                                <th class="text-bold"><h4>BILLING ADDRESS</h4></th>
                                <th class="text-bold"><h4>SHIPPING ADDRESS</h4></th>
                            </tr>
                            <tr>
                                <td class="col-7">
                                    <p><b>COUNTRY </b>{{$invoices->BillAddr->Country}}</p>
                                    <p><b>CITY </b>{{$invoices->BillAddr->City}}</p>
                                    <p><b>LINE1 </b>{{$invoices->BillAddr->Line1}}</p>
                                    <p><b>POSTALCODE </b>{{$invoices->BillAddr->PostalCode}}</p>
                                </td>
                                 <td class="col-5">
                                    <p><b>COUNTRY </b>{{$invoices->ShipAddr->Country}}</p>
                                    <p><b>City </b>{{$invoices->ShipAddr->City}}</p>
                                    <p><b>LINE1 </b>{{$invoices->ShipAddr->Line1}}</p>
                                    <p><b>POSTALCODE </b>{{$invoices->ShipAddr->PostalCode}}</p>
                                </td>
                            </tr>

                        </table>
                    </div>
                    <hr>
                    <div class="table-section ">
                        <table class="table border-none">
                            <tr>
                                <th class="text-info">DOCNUMBER</th>
                                <th class="text-info">ITEM</th>
                                <th class="text-info">UNIT PRICE</th>
                                <th class="text-info">QTY</th>
                                <th class="text-info">TOTAL AMOUNT</th>

                            </tr>
                            <tr>
                                <td>{{$invoices->DocNumber}}</td>
                                <td>{{$items->Name}}</td>
                                <td>{{$invoices->Line[0]->SalesItemLineDetail->UnitPrice}}</td>
                                <td>{{$invoices->Line[0]->SalesItemLineDetail->Qty}}</td>
                                <td>{{$invoices->Line[0]->Amount}}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="float-right" >
                        <a href="{{ url('/admin/invoice-pdf/'.$invoices->Id) }}" target="_blank" class="btn btn-info">CREATE PDF</a>
                        <a href="{{ url('/admin/send-invoice/'.$invoices->Id) }}" class="btn btn-success">SEND INVOICE</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.admin.includes.templates.footer')
</div>
@endsection

