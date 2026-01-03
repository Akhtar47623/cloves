<?php

namespace App\Exports;

use App\model\Inquiry;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use QuickBooksOnline\API\DataService\DataService;
use QuickBooksOnline\API\Core\Http\Serialization\XmlObjectSerializer;
use QuickBooksOnline\API\Facades\Invoice;
use App\Http\Controllers\Admin\InvoiceExport;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Validators\Failure;

class InvoicesExport extends Controller implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
    $dataService = $this->getQuickbookService();
    $dataService->setLogLocation("/Users/hlu2/Desktop/newFolderForLog");
    $errorauth=$dataService->throwExceptionOnError(true);
    $invoice = $dataService->Query("select * from Invoice");
    $invoiceSql=json_encode($invoice, true);
    $invoices=json_decode($invoiceSql);
    $arr =[]; 
    foreach ($invoices as $key => $value) {
        $itemId=$value->Line[0]->SalesItemLineDetail->ItemRef;
        $customerName=$dataService->Query("SELECT * FROM Customer WHERE Id='$value->CustomerRef'");
        $item=$dataService->Query("SELECT * FROM Item WHERE Id='$itemId' AND type='Inventory'");
            $arr[$key] = [array(
            "DocNumber" => $value->DocNumber,
            "Item" => $item[0]->Name,
            "Customer" => $customerName[0]->DisplayName,
            "Email" => $value->BillEmail->Address,
            "BillingCountry" => $value->BillAddr->Country,
            "BillingCity" => $value->BillAddr->City,
            "BillingLine1" => $value->BillAddr->Line1,
            "BillingPostalCode" => $value->BillAddr->PostalCode,
            "ShippingCountry" =>$value->ShipAddr->Country,
            "ShippingCity" => $value->ShipAddr->City,
            "ShippingLine1" => $value->ShipAddr->Line1,
            "ShippingPostalCode" => $value->ShipAddr->PostalCode,
            "TotalAmt" => $value->TotalAmt,
            "ShipDate" => $value->ShipDate,
            "DueDate" => $value->DueDate
            )];
    }
      
            return collect($arr);

    }
       public function headings(): array
    {
        return ["DocNumber","Item","Customer","Email", "Billing Country", "Billing City","Billing Line1","Billing PostalCode","Shipping Country", "Shipping City","Shipping Line1", "Shipping PostalCode","TotalAmt", "ShipDate", "DueDate"];
    }
}
