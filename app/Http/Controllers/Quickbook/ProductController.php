<?php
namespace App\Http\Controllers\Quickbook;

use App\Http\Controllers\Controller;
use QuickBooksOnline\API\Core\Http\Serialization\XmlObjectSerializer;
use QuickBooksOnline\API\DataService\DataService;
use QuickBooksOnline\API\Facades\Item;
use Validator;
use File;
use App\model\Config;
use App\model\Service;
use Illuminate\Http\Request;
use Cviebrock\EloquentSluggable\Services\SlugService;

use Session;

class ProductController extends Controller
{
     private $messages = [
        "Name.required" => 'Provide a :attribute',
        "ParentRef.required" => 'Provide a :attribute',
        "PurchaseCost.required" => 'Provide a :attribute',
        "UnitPrice.required" => 'Provide a :attribute',
        "QtyOnHand.required" => 'Provide a :attribute',
    ];
    private $attributes = [
          "Name" => "Item Name",
          "ParentRef" => "Item Category",
          "PurchaseCost" => "Cost Price",
          "UnitPrice" => "Sale Price",
          "QtyOnHand" => "Quantity",
    ];

	public function index(){
        $dataService = $this->getQuickbookService();
        $dataService->setLogLocation("/Users/hlu2/Desktop/newFolderForLog");
        $errorauth=$dataService->throwExceptionOnError(true);
        $array =$dataService->Query("SELECT * FROM Item WHERE type='Inventory' ORDERBY Id DESC");
        $sql=json_encode($array, true);
        $products=json_decode($sql);
        //   echo "<pre>";
        // print_r($products);die;
		return view('admin.Products.index',compact('products'));
	}
	 public function check_slug(Request $request)
    {
        $slug = SlugService::createSlug(Service::class , 'slug', $request->title);
        return response()->json(['slug' => $slug]);
    }


    public function show($id) {
        $dataService = $this->getQuickbookService();
        $dataService->setLogLocation("/Users/hlu2/Desktop/newFolderForLog");
        $errorauth=$dataService->throwExceptionOnError(true);
        $item = $dataService->FindbyId('item', $id);
        $sql=json_encode($item, true);
        $products=json_decode($sql);
              // echo "<pre>";
              // print_r($products);die;
        return view('admin.Products.view', compact('products'));
    }

    public function create() {
        $dataService = $this->getQuickbookService();
        $dataService->setLogLocation("/Users/hlu2/Desktop/newFolderForLog");
        $errorauth=$dataService->throwExceptionOnError(true);
        $array =$dataService->Query("select * from Item where type='Category'");
        $sql=json_encode($array, true);
        $categories=json_decode($sql);
        return view('admin.Products.add',compact('categories'));
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
          "Name" => "required",
          "ParentRef" => "required",
          "PurchaseCost" => "required",
          "UnitPrice" => "required|numeric",
          "QtyOnHand" => "required",
        ], $this->messages, $this->attributes);

        if($validator->fails())
            return redirect()->back()->withErrors($validator)->withInput();
            $ParentRef=$request->ParentRef;
            $SyncToken=$request->SyncToken;
            $item=$request->Name;
            $PurchaseCost=$request->PurchaseCost;
            $UnitPrice=$request->UnitPrice;
            $QtyOnHand=$request->QtyOnHand;
            $Description=$request->Description;
            $aConfig = Config::where(['flag_type' => 'QUICKBOOK_ACCESS_TOKEN'])->first();
            $accessToken=$aConfig->flag_value;
            $dataService = $this->getQuickbookService();
            $dataService->setLogLocation("/Users/hlu2/Desktop/newFolderForLog");
            $errorauth=$dataService->throwExceptionOnError(true);

            $curl = curl_init();
            curl_setopt_array($curl, array(
              CURLOPT_URL => ''.env('QUICKBOOK_API_URL').'/v3/company/'.env('REALMID').'/item?minorversion=4',
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => '',
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => 'POST',
              CURLOPT_POSTFIELDS =>'{
              "TrackQtyOnHand": true, 
              "Name": "'.$item.'", 
              "QtyOnHand": '.$QtyOnHand.', 
              "PurchaseCost":'.$PurchaseCost.',
              "UnitPrice":'.$UnitPrice.',
              "IncomeAccountRef": {
                "name": "Sales of Product Income", 
                "value": "79"
              }, 
              "AssetAccountRef": {
                "name": "Inventory Asset", 
                "value": "81"
              }, 
              "ParentRef":{
                "value":'.$ParentRef.'
               },
               "SubItem": true,
              "InvStartDate": "'.date("Y-m-d").'", 
              "Type": "Inventory", 
              "ExpenseAccountRef": {
                "name": "Cost of Goods Sold", 
                "value": "80"
              },
               "Description":"'.$Description.'"
            }',
              CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Authorization: Bearer '.$accessToken.''
              ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            echo $response;


        return redirect('/admin/product')->with('message', 'New Product Has Been Added!');
    }

    public function edit($id) {
        $dataService = $this->getQuickbookService();
        $dataService->setLogLocation("/Users/hlu2/Desktop/newFolderForLog");
        $errorauth=$dataService->throwExceptionOnError(true);;
        $item = $dataService->FindbyId('item', $id);
        $sql=json_encode($item, true);
        $products=json_decode($sql);
        $array =$dataService->Query("select * from Item  where Type='Category'");
        $itemCategory=json_encode($array, true);
        $categories=json_decode($itemCategory);
        return view('admin.Products.edit', compact('products','categories'));
    }

    public function update(Request $request , $id) {
            $validator = Validator::make($request->all(), [
            "Name" => "required",
            "ParentRef" => "required",
            "PurchaseCost" => "required",
            "UnitPrice" => "required|numeric",
            "QtyOnHand" => "required",
          ], $this->messages, $this->attributes);

          if($validator->fails())
            return redirect()->back()->withErrors($validator)->withInput();
          $aConfig = Config::where(['flag_type' => 'QUICKBOOK_ACCESS_TOKEN'])->first();
          $accessToken=$aConfig->flag_value;
          $ParentRef=$request->ParentRef;
          $SyncToken=$request->SyncToken;
          $item=$request->Name;
          $PurchaseCost=$request->PurchaseCost;
          $UnitPrice=$request->UnitPrice;
          $QtyOnHand=$request->QtyOnHand;
          $Description=$request->Description;
          $curl = curl_init();
          curl_setopt_array($curl, array(
            CURLOPT_URL => ''.env('QUICKBOOK_API_URL').'/v3/company/'.env('REALMID').'/item?minorversion=4',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>'{
            "FullyQualifiedName": "'.$item.'", 
            "domain": "QBO", 
            "Id": "'.$id.'", 
            "Name": "'.$item.'", 
            "TrackQtyOnHand": true, 
            "Type": "Inventory", 
            "PurchaseCost": '.$PurchaseCost.', 
            "QtyOnHand": '.$QtyOnHand.', 
            "IncomeAccountRef": {
              "name": "Sales of Product Income", 
              "value": "79"
            }, 
            "AssetAccountRef": {
              "name": "Inventory Asset", 
              "value": "81"
            }, 
            "Taxable": true, 
            "MetaData": {
              "CreateTime": "2014-09-16T10:42:19-07:00", 
              "LastUpdatedTime": "2014-09-19T13:16:17-07:00"
            }, 
            "ParentRef":{
                "value":'.$ParentRef.'
               },
               "SubItem": true,
            "sparse": false, 
            "Active": true, 
            "SyncToken": "'.$SyncToken.'", 
            "InvStartDate": "'.date("Y-m-d").'", 
            "UnitPrice": '.$UnitPrice.', 
            "ExpenseAccountRef": {
              "name": "Cost of Goods Sold", 
              "value": "80"
            }, 
            "PurchaseDesc": "Rock", 
            "Description": "'.$Description.'"
          }',
            CURLOPT_HTTPHEADER => array(
              'Content-Type: application/json',
              'Authorization: Bearer '.$accessToken.''
            ),
          ));

          $response = curl_exec($curl);

          curl_close($curl);
          // echo $response;


        return redirect('admin/product')->with('message', 'Product Has Been Updated!');
    }

    public function destroy(Request $request, $id) {
          $aConfig = Config::where(['flag_type' => 'QUICKBOOK_ACCESS_TOKEN'])->first();
          $accessToken=$aConfig->flag_value;
          $SyncToken=$request->SyncToken;
          $item=$request->Name;
          $curl = curl_init();
          curl_setopt_array($curl, array(
            CURLOPT_URL => ''.env('QUICKBOOK_API_URL').'/v3/company/'.env('REALMID').'/item?minorversion=4',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>'{
              "domain": "QBO", 
              "Id": "'.$id.'", 
              "Name": "'.$item.'", 
              "TrackQtyOnHand": true, 
              "Type": "Inventory", 
              "IncomeAccountRef": {
                "name": "Sales of Product Income", 
                "value": "79"
              },
              "Taxable": true, 
              "MetaData": {
                "CreateTime": "2014-09-16T10:42:19-07:00", 
                "LastUpdatedTime": "2014-09-19T13:16:17-07:00"
              }, 
              "sparse": false, 
              "Active": false, 
              "SyncToken":"'.$SyncToken.'", 
              "InvStartDate": "'.date("Y-m-d").'"
            }',
            CURLOPT_HTTPHEADER => array(
              'Content-Type: application/json',
              'Authorization: Bearer '.$accessToken.''
            ),
          ));


          $response = curl_exec($curl);

        curl_close($curl);
        echo $response;
        Session::flash('flash_message', 'Product Has Been Deleted!');
        return redirect('admin/product');
    }

}