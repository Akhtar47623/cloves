<?php
namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\model\Blog;
use App\model\DepotLocation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\model\Order;
use Validator;
use Illuminate\Support\Facades\Auth;
use App\model\User;
use App\model\Config;
use Illuminate\Support\Str;
use Session;
class OrderController extends Controller

{
    private $messages = [

        'pickup_locationId.required' => 'Provide :attribute',
        
        'delivery_locationId.required' => 'Provide :attribute',

        'pickup_locationName.required' => 'Provide :attribute',
        
        'delivery_locationName.required' => 'Provide :attribute',

        'current_date.required' => 'Provide :attribute',

        'delivery_location.required' => 'Provide :attribute',
        
        'pickup_location.required' => 'Provide :attribute',

        'timeFrom.required' => 'Provide :attribute',

        'timeTo.required' => 'Provide :attribute',

        'duration.required' => 'Provide :attribute',

        'duration.min' => 'Provide postive Integer',

        'boxes.min' => 'Provide postive Integer ',

        'boxes.required' => 'Provide Number of :attribute',

    ];

    private $attributes = [

        'pickup_locationName' => 'Pickup Location Name',

        'delivery_locationName' => 'Delivery Location Name',

        'delivery_location' => 'Delivery Location',

        'pickup_location' => 'Pickup Location',

        'current_date' => 'Date',

        'timeFrom' => 'Start Time',

        'timeTo' => 'End Time',

        'duration' => 'Loading Time',

        'boxes' => 'Boxes',

    ];

    public function index() {
      $user_orders=Order::where('user_id',auth()->user()->id)->orderBy('id','DESC')->get();
      return view('admin.UserOrder.index',compact('user_orders'));
    }
      public function create() {

        return view('admin.UserOrder.add');

    }

    public function store(Request $request) {
      // Check User Location wether it comes under the service Location or not 
        $depotLocation = DepotLocation::first();
        $lat1=$request->latitude;
        $lon1=$request->langitude;
        $lat2=$depotLocation->depot_lat;
        $lon2=$depotLocation->depot_long;
        $theta = $lon1 - $lon2;
          $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
          $dist = acos($dist);
          $dist = rad2deg($dist);
          $miles = $dist * 60 * 1.1515;
          $unit = strtoupper($miles);

          if ($unit == "K") {
            return ($miles * 1.609344);
          } else if ($unit == "N") {
            return ($miles * 0.8684);
          } else {
            $miles* 1.609344;
          }
        // }
        $kilometer=$miles * 1.609344;
        if($kilometer > $depotLocation->radius){
      
          if(auth()->user()->hasRole('vendor')){
            return redirect('user/order')->with('warning', 'Sorry! Our Service is not available in your location Please Contact your Admin!');
          }
          elseif (auth()->user()->hasRole('user')) {
            return redirect('user/order')->with('warning', 'Sorry! Our Service is not available in your location Please Contact your Admin!');
          }
        }
        else{
      // Check User Location wether it comes under the service Location or not 
          
        $date = str_replace('-"', '/', $request->current_date);  
        $newDate = date("m/d/Y", strtotime($date));  
        $timeFrom=date("g:i A", strtotime($request->timeFrom));
        $timeTo=date("g:i A", strtotime($request->timeTo));
        $validator = Validator::make($request->all(), [
            'full_name' => 'required|regex:/^[\pL\s\-]+$/u|max:255',
            'product' => 'required',
            'order_type' => 'required',
            'current_date' => 'required',
            'location' => 'required',
            'timeFrom' => 'required',
            'timeTo' => 'required',
            'duration' => 'required|integer|min:0',
            'boxes' => 'required|integer|min:0',
            'notes' =>'max:230',
        ], $this->messages, $this->attributes);

        if($validator->fails())
          return redirect()->back()->withErrors($validator)->withInput();
          $userlast_id = User::where('id',auth()->user()->id)->first();
          $check = (($userlast_id->last_order != null)?$userlast_id->last_order+1:1);
          User::where('id',auth()->user()->id)->update(['last_order'=>$check]);
          $orders=Config::where(['flag_type' => 'ORDER_ID'])->first();
          $row_id=$orders->flag_value;
          $order=new Order();
          $order->full_name=$request->full_name;
          $order->product=$request->product;
          $order->organization=$request->organization;
          $order->priority="M";
          $order->order_type=$request->order_type;
          $order->current_date=$newDate;
          $order->location=$request->location;
          $order->latitude=$request->latitude;
          $order->langitude=$request->langitude;
          $order->time_from=$timeFrom;
          $order->time_to=$timeTo;
          $order->duration=$request->duration;
          $order->boxes=$request->boxes;
          $order->notes=$request->notes;
          $order->order_id='ORD'.$row_id;
          $order->first_name=auth()->user()->first_name;
          $order->last_name=auth()->user()->last_name;
          $order->email=auth()->user()->email;
          $order->user_id=auth()->user()->id;
          $order->country=auth()->user()->country;
          $order->city=auth()->user()->city;
          $order->user_location=auth()->user()->location;
          $order->order_status=1;
          $order->save();
          Config::where(['flag_type' => 'ORDER_ID'])->update([
                    'flag_value' => $row_id+1
                ]);
          if(auth()->user()->hasRole('vendor')){
            return redirect('/vendor/order')->with('message', 'Order Has Been Created!');
          }
          else if(auth()->user()->hasRole('user')){
            return redirect('/user/order')->with('message', 'Order Has Been Created!');
          }
          else{
            return redirect('/user/order')->with('message', 'Order Has Been Created!');

          }
        }
    }

    public function edit($id) {
        $membership = Membership::findOrFail($id);
        return view('admin.Membership.edit', compact('membership'));
    }

    public function show($id) {
        $user_orders=Order::where('order_id',$id)->first();
        return view('admin.UserOrder.view', compact('user_orders'));
    }

    public function update(Request $request , $id) {
      $validator = Validator::make($request->all(), [
            'description' => 'required',
        ], $this->messages, $this->attributes);
        if($validator->fails())
            return redirect()->back()->withErrors($validator)->withInput();
        $link = $request->link;
        $description = $request->description;
        $status = $request->status;
        Membership::where('id',$id)->update([
            'link' => $link,
            'description' => $description,
            'status' => $status,
        ]);
        $membership = Membership::where('id', $id)->first();
        if($request->hasfile('image_path'))
        {
            $destination2 = public_path().'/'.$membership->image_path;
              if (File::exists($destination2)) {
                File::delete($destination2);
              }
            $file2 = $request->file('image_path');
            $extention2 = $file2->getClientOriginalExtension();
            $filename2 = time().'1.'.$extention2;
            $file2->move(public_path('uploads/admin/Membership/'),$filename2);
            Membership::where('id', $id)
            ->update(['image_path' => 'uploads/admin/Membership/'.$filename2,'link'=> $link,'description' =>
              $description,'status' => $status]);
        }
        return redirect('admin/membership')->with('message', 'Membership has been Updated!');
    }

    public function destroy($id) {
		    $curl = curl_init();
  		  curl_setopt_array($curl, array(
    		  CURLOPT_URL => "https://api.optimoroute.com/v1/delete_orders?key=".env('OPTIMO_AUTH_KEY')."&orderNo=".$id."",
    		  CURLOPT_RETURNTRANSFER => true,
    		  CURLOPT_ENCODING => "",
    		  CURLOPT_MAXREDIRS => 10,
    		  CURLOPT_TIMEOUT => 30,
    		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    		  CURLOPT_CUSTOMREQUEST => "POST",
    		  CURLOPT_POSTFIELDS => "{\r\n  \"orders\": [\r\n    {\r\n      \"orderNo\": \"$id\"\r\n    }\r\n  ]\r\n}",
    		  CURLOPT_HTTPHEADER => array(
    		    // "authorization: Basic d2FoZWVkNDc2MjNAZ21haWwuY29tOk9wdGltbyoqMTIz",
    		    // "cache-control: no-cache",
    		    "content-type: application/json",
    		    // "postman-token: dcc9e7c8-6f63-fdea-220a-3fe6265b0070"
    		  ),
  		  ));
  		$response = curl_exec($curl);
  		$err = curl_error($curl);
  		curl_close($curl);
  		if ($err) {
  		  echo "cURL Error #:" . $err;
  		} else {
  		     $oId = 'P-'.$id;
           $curl = curl_init();
            curl_setopt_array($curl, array(
              CURLOPT_URL => "https://api.optimoroute.com/v1/delete_orders?key=".env('OPTIMO_AUTH_KEY')."&orderNo=".$oId."",
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => "",
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 30,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => "POST",
              CURLOPT_POSTFIELDS => "{\r\n  \"orders\": [\r\n    {\r\n      \"orderNo\": \"$oId\"\r\n    }\r\n  ]\r\n}",
              CURLOPT_HTTPHEADER => array(
                "content-type: application/json",
              ),
            ));
          $response = curl_exec($curl);
          $err = curl_error($curl);
          curl_close($curl);
          Order::where('order_id',$id)->delete();
          Session::flash('flash_message', 'Order Has Been Deleted!');
            if(auth()->user()->hasRole('admin')){
            return redirect('admin/order');
            }
            else if(auth()->user()->hasRole('user')){
            return redirect('user/order');
            }
      }
    }

}

