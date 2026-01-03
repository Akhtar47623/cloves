<?php
namespace App\Http\Controllers\admin; 
use App\Http\Controllers\Controller;
use QuickBooksOnline\API\DataService\DataService;
use QuickBooksOnline\API\Core\Http\Serialization\XmlObjectSerializer;
use QuickBooksOnline\API\Facades\Invoice;
use QuickBooksOnline\API\Facades\Customer;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use PDF;
use Session;
use App\Model\Config;
use Carbon\Carbon;
use Validator;
use QuickBooksOnline\API\Facades\Account;
class InvoiceController extends Controller
{
  private $messages = [
        'email.required' =>'Provide your :attribute',
        'billing_country.required' =>'Provide your :attribute',
        'billing_country.regex' =>':attribute format is Invalid',
        'billing_city.required' =>'Provide your :attribute',
        'billing_city.regex' =>':attribute format is Invalid',
        'billing_line1.required' =>'Provide your :attribute',
        'billing_postal_code.required' =>'Provide your :attribute',
        'billing_postal_code.numeric' =>':attribute is Invalid',
        'shipping_country.required' =>'Provide your :attribute',
        'shipping_country.regex' =>':attribute format is Invalid',
        'shipping_city.required' =>'Provide your :attribute',
        'shipping_city.regex' =>':attribute format is Invalid',
        'shipping_line1.required' =>'Provide your :attribute',
        'shipping_postal_code.required' =>'Provide your :attribute',
        'shipping_postal_code.numeric' =>':attribute is Invalid',
        'product.required' =>'Provide your :attribute',
        'shipping_date.required' =>'Provide your :attribute',
        'due_date.required' =>'Provide your :attribute',
        'unit_price.required' =>'Provide your :attribute',
        'qty.required' =>'Provide your :attribute',
        'customer.required' =>'Select your :attribute ',
        'TotalAmt.required' =>'Required',
    ];
    private $attributes = [
        'email.required' =>'Email',
        'billing_country.required' =>'Billing Country',
        'billing_city.required' =>'Billing City',
        'billing_line1.required' =>'Billing Line1 Address',
        'billing_postal_code.required' =>'Billing PostalCode',
        'shipping_country.required' =>'Shipping Country',
        'shipping_city.required' =>'Shipping City',
        'shipping_line1.required' =>'Shipping Line1 Address',
        'shipping_postal_code.required' =>'Shipping PostalCode',
        'product.required' =>'Product',
        'shipping_date.required' =>'Shipping Date',
        'due_date.required' =>'Due Date',
        'unit_price.required' =>'Unit Price',
        'qty.required' =>'Quantity',
        'TotalAmt.required' =>'Total Amount',
        'customer.required' =>'Customer'
    ];


  public function index(Request $request){
    $dataService = $this->getQuickbookService();
    $dataService->setLogLocation("/Users/hlu2/Desktop/newFolderForLog");
    $errorauth=$dataService->throwExceptionOnError(true);
    $array = $dataService->Query("Select * from Customer");
    $sql=json_encode($array, true);
    $customers=json_decode($sql);
    $invoice = $dataService->Query("SELECT * FROM Invoice ORDERBY Id DESC
    ");
    $invoiceSql=json_encode($invoice, true);
    $invoices=json_decode($invoiceSql);
    $itemQuery=$dataService->Query("Select * from Item where type='Inventory'");
    $item=json_encode($itemQuery, true);
    $items=json_decode($item);
    return view('admin.Invoice.index',compact('invoices','customers','items'));
  }

  public function create(){
    $dataService = $this->getQuickbookService();
    $dataService->setLogLocation("/Users/hlu2/Desktop/newFolderForLog");
    $errorauth=$dataService->throwExceptionOnError(true);
    $array =$dataService->Query("SELECT * FROM Customer WHERE active = true ORDERBY Id DESC");
    $sql=json_encode($array, true);
    $customers=json_decode($sql);
    $item =$dataService->Query("Select * from Item where type='Inventory'");
    $result=json_encode($item, true);
    $products=json_decode($result);
    return view('admin.Invoice.add',compact('customers','products'));
  }

   public function show($Id){
    $dataService = $this->getQuickbookService();
    $errorauth=$dataService->throwExceptionOnError(true);
    $invoices = $dataService->FindbyId('invoice',$Id); 
    $itemId=$invoices->Line[0]->SalesItemLineDetail->ItemRef;
    $array = $dataService->FindbyId("Customer",$invoices->CustomerRef);
    $sql=json_encode($array, true);
    $customers=json_decode($sql);
    $itemQuery=$dataService->FindbyId("Item",$itemId);
    $item=json_encode($itemQuery, true);
    $items=json_decode($item);
    return view('admin.Invoice.view',compact('items','customers','invoices'));
  }

  public function store(Request $request){

    $dataService = $this->getQuickbookService();
    $product = $dataService->FindbyId('Item',$request->product);
    $stock_qty=$product->QtyOnHand;
    $validator = Validator::make($request->all(), [
              'email' => 'required|email|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
              'billing_country' => 'required|regex:/^[\pL\s\-]+$/u|max:255',
              'billing_city' => 'required|regex:/^[\pL\s\-]+$/u|max:255',
              'billing_line1' => 'required',
              'billing_postal_code' => 'required|max:30',
              'shipping_country' => 'required|regex:/^[\pL\s\-]+$/u|max:255',
              'shipping_city' => 'required|regex:/^[\pL\s\-]+$/u|max:255',
              'shipping_line1' => 'required',
              'shipping_postal_code' => 'required|max:30',
              'shipping_date' => 'required',
              'due_date' => 'required',
              'unit_price' => 'required|numeric',
              'qty' => 'required|numeric|max:'.$stock_qty,
              // 'TotalAmt' => 'required|numeric',
              'customer' => 'required',
              'product' => 'required',
              'description' =>'max:230'
        ], $this->messages, $this->attributes);

        if($validator->fails())
            return redirect()->back()->withErrors($validator)->withInput();
    $dataService = $this->getQuickbookService();
    $dataService->setLogLocation("/Users/hlu2/Desktop/newFolderForLog");
    $dataService->throwExceptionOnError(true);
    $Id=$request->customer;
    $product = $dataService->FindbyId('Item',$request->product);
    
    $array = $dataService->FindbyId('Customer',$Id);
    $sql=json_encode($array, true);
    $customers=json_decode($sql);
    if($product->QtyOnHand >= $request->qty){
      $theResourceObj = Invoice::create([
       
        "BillEmail" => [
              "Address" => $request->email,
        ],
        "BillEmailCc" => [
              "Address" => $request->email,
        ],
        'BillAddr' =>[
              "City" => $request->billing_city,
              "Line1" => $request->billing_line1,
              "PostalCode" => $request->billing_postal_code,
              "Lat" => "INVALID",
              "Long" => "INVALID",
              "Country" => $request->billing_country,
              "CountrySubDivisionCode" => "",
              "Id" => $Id,
        ],
         "ShipAddr" => [
              "City" => $request->shipping_city,
              "Line1" => $request->shipping_line1,
              "PostalCode" => $request->shipping_postal_code,
              "Lat" => "INVALID",
              "Long" => "INVALID",
              "Country" => $request->shipping_country,
              "CountrySubDivisionCode" => "",
              "Id" => $Id,
          ],
          "ShipFromAddr" => [
              "City" => $request->shipping_city,
              "Line1" => $request->shipping_line1,
              "PostalCode" => $request->shipping_postal_code,
              "Lat" => "INVALID",
              "Long" => "INVALID",
              "Country" => $request->shipping_country,
              "CountrySubDivisionCode" => "",
              "Id" => $Id,
          ],
           "Line" => [
              [   
                  "Description" => $request->description,
                  "Amount" => $request->unit_price * $request->qty,
                  "SalesItemLineDetail" => [
                      "TaxCodeRef" => ["value" => "NON"],
                      "ItemRef" => [
                        "name" => $product->Name,
                        "value" => $product->Id
                      ],
                      "UnitPrice" => $request->unit_price,
                      "Qty" => $request->qty,
                  ],
                  "Id" => $Id,
                  "DetailType" => "SalesItemLineDetail",
              ],
              [
                  "DetailType" => "SubTotalLineDetail",
                  "Amount" => $request->unit_price * $request->qty,
                  "SubTotalLineDetail" => [],
              ],
          ],
          "DueDate" => $request->due_date,
          "ShipDate"=> $request->shipping_date,
          "ApplyTaxAfterDiscount" => false,
          "sparse" => false,
          "CustomerMemo" => [
              "value" => $request->description,
          ],
        "BillEmailBcc" => [
              "Address" => $request->email
        ],
        'DocNumber' => $request->DocNumber,
        "CustomerRef" => ["name" => $customers->DisplayName, "value" => $customers->Id],

      ]);
    $resultingObj = $dataService->Add($theResourceObj);
    $error = $dataService->getLastError();
      if ($error) {
          echo "The Status code is: " . $error->getHttpStatusCode() . "\n";
          echo "The Helper message is: " . $error->getOAuthHelperError() . "\n";
          echo "The Response message is: " . $error->getResponseBody() . "\n";
          session_destroy();
      }
      else {
        return redirect('admin/invoice')->with('success', 'Invoice Has Been Created Successfully!');
      }
    }
    else{
      Session::flash('flash_message','Requestd Quntity exceed Existing Quantity! ');
      return redirect()->back();
    }
        return redirect('admin/invoice')->with('success', 'Invoice Has Been Created Successfully!');
  }
  public function edit($Id){
    $dataService = $this->getQuickbookService();
    $dataService->setLogLocation("/Users/hlu2/Desktop/newFolderForLog");
    $errorauth=$dataService->throwExceptionOnError(true);
    $invoice = $dataService->FindbyId('invoice',$Id);
    $item =$dataService->Query("Select * from Item where type='Inventory'");
    $result=json_encode($item, true);
    $products=json_decode($result);
    $array =$dataService->Query('Select * from Customer WHERE active = true');
    $sql=json_encode($array, true);
    $customers=json_decode($sql);
      return view('admin.Invoice.edit',compact('invoice','products','customers'));
    }
    public function update(Request $request, $Id){
          $validator = Validator::make($request->all(), [
              'email' => 'required|email|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
              'billing_country' => 'required|regex:/^[\pL\s\-]+$/u|max:255',
              'billing_city' => 'required|regex:/^[\pL\s\-]+$/u|max:255',
              'billing_line1' => 'required',
              'billing_postal_code' => 'required|numeric',
              'shipping_country' => 'required|regex:/^[\pL\s\-]+$/u|max:255',
              'shipping_city' => 'required|regex:/^[\pL\s\-]+$/u|max:255',
              'shipping_line1' => 'required',
              'shipping_postal_code' => 'required|numeric',
              // 'product' => 'required',
              'shipping_date' => 'required',
              'due_date' => 'required',
              'unit_price' => 'required|numeric',
              'qty' => 'required|numeric',
        ], $this->messages, $this->attributes);

        if($validator->fails())
            return redirect()->back()->withErrors($validator)->withInput();
      $dataService = $this->getQuickbookService(); 
      $dataService->setLogLocation("/Users/hlu2/Desktop/newFolderForLog");
      $dataService->throwExceptionOnError(true);
      $aConfig = Config::where(['flag_type' => 'QUICKBOOK_ACCESS_TOKEN'])->first();
      $accessToken=$aConfig->flag_value;
      $invoice = $dataService->FindbyId('invoice', $Id);
      $customer = $dataService->FindbyId('Customer', $request->customerRef);
      $item = $dataService->FindbyId('Item', $request->itemRef);
      $DocNumber=$request->DocNumber;
      $SyncToken=$request->SyncToken;
      $qty=$request->qty;
      $unit_price=$request->unit_price;
      $email=$request->email;
      $TotalAmt=$request->qty * $request->unit_price;
      $billing_city=$request->billing_city;
      $billing_line1=$request->billing_line1;
      $billing_postal_code=$request->billing_postal_code;
      $billing_country=$request->billing_country;
      $billing_id=$request->billing_id;
      $shipping_city=$request->shipping_city;
      $shipping_line1=$request->shipping_line1;
      $shipping_postal_code=$request->shipping_postal_code;
      $shipping_country=$request->shipping_country;
      $shipping_id=$request->shipping_id;
      $due_date=$request->due_date;
      $shipping_date=$request->shipping_date;
      $description=$request->description;
      $curl = curl_init();

      curl_setopt_array($curl, array(
        CURLOPT_URL => ''.env('QUICKBOOK_API_URL').'/v3/company/'.env('REALMID').'/invoice?minorversion=40',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS =>'{
          "SyncToken": "'.$SyncToken.'", 
          "Id": "'.$Id.'", 
          "sparse": true, 
          "DueDate": "'.$due_date.'",
          "TotalAmt": '.$TotalAmt.',
          "Balance":'.$TotalAmt.',
          "BillAddr": {
              "City": "'.$billing_city.'", 
              "Country": "'.$billing_country.'", 
              "Line1":"'.$billing_line1.'",
              "PostalCode": "'.$billing_postal_code.'", 
              "Id":"'.$billing_id.'"
          },
          "ShipAddr": {
              "City": "'.$shipping_city.'", 
              "Country": "'.$shipping_country.'", 
              "Line1":"'.$shipping_line1.'",
              "PostalCode": "'.$shipping_postal_code.'", 
              "Id":"'.$shipping_id.'"
          },
          "CustomerMemo": {
            "value": "'.$description.'"
          },
          "BillEmail": {
            "Address": "'.$email.'"
          },
           "Line": [
            {
              "LineNum": 1, 
              "Amount": '.$TotalAmt.', 
              "SalesItemLineDetail": {
              "UnitPrice": '.$unit_price.',
              "Qty": '.$qty.',
                "TaxCodeRef": {
                  "value": "NON"
                }, 
                "ItemRef": {
                  "name": "'.$item->Name.'", 
                  "value": "'.$item->Id.'"
                }
              }, 
              "Id": "'.$Id.'", 
              "DetailType": "SalesItemLineDetail"
            }, 
            {
              "DetailType": "SubTotalLineDetail", 
              "Amount": '.$TotalAmt.', 
              "SubTotalLineDetail": {}
            }
          ],
           "CustomerRef": {
                  "name": "'.$customer->DisplayName.'", 
                  "value": "'.$customer->Id.'"
                },
            "DueDate" : "'.$due_date.'",
            "ShipDate": "'.$shipping_date.'"
        }',

        CURLOPT_HTTPHEADER => array(
          'Content-Type: application/json',
          'Authorization: Bearer '.$accessToken.''
        ),
      ));

      $response = curl_exec($curl);

      curl_close($curl);
      // echo $response;

        Session::flash('success', 'Invoice Has Been Updated Successfully!');
        return redirect('admin/invoice');
    }

    public function destroy(Request $request, $Id){
      $dataService = $this->getQuickbookService(); 
      $dataService->setLogLocation("/Users/hlu2/Desktop/newFolderForLog");
      $dataService->throwExceptionOnError(true);
      $aConfig = Config::where(['flag_type' => 'QUICKBOOK_ACCESS_TOKEN'])->first();
      $accessToken=$aConfig->flag_value;
      $invoice=$dataService->FindbyId('Invoice',$Id);
      $customer=$dataService->FindbyId('Customer',$invoice->CustomerRef);
      if($customer->Active == 'true'){
      $curl = curl_init();

      curl_setopt_array($curl, array(
        CURLOPT_URL => ''.env('QUICKBOOK_API_URL').'/v3/company/'.env('REALMID').'/invoice?operation=delete',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS =>'{
        "SyncToken": "'.$request->SyncToken.'", 
        "Id": "'.$Id.'"
      }',
        CURLOPT_HTTPHEADER => array(
          'Content-Type: application/json',
          'Authorization: Bearer '.$accessToken.''
        ),
      ));

      $response = curl_exec($curl);

      curl_close($curl);
        Session::flash('flash_message', 'Invoice Has Been Deleted!');
        return redirect()->back();
      }else{
        Session::flash('flash_message', ' Customer assigned to this transaction has been deleted. you must restore'.$customer->DisplayName.'');
        return redirect()->back();
      }
    }


     public function generateInvoicePDF($Id)
    {
        $dataService = $this->getQuickbookService();
        $dataService->setLogLocation("/Users/hlu2/Desktop/newFolderForLog");
        $errorauth=$dataService->throwExceptionOnError(true);
        $invoices = $dataService->FindbyId('invoice',$Id); 
        $itemId=$invoices->Line[0]->SalesItemLineDetail->ItemRef;
        $array = $dataService->FindbyId("Customer",$invoices->CustomerRef);
        $sql=json_encode($array, true);
        $customers=json_decode($sql);
        $itemQuery=$dataService->FindbyId("Item",$itemId);
        $item=json_encode($itemQuery, true);
        $items=json_decode($item);
        $pdf = PDF::loadView('admin.Invoice.invoicePDF',compact('invoices','items','customers'));
        return $pdf->stream('index.pdf');
}

        public function sendInvoice($Id){
          $dataService = $this->getQuickbookService();
          $curl = curl_init();
          $aConfig = Config::where(['flag_type' => 'QUICKBOOK_ACCESS_TOKEN'])->first();
          $accessToken=$aConfig->flag_value;
          $invoice=$dataService->FindbyId('Invoice',$Id);
          curl_setopt_array($curl, array(
            CURLOPT_URL => ''.env('QUICKBOOK_API_URL').'/v3/company/'.env('REALMID').'/invoice/'.$Id.'/send?sendTo='.$invoice->BillEmail->Address.'',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>' {
            "Invoice": {
                  "DeliveryInfo": {
                  "DeliveryType": "Email", 
                  "DeliveryTime": "'.date("Y-m-d").'"
                  }, 
                  "BillEmail": {
                  "Address": "'.$invoice->BillEmail->Address.'"
                  }, 
              },
              }',
            CURLOPT_HTTPHEADER => array(
              'Content-Type: application/octet-stream',
              'Authorization: Bearer '.$accessToken.''
            ),
          ));

          $response = curl_exec($curl);

          curl_close($curl);
           return redirect('/admin/invoice')->with('message', 'Invoice Has Been Send to '.$invoice->BillEmail->Address.'!');
        }
   
}
