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

class CategoryController extends Controller
{
     private $messages = [
        'category.required' => 'Provide a :attribute',
        'short_description.required' => 'Provide :attribute',
        'long_description.required' => 'Provide :attribute',
        'image_path.required' => 'Provide :attribute',
        'image_path.mimes' => 'Provide:attribute of jpeg,jpg or png Type',
        'image.required' => 'Provide :attribute',
        'image.mimes' => 'Provide:attribute of jpeg,jpg or png Type',
        'gallery_image.required' => 'Provide :attribute',
        'gallery_image.min' => ':attribute must be at least Two',
        'gallery_image.mimes' => 'Provide:attribute of jpeg,jpg or png Type',
    ];
    private $attributes = [
        'category' => 'Category',
        'slug' => 'Slug',
        'short_description' => 'Short Description',
        'long_description' => 'Long Description',
        'image_path' => 'Image',
        'image' => 'Image',
        'gallery_image' => 'Gallery Images'
    ];

	public function index(){
	    $dataService = $this->getQuickbookService();
        $dataService->setLogLocation("/Users/hlu2/Desktop/newFolderForLog");
        $errorauth=$dataService->throwExceptionOnError(true);
        $array =$dataService->Query("SELECT * FROM Item WHERE Type='Category' ORDERBY Id DESC");
        $sql=json_encode($array, true);
        $categories=json_decode($sql);
        //     echo "<pre>";
        // print_r($categories);die;
		return view('admin.ProductCategory.index',compact('categories'));
	}
	 public function check_slug(Request $request)
    {
        $slug = SlugService::createSlug(Service::class , 'slug', $request->title);
        return response()->json(['slug' => $slug]);
    }


    public function show($slug) {
        $services = Service::where('slug',$slug)->first();
        return view('admin.ProductCategory.view', compact('services'));
    }

    public function create() {
        return view('admin.ProductCategory.add');
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'category' => 'required',
        ], $this->messages, $this->attributes);

        if($validator->fails())
            return redirect()->back()->withErrors($validator)->withInput();
            $aConfig = Config::where(['flag_type' => 'QUICKBOOK_ACCESS_TOKEN'])->first();
            $accessToken=$aConfig->flag_value;
            $category=$request->category;
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
                  "SubItem": false, 
                  "Type": "Category", 
                  "Name": "'.$category.'"
                }',
                  CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json',
                    'Authorization: Bearer '.$accessToken.''
                  ),
                ));

                $response = curl_exec($curl);

                curl_close($curl);
                echo $response;

        return redirect('/admin/product-category')->with('message', 'New Category is Added!');
    }

    public function edit($id) {
         $dataService = $this->getQuickbookService();
        $dataService->setLogLocation("/Users/hlu2/Desktop/newFolderForLog");
        $errorauth=$dataService->throwExceptionOnError(true);
        $item = $dataService->FindbyId('item', $id);
        $sql=json_encode($item, true);
        $categories=json_decode($sql);
        // $service_gallery = ServiceGallery::where('product_id',$id)->orderBy('id','DESC')->take(2)->get();
        return view('admin.ProductCategory.edit', compact('categories'));
    }

    public function update(Request $request , $id) {
              $validator = Validator::make($request->all(), [
            'category' => 'required',
        ], $this->messages, $this->attributes);

        if($validator->fails())
            return redirect()->back()->withErrors($validator)->withInput();
        $Id=$request->id;
        $productCategory=$request->category;
        $syToken=$request->SyncToken;
        $aConfig = Config::where(['flag_type' => 'QUICKBOOK_ACCESS_TOKEN'])->first();
        $accessToken=$aConfig->flag_value;
        $validator = Validator::make($request->all(), [
        ], $this->messages, $this->attributes);

        if($validator->fails())
            return redirect()->back()->withErrors($validator->errors());
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
              "SyncToken": '.$syToken.', 
              "domain": "QBO", 
              "Name": "'.$productCategory.'", 
              "sparse": false, 
              "Type": "Category", 
              "Id": '.$Id.'
            }',
              CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Authorization: Bearer '.$accessToken.''
              ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            echo $response;


        return redirect('admin/product-category')->with('message', 'Category Has Been Updated!');
    }

    public function destroy(Request $request, $id) {
            $dataService = $this->getQuickbookService();
            $dataService->setLogLocation("/Users/hlu2/Desktop/newFolderForLog");
            $errorauth=$dataService->throwExceptionOnError(true);
            $category = $dataService->FindbyId('item',$id);
            $resultingObj = $dataService->Delete($category);
            $error = $dataService->getLastError();
            if ($error) {
                echo "The Status code is: " . $error->getHttpStatusCode() . "\n";
                echo "The Helper message is: " . $error->getOAuthHelperError() . "\n";
                echo "The Response message is: " . $error->getResponseBody() . "\n";
            }
            else {
                echo "Created Id={$resultingObj->Id}. Reconstructed response body:\n\n";
                $xmlBody = XmlObjectSerializer::getPostXmlFromArbitraryEntity($resultingObj, $urlResource);
                // echo $xmlBody . "\n";
            }
        Session::flash('flash_message', 'Category Has Been Deleted!');
        return redirect('admin/product-category');
    }

}