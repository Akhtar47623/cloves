<?php
namespace App\Http\Controllers\admin; 
use App\Http\Controllers\Controller;
use Session;
use QuickBooksOnline\API\DataService\DataService;
use QuickBooksOnline\API\Core\Http\Serialization\XmlObjectSerializer;
use QuickBooksOnline\API\Facades\Invoice;
use QuickBooksOnline\API\Facades\Customer;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use QuickBooksOnline\API\Facades\Account;
class CustomerController extends Controller
{   

public function index(){
    $dataService = $this->getQuickbookService();
    $dataService->setLogLocation("/Users/hlu2/Desktop/newFolderForLog");
    $errorauth=$dataService->throwExceptionOnError(true);
    // $invoice = $dataService->FindbyId('invoice',34);
     $array =$dataService->Query("Select * from Customer MAXRESULTS 100");
        $sql=json_encode($array, true);
        $customers=json_decode($sql);
        // echo "<pre>";
        // print_r($customers);die;
        return view('admin.Customer.index',compact('customers'));
}
   
    public function create(){
        $refreshToken = Cookie::get('refreshToken');
    $accessToken = Cookie::get('accessToken');
    if(isset($refreshToken) && isset($accessToken)){  
        // return response()->json(['Cookie set successfully.'.$value]);
      $dataService = DataService::Configure(array(
      'auth_mode'       => 'oauth2',
      'ClientID'        => config('services.data_service.client_id'),
      'ClientSecret'    => config('services.data_service.client_secret'),
      'accessTokenKey'  => $accessToken,
      'refreshTokenKey' => $refreshToken,
      'QBORealmID'      => "4620816365254155840",
      'baseUrl'         => "development",
      'RedirectURI' => "http://localhost/waheed/quickbooks/SampleApp-CRUD-PHP-master/CRUD_Examples/testcalls/callback.php",
    )); 
    $dataService->setLogLocation("/Users/hlu2/Desktop/newFolderForLog");
    $errorauth=$dataService->throwExceptionOnError(true);
    // $invoice = $dataService->FindbyId('invoice',34);
     $array =$dataService->Query("Select * from CustomerType");
        $sql=json_encode($array, true);
        $customers=json_decode($sql);
    return view('admin.Customer.add',compact('customers'));
}else{
        return redirect('admin/callbackindex');
  }
        return redirect('admin/callbackindex');

  }
  
    public function store(Request $request){
            $refreshToken = Cookie::get('refreshToken');
            $accessToken = Cookie::get('accessToken');
        if(isset($refreshToken) && isset($accessToken)){  
            $dataService = DataService::Configure(array(
            'auth_mode'       => 'oauth2',
            'ClientID'        => config('services.data_service.client_id'),
            'ClientSecret'    => config('services.data_service.client_secret'),
            'accessTokenKey'  => $accessToken,
            'refreshTokenKey' => $refreshToken,
            'QBORealmID'      => "4620816365254155840",
            'baseUrl'         => "development",
            'RedirectURI' => "http://localhost:8000/admin/callback",
          )); 
            $dataService->setLogLocation("/Users/hlu2/Desktop/newFolderForLog");


            // Add a customer
            $customerObj = Customer::create([
              "BillAddr" => [
                 "Line1"=>  "123 Main Street",
                 "City"=>  "Mountain View",
                 "Country"=>  "USA",
                 "CountrySubDivisionCode"=>  "CA",
                 "PostalCode"=>  "94042"
                 ],
                 "Notes" =>  "Here are other details.",
                 "Title"=>  "Mr",
                 "GivenName"=>  "Evil",
                 "MiddleName"=>  "1B",
                 "FamilyName"=>  "King",
                 "Suffix"=>  "mR",
                 "FullyQualifiedName"=>  "Evil King",
                 "CompanyName"=>  "King Evial",
                 "DisplayName"=>  $request->name,
                 'Active' => "true",
                 "CustomerTypeRef" =>$request->role,
                 "PrimaryPhone"=>  [
                     "FreeFormNumber"=>  "(555) 555-5555"
                 ],
                 "PrimaryEmailAddr"=>  [
                     "Address" => "evilkingw@myemail.com"
                 ]
            ]);
            $resultingCustomerObj = $dataService->Add($customerObj);
            $error = $dataService->getLastError();
            if ($error) {
                echo "The Status code is: " . $error->getHttpStatusCode() . "\n";
                echo "The Helper message is: " . $error->getOAuthHelperError() . "\n";
                echo "The Response message is: " . $error->getResponseBody() . "\n";
            } else{
                return redirect('admin/customer')->with('success', 'You are Successfully!');
            }
        }
            else{
                session_destroy();
                return redirect('admin/callbackindex');
            }

        }
    }