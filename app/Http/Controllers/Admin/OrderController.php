<?php
namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\model\Blog;
use App\model\DepotLocation;
use App\model\Membership;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\model\Order;
use Validator;
use App\model\User;
use App\model\Config;
use Illuminate\Support\Str;
use Session;
class OrderController extends Controller
{
    private $messages = [

        'current_date.required' => 'Provide :attribute',

        'timeFrom.required' => 'Provide :attribute',

        'location.required' => 'Provide :attribute',

        'timeTo.required' => 'Provide :attribute',

        'duration.required' => 'Provide :attribute',

        'duration.min' => 'Provide postive Integer',

        'boxes.min' => 'Provide postive Integer ',

        'boxes.required' => 'Provide Number of :attribute',

        'full_name.required' => 'Provide :attribute',

        'organization.required' => 'Provide :attribute',

    ];

    private $attributes = [


        'location' => 'Location',

        'current_date' => 'Date',

        'timeFrom' => 'Start Time',

        'timeTo' => 'End Time',

        'duration' => 'Loading Time',

        'boxes' => 'Boxes',

        'full_name' => 'Full Name',

        'organization' => 'Organization/Pharmacy',
    ];

    public function index() {
      if(auth()->user()->hasRole('admin')){
        $orders=Order::orderBy('id','desc')->get();
        foreach ($orders as $key => $value) {
          $curl = curl_init();
          curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.optimoroute.com/v1/get_orders?orderNo='.$value->order_id.'&key='.env("OPTIMO_AUTH_KEY").'',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
              'Content-Type: application/json'
            ),
          ));

          $optimo_orders= curl_exec($curl);

          curl_close($curl);
          // echo $optimo_orders;die;
        }
        return view('admin.Orders.index', compact('orders'));
      }
    }

      public function orderCreate(Request $request) {
         // Check User Location wether it comes under the service Location or not 
          $depotLocation=DepotLocation::first();
          $lat1=$request->latitude;
          $lon1=$request->longitude;
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
            if(auth()->user()->hasRole('admin')){
              return redirect('admin/order')->with('warning', 'Sorry! Our Service is not available in your location Please Contact your Admin!');
            }
          }
          else{
        // Check User Location wether it comes under the service Location or not 
        $time_to=date("H:i", strtotime($request->timeTo));
        $time_from=date("H:i", strtotime($request->timeFrom));
        $date = str_replace('/"', '-', $request->date);
        $newDate = date("Y-m-d", strtotime($date)); 
          $curl = curl_init();
          curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.optimoroute.com/v1/create_order?key='.env("OPTIMO_AUTH_KEY").'',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>'{
            "operation": "CREATE",
            "orderNo": "'.$request->order_id.'",
            "type": "'.$request->order_type.'",
            "date": "'.$newDate.'",
            "priority": "'.$request->priority.'",
            "location": {
              "address": "'.$request->location.'",
              "acceptPartialMatch": true,
              "acceptMultipleResults":true
            },
            "duration": '.$request->duration.',
            "twFrom": "'.$time_from.'",
            "twTo": "'.$time_to.'",
            "load1": '.$request->boxes.',
            "notes": "'.$request->notes.'",
            "customField1": "'.$request->full_name.'",
            "customField2": "'.$request->organization.'"
          }',
            CURLOPT_HTTPHEADER => array(
              'Content-Type: application/json'
            ),
          ));

          $response = curl_exec($curl);

          $err = curl_error($curl);
          curl_close($curl);
           
            if ($err) {
              // echo "cURL Error #:" . $err;
            } else {
              $res =json_decode($response);
              if($res->success == false){
                  if($res->message =='Request body is not a valid JSON.'){
                    return redirect()->back()->with('flash_message',$res->message);
                  }
                    return redirect()->back()->with('flash_message',$res->message);
              }else
              {
                  Order::where('order_id', $request->order_id)->update([
                    'full_name' => $request->full_name,
                    'organization' => $request->organization,
                    'product' => $request->product,
                    'location' => $request->location,
                    'order_type' => $request->order_type,
                    'priority' => $request->priority,
                    'current_date' => $request->date,
                    'time_from' => $request->timeFrom,
                    'time_to' => $request->timeTo,
                    'duration' => $request->duration,
                    'boxes' => $request->boxes,
                    'notes' => $request->notes,
                    'status' => 1,
                  ]);
                     
                  return redirect('/admin/order')->with('message', 'Order Has Been Created!');
                // echo $response;
              }
           }
         }
      }

          public function create() {
        return view('admin.Orders.add');
    }
    


      public function store(Request $request) {
    }

    public function edit($id) {
        $user_orders = Order::findOrFail($id);
        return view('admin.Orders.edit', compact('user_orders'));
    }

    public function show($id) {
      $user_orders=Order::where('order_id',$id)->first();
      return view('admin.Orders.view', compact('user_orders'));
    }

    public function update(Request $request , $id) {
            if(isset($request->delivery_status)){
              Order::where('order_id',$request->hiddenId)->update([
                'delivery_status' => $request->delivery_status,
              ]);
               return redirect('admin/order')->with('message', 'Order Status Has Been Updated Successfully!');
            }else
            {
            $validator = Validator::make($request->all(), [
            'full_name' => 'required|regex:/^[\pL\s\-]+$/u|max:255',
            'order_type' => 'required',
            'product' => 'required',
            'priority' => 'required',
            'current_date' => 'required',
            'location' => 'required',
            'duration' => 'required|integer|min:0',
            'boxes' => 'required|integer|min:0',
            'notes' =>'max:230'

          ], $this->messages, $this->attributes);


          if($validator->fails())
            return redirect()->back()->withErrors($validator)->withInput();
          // Check User Location wether it comes under the service Location or not 
          $depotLocation=DepotLocation::first();
          $lat1=$request->latitude;
          $lon1=$request->longitude;
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
            if(auth()->user()->hasRole('admin')){
              return redirect('admin/order')->with('warning', 'Sorry! Our Service is not available in your location Please Contact your Admin!');
            }
          }
          else{
        // Check User Location wether it comes under the service Location or not 
            
              $date=date("Y-m-d", strtotime($request->current_date));
              $timeFrom=date("H:i", strtotime($request->timeFrom));
              $timeTo=date("H:i", strtotime($request->timeTo));

                $curl = curl_init();

                curl_setopt_array($curl, array(
                  CURLOPT_URL => 'https://api.optimoroute.com/v1/create_or_update_orders?key='.env("OPTIMO_AUTH_KEY").'',
                  CURLOPT_RETURNTRANSFER => true,
                  CURLOPT_ENCODING => '',
                  CURLOPT_MAXREDIRS => 10,
                  CURLOPT_TIMEOUT => 0,
                  CURLOPT_FOLLOWLOCATION => true,
                  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                  CURLOPT_CUSTOMREQUEST => 'POST',
                  CURLOPT_POSTFIELDS =>'{
                  "orders": [
                    {
                      "orderNo": "'.$request->order_id.'",
                      "date": "'.$date.'",
                      "duration": '.$request->duration.',
                      "priority": "'.$request->priority.'",
                      "type": "'.$request->order_type.'",
                      "location": {
                        "address": "'.$request->location.'",
                        "latitude": '.$request->latitude.',
                        "longitude": '.$request->longitude.'
                      },
                      "timeWindows": [{
                        "twFrom": "'.$timeFrom.'",
                        "twTo": "'.$timeTo.'"
                      }],
                      "notes": "'.$request->notes.'",
                      "load1": '.$request->boxes.',
                      "customField1": "'.$request->full_name.'",
                      "customField1": "'.$request->organization.'"
                    }

                  ]
                }',
                  CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json'
                  ),
                ));
                $response = curl_exec($curl);
                $err=curl_error($curl);
                curl_close($curl);
                        if ($err) {
                          echo "cURL Error #:" . $err;
                        } else {
                          $res =json_decode($response);
                          if($res->success == false){
                              if($res =='Request body is not a valid JSON.'){
                                return redirect()->back()->with('flash_message',$res->success);
                              }
                                return redirect()->back()->with('flash_message',$res);
                          }else
                          {
                            $status=$request->status;
                              Order::where('order_id', $request->order_id)->update([
                                'full_name' => $request->full_name,
                                'organization' => $request->organization,
                                'product' => $request->product,
                                'location' => $request->location,
                                'priority' => $request->priority,
                                'order_type' => $request->order_type,
                                'current_date' => $request->current_date,
                                'time_from' => $request->timeFrom,
                                'time_to' => $request->timeTo,
                                'duration' => $request->duration,
                                'boxes' => $request->boxes,
                                'notes' => $request->notes,
                                'status' => 1,
                              ]);
                              return redirect('/admin/order')->with('message', 'Order Has Been Updated!');
                          }
                        }
                      }
                    }
    }

    public function destroy($id) {
            $curl = curl_init();
            curl_setopt_array($curl, array(
              CURLOPT_URL => 'https://api.optimoroute.com/v1/delete_order?key='.env("OPTIMO_AUTH_KEY").'',
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => '',
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => 'POST',
              CURLOPT_POSTFIELDS =>'{
              "orderNo": "'.$id.'"
            }',
              CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
              ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            // echo $response;

          Order::where('order_id',$id)->delete();
          Session::flash('flash_message', 'Order Has Been Deleted!');
          return redirect('admin/order');
    }

}

