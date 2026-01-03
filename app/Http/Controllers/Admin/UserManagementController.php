<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use QuickBooksOnline\API\DataService\DataService;
use QuickBooksOnline\API\Core\Http\Serialization\XmlObjectSerializer;
use QuickBooksOnline\API\Facades\Invoice;
use QuickBooksOnline\API\Facades\Customer;
use App\model\User;
use App\model\Config;
use App\model\Inquiry;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;
use Session;
use Validator;
use App\imagetable;

class UserManagementController extends Controller
{
    private $messages = [
        'heading.required' => 'Provide a :attribute',
        'heading.max' => ':attribute can not exceed :max characters',
        'sub_title.required' => 'Provide a :attribute',
        'sub_title.max' => ':attribute can not exceed :max characters',
        'description.required' => 'Provide :attribute',
        'button_name.required' => 'Provide a :attribute',
        'button_name.string' => ':attribute must be in :string',
        'button_link.required' => 'Provide a :attribute',
        'button_link.url' => ':attribute  must be a URL',
        'image_path.required' => 'Provide :attribute',
        'image_path.mimes' => 'Provide:attribute of jpeg,jpg or png Type',
        'image_path.max' => 'Size of :attribute shold be less than 2 MBs',
    ];
    private $attributes = [
        'heading' => 'Slider Heading',
        'sub_title' => 'Sub Title',
        'description' => 'Description',
        'button_name' => 'Button Name',
        'button_link' => 'Button Link',
        'image_path' => 'Slider Image',
    ];

    public function index() {
    $users = User::where('id','!=',1)->get();
    $dataService = $this->getQuickbookService();
    $dataService->setLogLocation("/Users/hlu2/Desktop/newFolderForLog");
    $errorauth=$dataService->throwExceptionOnError(true);
    $array =$dataService->Query("SELECT * FROM Customer ORDERBY Id DESC");
    $sql=json_encode($array, true);
    $customers=json_decode($sql);
        // echo "<pre>";
        // print_r($customers);die;
        $contact_inquiry =Inquiry::orderBy('id', 'DESC')->get();
        return view('admin.User.index',compact('customers','users','contact_inquiry'));
    }

    public function create() {
        return view('admin.User.add');
    }

    public function store(Request $request) {

        $validator = Validator::make($request->all(), [
            'heading' => 'required|string|max:255',
            'image_path' => 'required|mimes:jpeg,jpg,png|max:2000000'
        ], $this->messages, $this->attributes);

        if($validator->fails())
            return redirect()->back()->withErrors($validator->errors());

        $users = new User;

        $banner->heading = $request->heading;
        if($request->hasfile('image_path'))
        {
            $file = $request->file('image_path');
            $extention = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extention;
            $file->move(public_path('uploads/admin/banner/'),$filename);
            $banner->image_path = 'uploads/admin/banner/'.$filename;
        }
        $banner->save();
        return redirect('/admin/banner')->with('message', 'Slider Has been inserted!');
    }

    public function edit(Request $request)
    {
        $dataService = $this->getQuickbookService();
        $user = User::findOrFail($request->user_id);
        $customer = $dataService->FindbyId('Customer',$request->customer_id);
        return view('admin.User.edit',compact('user','customer'));
    }
    public function show($id)
    {
        $users = User::findOrFail($id);
        return view('admin.User.view',compact('users'));
    }


    public function update(Request $request , $id)
{
        $validator = Validator::make($request->all(), [
            // 'full_name' => 'required|regex:/^[\pL\s\-]+$/u|max:255',
            // 'email' => 'required|email|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
            // // 'country' => 'required|string|max:255',
            // 'organization' => 'required|string|max:255',
            // 'phone' => 'required|numeric',
            // // 'city' => 'required|string|max:255',
        ], $this->messages, $this->attributes);
        if($validator->fails())
            return redirect('admin/user-management')->with('error','Invalid data insertion');

        $aConfig = Config::where(['flag_type' => 'QUICKBOOK_ACCESS_TOKEN'])->first();
        $accessToken=$aConfig->flag_value;
        $dataService = $this->getQuickbookService();
        $customer=$dataService->FindbyId('Customer',$id);
            $curl = curl_init();

            curl_setopt_array($curl, array(
              CURLOPT_URL => 'https://sandbox-quickbooks.api.intuit.com/v3/company/4620816365266887540/customer?minorversion=40',
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => '',
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => 'POST',
              CURLOPT_POSTFIELDS =>'{
                "DisplayName": "'.$request->first_name.' '. $request->last_name.'",
                "PrimaryPhone": {
                    "FreeFormNumber":"'.$request->phone.'"
                },
                "CompanyName":"'.$request->organization.'",
                "PrimaryEmailAddr":{
                    "Address":"'.$request->email.'"
                },
                "Active":"true",
                "BillAddr":{
                    "City":"'.$request->city.'",
                    "Country":"'.$request->country.'"
                },
              "SyncToken": "'.$customer->SyncToken.'",
                "Id": "'.$id.'",
                "sparse": true
            }',
              CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Authorization: Bearer '.$accessToken.''
              ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            // echo $response;


        $user = User::find($request->user_id);
        if ($request->first_name != null) {
            $user->first_name = $request->first_name;
        }
        if ($request->last_name != null) {
            $user->last_name = $request->last_name;
        }
        if ($request->email != null) {
            $user->email = $request->email;
        }
        if ($request->organization != null) {
            $user->organization = $request->organization;
        }
        if ($request->phone != null) {
            $user->phone = $request->phone;
        }
          if ($request->country != null) {
            $user->country = $request->country;
        }
        if ($request->email != null) {
            $user->email = $request->email;
        }
          if ($request->city != null) {
            $user->city = $request->city;
        }

      
        $user->save();
        return redirect('admin/user-management')->with('message', 'User Info Has Been Updated Successfully!');
    }
    public function destroy(Request $request, $id) {
        $dataService = $this->getQuickbookService();
        $invoices = $dataService->Query('SELECT * FROM Invoice');
    //     if(isset($invoices)){
    //     foreach ($invoices as $key => $value) {
    //         if($value->CustomerRef != null){
    //         Session::flash('flash_message', 'The entity you are trying to delete has an open balance.');
    //         return redirect('admin/user-management');
    //         }
    //     }
    // }
        $customer = $dataService->FindbyId('customer', $id);
        $theResourceObj = Customer::update($customer  , [
                "Active" => false
        ]);
        $resultingObj = $dataService->Update($theResourceObj);
        $error = $dataService->getLastError();
        if ($error) {
            echo "The Status code is: " . $error->getHttpStatusCode() . "\n";
            echo "The Helper message is: " . $error->getOAuthHelperError() . "\n";
            echo "The Response message is: " . $error->getResponseBody() . "\n";
        }
        else {
            // echo "Created Id={$resultingObj->Id}. Reconstructed response body:\n\n";
            // $xmlBody = XmlObjectSerializer::getPostXmlFromArbitraryEntity($resultingObj, $urlResource);
            // echo $xmlBody . "\n";
        }
        $users=User::where('id',$request->user_id)->delete();
        Session::flash('flash_message', 'User Has Been Deleted !');
        return redirect('admin/user-management');
    }
}
