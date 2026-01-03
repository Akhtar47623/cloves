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
use Illuminate\Http\Request;
use Validator;
use Session;
class OrdersImport implements ToModel, WithHeadingRow, WithValidation, SkipsEmptyRows,SkipsOnFailure,SkipsOnError
{
    use Importable,SkipsFailures,SkipsErrors;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public $rowCount=0;
    /**
     * @param Failure[] $failures
     */
    // public function onFailure(Failure ...$failures)
    // {
    //     // Handle the failures how you'd like.
    // }
    private function validateFile() {
        if(auth()->user()->hasRole('vendor')){
        return redirect('vendor/order')->with('info', 'Sorry! Our Service is not available in your location Please Contact your Admin!');
        }
        elseif(auth()->user()->hasRole('user')){
        return redirect('user/order')->with('warning', 'Sorry! Our Service is not available in your location Please Contact your Admin!');
        }
    }
    private function success(){
        return redirect('/')->with('message','Orders Has Been Created Successfully!');
    }

    public function model(array $row)
    {
        // Convert excel generated time number to time and 12 hours format to 24 hours
        $time = $row['time_from'] * 86400;
        $time_from=date('h:i A', $time);
        // $time_from=date("H:i", strtotime($timefromChange));
        // dd($row['time_to']);
        $timeTo = $row['time_to'] * 86400;
        $time_to=date('h:i A', $timeTo);
        // $time_to=date("H:i", strtotime($timetoChange));

        // Convert excel generated date number to date format
        $date=$row['date'];
         if(strstr($date, '-')){
              $date=$row['date'];
            }else if(strstr($date, '/')){
              $date=date("m/d/Y", strtotime($date));
            }   else if(is_numeric($row['date'])) {
            $UNIX_DATE = ($date - 25569) * 86400;
            $date=gmdate("m/d/Y", $UNIX_DATE);
            // $date=date("Y/m/d", strtotime($row['date']));
            }
            else{
              $date='';
            }
        // $UNIX_DATE = ($row['date'] - 25569) * 86400;
        // $date=gmdate("m/d/Y", $UNIX_DATE);
        $orders=Config::where(['flag_type' => 'ORDER_ID'])->first();
        $row_id=$orders->flag_value;
        $order_type= strtoupper($row['order_type']);
        if(isset($row['full_name']) && isset($row['location']) && isset($row['product']) && ($order_type =='D' || $order_type =='T' || $order_type =='P' && $order_type != null) && isset($row['time_from']) && isset($row['time_to']) && isset($row['duration']) && isset($row['boxes']) && isset($date)) {
        // Reverse Geocoding of mapbox for getting langitude and latitude
        $location = $row['location'];
        $location = str_replace(' ', '%20', $location);
        $url = "https://api.mapbox.com/geocoding/v5/mapbox.places/".$location.".json?access_token=pk.eyJ1IjoiYnJhdC1tb3JyaXMiLCJhIjoiY2t4a2tkOTl1MTJ3bzJ4cGVveWI5MXg5cyJ9.2GY1n-cZqLySvWIZ5lHMsw";
            $ch = curl_init();
            $getUrl = $url;
            $jsonBody = "";
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_URL, $getUrl);
            curl_setopt($ch, CURLOPT_TIMEOUT, 80);
            $response = curl_exec($ch);
            $err = curl_error($ch);
            curl_close($ch);
            $jsonBody = json_decode($response);
            $langitude = $jsonBody->features[0]->geometry->coordinates[0];
            $latitude = $jsonBody->features[0]->geometry->coordinates[1];
            // Calculate distance between depot location and order location
            $depotLocation = DepotLocation::first();
            $lat1=$latitude;
            $lon1=$langitude;
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
                $this->validateFile();
              }
              elseif (auth()->user()->hasRole('user')) {
               $this->validateFile();
              }
            }
            // Calculate distance between depot location and order location
            else{
            $id = User::where('id',auth()->user()->id)->first();
            $order_id = $id->order_id.rand();
                $order = new Order();
                $order->order_id = 'ORD'.$row_id;
                $order->user_id = auth()->user()->id;
                $order->country = auth()->user()->country;
                $order->city = auth()->user()->city;
                $order->organization = $row['organization'];
                $order->order_type = $order_type;
                $order->priority = "M";
                $order->full_name = $row['full_name'];
                $order->product = $row['product'];
                $order->email = auth()->user()->email;
                $order->latitude = $latitude ;
                $order->langitude = $langitude;
                $order->location = $row['location'];
                $order->current_date = $date;
                $order->time_from =  $time_from;
                $order->time_to =  $time_to;
                $order->duration = $row['duration'];
                $order->boxes = $row['boxes'];
                $order->notes = $row['notes'];
                $order->order_status=1;
                $order->save();
                Config::where(['flag_type' => 'ORDER_ID'])->update([
                    'flag_value' => $row_id+1
                ]);     
                $this->success();
            }
        }
        else {
            $this->validateFile();
        }
    }
        public function headingRow(): int
    {
      return 3;
    }
     public function rules(): array
    {

        return [
            'full_name' => 'required|regex:/^[\pL\s\-]+$/u|max:255',
            'product' => 'required',
            'location' => 'required',
            'date' => 'required',
            'order_type' => 'required|in:D,P,T',
            'time_from' => 'required',
            'time_to' => 'required',
            'duration' => 'required|numeric',
            'boxes' => 'required|numeric',
        ];
    }
    public function customValidationMessages()
    {

        return [
            'full_name.required' => 'Full Name is required',
            'location.required' => 'Location is required',
            'product.required' => 'Product Name is required',
            'date.required' => 'Date is required',
            'order_type.in' => 'Order Type must be one of these three "D,P,T"',
            'time_from.required' => 'Starting Time is required ',
            'time_to.required' => 'Closing Time is required',
            'duration.required' => 'Provide Uploading duration in minutes',
            'boxes.required' => 'Boxes Nubmer is required',
        ];
    }

}