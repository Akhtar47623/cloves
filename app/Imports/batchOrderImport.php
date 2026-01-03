<?php
namespace App\Imports;
use App\model\Order;
use App\model\User;
use App\model\Config;
use App\model\DepotLocation;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Validators\Failure;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Validator;
use Throwable;
use Session;
class batchOrderImport implements ToModel, WithHeadingRow, WithValidation, SkipsEmptyRows,SkipsOnFailure,SkipsOnError
{
     use Importable,SkipsFailures,SkipsErrors;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
     
    private function validateFile(){
      return redirect()->back()->with('error','Error Occur! Check your Order Form and try again. ');
    }
    private function exceedDistance(){
     if(auth()->user()->hasRole('admin')){
        return redirect('admin/order')->with('warning', 'Sorry! Our Service is not available in your location Please Contact your Admin!');
        }
    }
    private function success(){
      return redirect()->back()->with('success','Order Has Been Created Successfully!');
    }
    public function model(array $row)
    {

            $curl = curl_init();
            curl_setopt_array($curl, array(
              CURLOPT_URL => "https://api.mapbox.com/geocoding/v5/mapbox.places/".$row['longitude'].",".$row['latitude'].".json?access_token=pk.eyJ1IjoiYnJhdC1tb3JyaXMiLCJhIjoiY2t4a2tkOTl1MTJ3bzJ4cGVveWI5MXg5cyJ9.2GY1n-cZqLySvWIZ5lHMsw",
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => '',
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => 'GET',
            ));
            $response = curl_exec($curl);
            curl_close($curl);
            // echo $response;
            $jsonBody = json_decode($response);
            if($jsonBody != null){
              $country = $jsonBody->features[count($jsonBody->features)-1]->place_name;
              $address=$jsonBody->features[0]->place_name;
            }
            else{
              $country='';
            }  
          // Extract Country from Location
            // Order Id in m_flag in sequence
            $orders=Config::where(['flag_type' => 'ORDER_ID'])->first();
            $row_id=$orders->flag_value; 
            // Order Id in m_flag in sequence

            // Convert date into Optimo format
            $date=$row['date'];
            if(strstr($date, '-')){
              $date=$row['date'];
            }else if(strstr($date, '/')){
              $date=date("Y-m-d", strtotime($date));
            }   else if(is_numeric($row['date'])) {
            $UNIX_DATE = ($date - 25569) * 86400;
            $date=gmdate("Y-m-d", $UNIX_DATE);
            // $date=date("Y/m/d", strtotime($row['date']));
            }
            else{
              $date='';
            }
            // Convert date into Optimo format
            $order_type= strtoupper($row['order_type']);//Convert Order Type into capital letter
            $priority= strtoupper($row['priority']);//Convert Priority into capital letter 
            
            // Convert time into Optimo format
            if(strstr($row['time_to'], 'M')){
              $time_to=date("H:i",strtotime($row['time_to']));
            }else if(is_numeric($row['time_from'])){
              $time_to=date("H:i",$row['time_to'] * 86400);
            }
            else{
              $time_to=$row['time_from'];
            }
             if(strstr($row['time_from'], 'M')){
              $time_from=date("H:i",strtotime($row['time_from']));
            }else if(is_numeric($row['time_from'])){
              $time_from=date("H:i",$row['time_from'] * 86400);
            }
            else{
              $time_from=$row['time_from'];
            }
            // Convert time into Optimo format
                       // Calculate distance between depot location and order location
            $depotLocation = DepotLocation::first();
            $radius=$depotLocation->radius;
            $lat1=$row['latitude'];
            $lon1=$row['longitude'];
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
                 $this->exceedDistance();
              }
            }
            // Calculate distance between depot location and order location
            else{
            if(isset($row['full_name']) && isset($row['product']) && isset($row['duration']) && isset($priority) && isset($row['boxes']) && isset($row['latitude']) && isset($row['longitude']) && isset($date) && isset($order_type) && isset($time_from) && isset($time_to)) {
              $curl = curl_init();
                curl_setopt_array($curl, array(
                  CURLOPT_URL => 'https://api.optimoroute.com/v1/create_or_update_orders?key='.env('OPTIMO_AUTH_KEY').'',
                  // CURLOPT_URL => 'https://api.optimoroute.com/v1/create_or_update_orders?key='.env("OPTIMO_AUTH_KEY").'',
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
                      "orderNo": "'.$row['order_id'].'",
                      "date": "'.$date.'",
                      "duration": '.$row['duration'].',
                      "priority": "'.$priority.'",
                      "type": "'.$row['order_type'].'",
                      "location": {
                        "address": "'.$address.'",
                        "latitude": '.$row['latitude'].',
                        "longitude": '.$row['longitude'].'
                      },
                      "timeWindows": [{
                        "twFrom": "'.$time_from.'",
                        "twTo": "'.$time_to.'"
                      }],
                      "notes": "'.$row['notes'].'",
                      "load1": '.$row['boxes'].',
                      "customField1": "'.$row['full_name'].'",
                      "customField1": "'.$row['organization'].'",
                      "email": "'.$row['email'].'"
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
                // echo $response;

                     if ($err) {
                        return redirect()->back()->with('error',"cURL Error #:" . $err);
                      } else{
                        $order = Order::firstOrNew(['order_id' => $row['order_id']]); 
                        $order->order_id = $row['order_id'];
                        $order->full_name = $row['full_name'];
                        $order->organization = $row['organization'];
                        $order->product = $row['product'];
                        $order->location = $address;
                        $order->country = $country;
                        $order->email = $row['email'];
                        $order->latitude = $row['latitude'];
                        $order->langitude = $row['longitude'];
                        $order->current_date = $date;
                        $order->order_type = $row['order_type'];
                        $order->priority = $row['priority'];
                        $order->time_to = $time_to;
                        $order->time_from = $time_from;
                        $order->duration = $row['duration'];
                        $order->boxes = $row['boxes'];
                        $order->notes = $row['notes'];
                        $order->status =1;
                        $order->save();
                         Config::where(['flag_type' => 'ORDER_ID'])->update([
                            'flag_value' => $order_lastId=substr($row['order_id'], 3) +1,
                        ]);
                        
                        $this->success();
                      }
                  }
            else {
                $this->validateFile();
            }
          }
                
    }
     public function headingRow(): int
    {
      return 3;
    }

    public function rules(): array
    {
        return [
            'order_id' => 'required',
            'full_name' => 'required|regex:/^[\pL\s\-]+$/u|max:255',
            'order_type' => 'required|in:D,P,T',
            'priority' => 'required|in:M,H,L',
            'time_to' =>'required',
            'time_from' => 'required',
            'organization' => 'required',
            'boxes' => ['required','numeric'],
            'email' =>'required|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
            'date' => 'required',
            'duration'=> ['required','numeric'],
            'longitude' => 'required',
            'latitude' => ['required'],

        ];
    }
     public function customValidationMessages()
    {
        return [
            'order_id.required' => 'Order Id is Required',
            'full_name.regex' => 'Invalid Name format',
            'email.regex' => 'Email is Invalid',
            'product.required' => 'Provide Product Name',
            'order_type.required' => 'Provide Delivery Type',
            'order_type.in' => 'Order Type must be one of these three "D,P,T"',
            'time_from.required' => 'Provide Starting Time (time_from) ',
            'time_to.required' => 'Provide Ending Time (time_to) ',
            'duration.required' => 'Provide Uploading duration in minutes',
            'duration.numeric' => 'Duration must be an Integer value',
            'boxes.required' => 'Provide Boxes Nubmer',
            'boxes.numeric' => 'Duration Number must be an Integer value',
            'organization.required' => 'Organization is Required',
            'priority.in' => 'Priority mode must be one of these three "H,M,L"',
        ];
    }


     public function onError(Throwable $error)
     {
        
     }

}