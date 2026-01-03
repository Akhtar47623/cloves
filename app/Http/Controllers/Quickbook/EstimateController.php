<?php
namespace App\Http\Controllers\Quickbook; 
use App\Http\Controllers\Controller;
use Session;
use QuickBooksOnline\API\DataService\DataService;
use QuickBooksOnline\API\Core\Http\Serialization\XmlObjectSerializer;
use QuickBooksOnline\API\Facades\Estimate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Cookie;
use App\Model\Config;
use Carbon\Carbon;
use QuickBooksOnline\API\Facades\Account;
class EstimateController extends Controller
{


  public function index(){
    $dataService = $this->getQuickbookService();
    $dataService->setLogLocation("/Users/hlu2/Desktop/newFolderForLog");
    $errorauth=$dataService->throwExceptionOnError(true);
    $array = $dataService->Query("Select * from Estimate MAXRESULTS 50");
    $sql=json_encode($array, true);
    $estimates=json_decode($sql);
    // echo "<pre>";
    // print_r($estimates[0]);die;
    return view('admin.Estimates.index',compact('estimates'));
  }

  public function create(){
    $dataService = $this->getQuickbookService();
    $dataService->setLogLocation("/Users/hlu2/Desktop/newFolderForLog");
    $dataService->throwExceptionOnError(true);
    //Add a new Vendor
    $array =$dataService->Query("Select * from Customer MAXRESULTS 100");
    $sql=json_encode($array, true);
    $customers=json_decode($sql);

    // echo "<pre>";
    // print_r($customers[0]);die;
    
    return view('admin.Estimates.add',compact('customers'));
  }

   public function show(){
    return view('admin.Estimates.view');
  }

  public function store(Request $request){
    $dataService = $this->getQuickbookService();
    $dataService->setLogLocation("/Users/hlu2/Desktop/newFolderForLog");
    $dataService->throwExceptionOnError(true);
    //Add a new Vendor
    $Id=$request->customer;
    $array = $dataService->FindbyId('Customer',$Id);
    $sql=json_encode($array, true);
    $customers=json_decode($sql);

    $theResourceObj = Estimate::create([
      "Line" => [
         [
           "Description" => $request->description,
           "Amount" => $request->total_amount,
           "DetailType" => "SalesItemLineDetail",
           "SalesItemLineDetail" => [
             "ItemRef" => [
               "value" => "10",
               "name" => $request->product
             ],
             "UnitPrice" => $request->unit_price,
             "Qty" => $request->qty,
             "TaxCodeRef" => [
               "value" => "NON"
             ]
           ]
         ],
         [
           "Amount" => $request->total_amount,
           "DetailType" => "SubTotalLineDetail",
           "SubTotalLineDetail" => []
         ],
         [
           "Amount" => 3.5,
           "DetailType" => "DiscountLineDetail",
           "DiscountLineDetail" => [
             "PercentBased" => true,
             "DiscountPercent" => 10,
             "DiscountAccountRef" => [
               "value" => "86",
               "name" => "Discounts given"
             ]
           ]
         ]
       ],
       "TxnTaxDetail" => [
         "TotalTax" => 0
       ],
       "CustomerRef" => [
         "value" => $Id,
         "name"=>$customers->DisplayName,
       ],
       "CustomerMemo" => [
         "value" => "Thank you for your business and have a great day!"
       ],
       "BillAddr" => [
         "Id" => $Id,
         "Line1" => $request->billing_line1,
         "City" => $request->billing_city,
         "CountrySubDivisionCode" => $request->billing_country,
         "PostalCode" => $request->billing_postal_code
       ],
       "ShipAddr" => [
         "Id" => $Id,
         "Line1" => $request->shipping_line1,
         "City" => $request->shipping_city,
         "CountrySubDivisionCode" => $request->shipping_country,
         "PostalCode" => $request->shipping_postal_code
       ],
       "TotalAmt" => $request->total_amount,
       "ApplyTaxAfterDiscount" => false,
       "PrintStatus" => "NeedToPrint",
       "EmailStatus" => "NotSet",
       "BillEmail" => [
         "Address" => $request->email
       ]
    ]);
   

    $resultingObj = $dataService->Add($theResourceObj);
    $error = $dataService->getLastError();
    if ($error) {
        echo "The Status code is: " . $error->getHttpStatusCode() . "\n";
        echo "The Helper message is: " . $error->getOAuthHelperError() . "\n";
        echo "The Response message is: " . $error->getResponseBody() . "\n";
    }
    else {
        echo "Created Id={$resultingObj->Id}. Reconstructed response body:\n\n";
        $xmlBody = XmlObjectSerializer::getPostXmlFromArbitraryEntity($resultingObj, $urlResource);
        echo $xmlBody . "\n";
    }

  }
  public function edit($Id){
    $dataService = $this->getQuickbookService();
    $dataService->setLogLocation("/Users/hlu2/Desktop/newFolderForLog");
    $errorauth=$dataService->throwExceptionOnError(true);
    $invoice = $dataService->FindbyId('invoice',$Id);
      return view('admin.Estimates.edit',compact('invoice'));
    }
    public function update(Request $request, $Id){
      $dataService = $this->getQuickbookService(); 
      $dataService->setLogLocation("/Users/hlu2/Desktop/newFolderForLog");
      $dataService->throwExceptionOnError(true);
      $invoice = $dataService->FindbyId('invoice', $Id);
      $array =$dataService->Query("SELECT * FROM Invoice WHERE Id = '$Id'");
      $address=$request->Address;
      $city=$request->City;
      $totalAmt=$request->TotalAmt;
      $theResourceObj = Invoice::update($invoice, [
         "Line" => [
          [
               "Amount" => $totalAmt,
               "DetailType" => "SalesItemLineDetail",
               "SalesItemLineDetail" => [
                 "ItemRef" => [
                   "value" => 1,
                   "name" => "Services"
                 ]
               ]
          ]
          ],
          "CustomerRef"=> [
                "value"=> 2
          ],
          "BillEmail" => [
                "Address" => $address
          ],
          "BillEmailCc" => [
                "Address" => $address
          ],
          'BillAddr' =>[
            'City' => $city
          ],
      ]);
      $resultingObj = $dataService->Update($theResourceObj);
      $error = $dataService->getLastError();
      if ($error) {
          echo "The Status code is: " . $error->getHttpStatusCode() . "\n";
          echo "The Helper message is: " . $error->getOAuthHelperError() . "\n";
          echo "The Response message is: " . $error->getResponseBody() . "\n";
      }
       else {
        Session::flash('success', 'Invoice Has Been Updated Successfully!');
        return redirect('admin/invoice');
        }
    }

    public function destroy($Id){
      $dataService = $this->getQuickbookService(); 
      $dataService->setLogLocation("/Users/hlu2/Desktop/newFolderForLog");
      $dataService->throwExceptionOnError(true);
      $invoice = $dataService->FindbyId('invoice',$Id);
      $resultingObj = $dataService->Delete($invoice);
      $error = $dataService->getLastError();
      if ($error) {
          echo "The Status code is: " . $error->getHttpStatusCode() . "\n";
          echo "The Helper message is: " . $error->getOAuthHelperError() . "\n";
          echo "The Response message is: " . $error->getResponseBody() . "\n";
      }
      else {
        Session::flash('flash_message', 'Invoice Has Been Deleted!');
        return redirect()->back();
        }
    }
}
