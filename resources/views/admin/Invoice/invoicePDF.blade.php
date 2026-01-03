<!DOCTYPE html>
<html>
<head>
    <title>Invoice</title>
</head>
<style type="text/css">
    body{
        font-family: 'Roboto Condensed', sans-serif;
    }
    .m-0{
        margin: 0px;
    }
    .p-0{
        padding: 0px;
    }
    .pt-5{
        padding-top:5px;
    }
    .mt-10{
        margin-top:10px;
    }
    .text-center{
        text-align:center !important;
    }
    .w-100{
        width: 100%;
    }
    .w-50{
        width:50%;   
    }
    .w-85{
        width:85%;   
    }
    .w-15{
        width:15%;   
    }
    .logo img{
        width:200px;
        height:50px;
        padding:3px 4px 3px 3px;
    }
    .logo span{
        margin-left:145px;
        top:40px;
        background-color: black;
        position: absolute;
        font-weight: bold;
        font-size:25px;
    }
    .gray-color{
        color:#5D5D5D;
    }
    .text-bold{
        font-weight: bold;
    }
    .border{
        border:1px solid black;
    }
    table tr,th,td{
        border: 1px solid #d2d2d2;
        border-collapse:collapse;
        padding:7px 8px;
    }
    table tr th{
        background: #F4F4F4;
        font-size:15px;
    }
    table tr td{
        font-size:13px;
    }
    table{
        border-collapse:collapse;
    }
    .box-text p{
        line-height:10px;
    }
    .float-left{
        float:left;
    }
    .total-part{
        font-size:16px;
        line-height:12px;
    }
    .total-right p{
        padding-right:20px;
    }
</style>
<body>
        <div class="head-title">
            <h1 class="text-center m-0 p-0">Invoice # {{ $invoices->DocNumber }}</h1>
        </div>
        <div class="add-detail mt-10">
            <div class="w-50 float-left mt-10">
            </div>
            <div class="w-50 float-left logo mt-5 mb-5">
                <span><img src="{{getImage()}}"></span>
            </div>
            <br>
            <br>
            <br>
            <div style="clear: both;"></div>
        </div>
        <div class="table-section bill-tbl w-100 mt-10">
            <table class="table w-100 mt-10">
                <tr>
                    <th class="w-50">Customer Information</th>
                    <!-- <th class="w-50">Billing Info</th> -->
                </tr>
                <tr>
                    <td>
                        <div class="box-text">
                            <p><b>Name :</b>{{$customers->DisplayName}}</p>
                            <p><b>Email :</b>{{$invoices->BillEmail->Address}}</p>
                            <p><b>City :</b> {{$invoices->BillAddr->City}}</p>
                            <p><b>Total Amount :</b>{{$invoices->TotalAmt}}</p>
                        </div>
                    </td>
                    
                </tr>
            </table>
        </div>
        <div class="table-section bill-tbl w-100 mt-10">
            <table class="table w-100 mt-10">
                <tr>
                    <th class="w-50">Billing Address</th>
                    <th class="w-50">Shipping Address</th>
                </tr>
                <tr>
                    <td class="box-text">
                        <p><b>Country :</b>{{$invoices->BillAddr->Country}}</p>
                        <p><b>City :</b>{{$invoices->BillAddr->City}}</p>
                        <p><b>Line1 :</b>{{$invoices->BillAddr->Line1}}</p>
                        <p><b>PostalCode :</b>{{$invoices->BillAddr->PostalCode}}</p>
                        <p><b >Due Date :</b >{{$invoices->DueDate}}</p>
                    </td>
                     <td class="box-text">
                        <p><b>Country :</b>{{$invoices->ShipAddr->Country}}</p>
                        <p><b>City :</b>{{$invoices->ShipAddr->City}}</p>
                        <p><b>Line1 :</b>{{$invoices->ShipAddr->Line1}}</p>
                        <p><b>PostalCode :</b>{{$invoices->ShipAddr->PostalCode}}</p>
                        <p><b >Shipping Date :</b >{{$invoices->ShipDate}}</p>
                    </td>
                </tr>

            </table>
        </div>
        <div class="table-section bill-tbl w-100 mt-10">
            <table class="table w-100 mt-10 border-none">
                <tr>
                    <th class="w-50">DocNumber</th>
                    <th class="w-50">Item</th>
                    <th class="w-50">Uit Price</th>
                    <th class="w-50">Qty</th>
                    <th class="w-50">Total Amount</th>
                </tr>
                <tr>
                    <td>{{$invoices->DocNumber}}</td>
                    <td>{{$items->Name}}</td>
                    <td>{{$invoices->Line[0]->SalesItemLineDetail->UnitPrice}}</td>
                    <td>{{$invoices->Line[0]->SalesItemLineDetail->Qty}}</td>
                    <td>{{$invoices->Line[0]->Amount}}</td>
                </tr>


          <!--       <tr>
                    <td colspan="7">
                        <div class="total-part">
                            <div class="total-left w-85 float-left" align="right">
                                <p>Sub-Total</p>
                                <p>Shipping Amount</p>
                                <p>Total</p>
                            </div>
                            <div class="total-right w-15 float-left text-bold" align="right">   
                      
                            </div>
                            <div style="clear: both;"></div>
                        </div> 
                    </td>
                </tr> -->
            </table>
        </div>
</html>