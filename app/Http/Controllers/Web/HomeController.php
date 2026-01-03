<?php
namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\model\Inquiry;
use App\model\CMS;
use App\model\FAQ;
use App\model\DeliveryRequest;
use App\model\Banner;
use App\model\Membership;
use App\model\MainBanner;
use App\model\Location;
use App\model\ServiceGallery;
use App\imagetable;
use App\model\Service;
use App\model\Choose;
use App\model\UserRequest;
use App\model\Doc;
use App\model\ViewersIP;
use App\model\DepotLocation;
use Session;
use Alert;
use Auth;
use App\User;
use Notification;
use App\Notifications\OffersNotification;
use App\Notifications\ApplicationNotification;
use App\Notifications\NewsletterNotification;
use QuickBooksOnline\API\DataService\DataService;
use QuickBooksOnline\API\Core\Http\Serialization\XmlObjectSerializer;
use QuickBooksOnline\API\Facades\Customer;  
use Illuminate\Http\Response;
use Cookie;

class HomeController extends Controller
{
    
	 private $messages = [
        'first_name.required' => ':attribute is required',
        'name.required' => ':attribute is required',
        'name.required' => ':attribute is required',
        'pharmacy_name.required' => ':attribute is required',
        'name.regex' => 'Invalid :attribute Format',
        'first_name.regex' => ':attribute cannot contain numbers or special Char',
        'last_name.required' => ':attribute is required',
        'last_name.regex' => ':attribute cannot contain numbers or special Char',
        'middle_name.required' => ':attribute is required',
        'middle_name.regex' => ':attribute cannot contain numbers or special Char',
        'city.required' => ':attribute is required',
        'city.regex' => 'Invalid format of :attribute',
        'state.required' => ':attribute is required',
        'state.regex' => 'Invalid format of :attribute',
        'street_address1.required' => ':attribute is required',
        'deliver_to.required' => 'Please Provide :attribute',
        'daily_delivery.required' => 'Please Provide Estimated :attribute',
        'street_address.required' => ':attribute is required',
        'street_line.required' => ':attribute is required',
        'address.required' => ':attribute is required',
        'region.required' => ':attribute is required',
        'postal.required' => ':attribute is required',
        'medicine_name.required' => ':attribute is required',
        'type.required' => 'Please provide :attribute',
        'rf1_state.regex' => 'Invalid format of :attribute',
        'time.required' => ':attribute is required',
        'email.required' => ':attribute is required',
        'email.email' => ':attribute must be in correct format',
        'phone.required' => ':attribute is required',
        'phone.numeric' => ':attribute must be Numeric',
        'phone.min' => ':attribute must be of 12 digits',
        'phone.max' => ':attribute should not more than 11 digits',
        'newsletter_email.required' => 'Subscription Email is required',
        'newsletter_email.unique' => 'Subscription Email already exist',
        'resume.required' => 'Provide :attribute',
        'resume.mimes' => 'Provide:attribute of pdf,doc,docx',
        'resume.max' => 'Size of :attribute shold be less than 1 MBs',
        'email.regex' => 'Invalid Email Format',
        'delivery_destination.required' => 'Provide :attribute',
       
    ];

    private $attributes = [
        'phone' =>'Phone Number',
        'name' => 'Name',
        'fname' => 'Full Name',
        'first_name' => 'First Name',
        'middle_name' => 'Middle Name',
        'last_name' => 'Last Name',
        'street_address1' => 'Street Address',
        'dob' => 'Date of Birth',
        'resume' => 'File',
        'city' => 'City',
        'state' => 'State',
        'deliver_to' => 'Where to Deliver',
        'daily_delivery' => 'Daily Delivery',
        'street_address' => 'Street Address',
        'street_line' => 'Street Adress Line 2',
        'city' => 'City',
        'address' =>'Address',
        'postal' => 'Postal / Zip Code',
        'pharmacy_name' => 'Pharmacy Name',
        'type' => 'Type',
        'quantity' => 'Quantity',
        'time' => 'Time',
        'date' => 'Date',
        'email' => 'Email',
        'daily_delivery' => 'Daily Deliveries',
        'delivery_destination'=> 'Farthest Delivery Destination',

    ];

	public function index(Request $request){
		$banners=MainBanner::where('status',1)->orderBy('id','DESC')->get();
		$info_content = CMS::where('page_section','Info Section')->first();
		$about_sec = CMS::where('page_name','Home Page')->where('page_section','About Us Section')->first();
        $services_cms = CMS::where('page_section','Services Section')->where('page_name','Home Page')->first();
        $choose_us_cms = CMS::where('page_section','Why Choose Us Section')->where('page_name','Home Page')->first();
        $faqs_cms=CMS::where('page_name','Home Page')->where('page_section','FAQS Section')->first();   
		$our_speciality_content = CMS::where('page_section','Our Speciality')->where('page_name','Home Page')->first();
        $services=Service::orderBy('id','DESC')->where('status',1)->take(3)->get();
        $faqs=FAQ::where('status','1')->orderBy('id','DESC')->take(3)->get();
        $membership=Membership::orderBy('id','DESC')->take(2)->get();
        $memberships_cms=CMS::where('page_name','Home Page')->where('page_section','Certifications and Memberships Section')->first();
        $partner_cms=CMS::where('page_name','Home Page')->where('page_section','Partner Section')->first();
        $location_cms=CMS::where('page_name','Home Page')->where('page_section','Location Section')->first();
        $document_cms=CMS::where('page_name','Home Page')->where('page_section','Document Section')->first();
        $depotLocations=DepotLocation::get();
        $feature = '';
        foreach ($depotLocations as $key => $depot) {
             $feature .= "map.addSource('tilequery".$key."', {
          type: 'geojson',
          data: {
            'type': 'FeatureCollection',
            'features': [{ type: 'Feature',
             geometry: {type: 'Point',coordinates: [".$depot->depot_long.",".$depot->depot_lat."]},
             properties: {title: '".$depot->depot_location."',description: 'If your location is not fall inside our radius than contact us directly to admin'}},            ]
          }
        });";
        }
        $radius = '';
        foreach ($depotLocations as $key => $rad) {
             $radius .= 'map.addLayer({id: "tilequery-points'.$key.'",
          type: "circle",
          source: "tilequery'.$key.'",
          paint: {"circle-radius": [
            "interpolate", ["exponential", 2], ["zoom"],
              5, 1,15, '.($rad->radius*1609).'
          ],"circle-color": "green",
          "circle-stroke-color": "blue",
          "circle-stroke-width": 1,
          "circle-opacity": 0.3
          },});';
        }
        $dot = '';
        foreach ($depotLocations as $key => $do) {
              $dot .= "map.addLayer({
          id: 'unclustered-point".$key."',
          type: 'circle',
          source: 'tilequery".$key."',
          filter: ['!', ['has', 'point_count']],
          paint: {
          'circle-color': 'red',
          'circle-radius': 4,
          'circle-stroke-width': 1,
          'circle-stroke-color': '#fff'
          }
          });";
        }
        $pointer = '';
        foreach ($depotLocations as $key => $do) {
              $pointer .= "map.on('mouseenter', 'tilequery-points".$key."', (event) => {
          map.getCanvas().style.cursor = 'pointer';
          const properties = event.features[0].properties;
          const popup = new mapboxgl.Popup({ closeOnClick: false })
          .setLngLat([event.lngLat.lng,event.lngLat.lat])
          .setHTML(`<h5>".$do->depot_location."<h5><p>If your location is not fall inside our radius than contact us directly to admin</p>`)
          .addTo(map);
          map.on('mouseleave', 'tilequery-points".$key."', () => {
          map.getCanvas().style.cursor = '';
          popup.remove();
        });
        });";
        }

        // dd($feature);





        return view('front.index',compact('banners','info_content','about_sec','services_cms','services','our_speciality_content','faqs_cms','choose_us_cms','faqs','membership','memberships_cms','partner_cms','location_cms','document_cms','feature','radius','dot','pointer'));
	}
    public function contactForm(Request $request){

          if($request->method() == 'POST'){
            $validator = Validator::make($request->all(),[
                'first_name' => 'required|regex:/^[\pL\s\-]+$/u|max:255',
                'last_name' => 'required|regex:/^[\pL\s\-]+$/u|max:255',
                'organization' => 'required',
                'title' =>'required',
                'phone' => 'required|min:12',
                'email' => 'required|email|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
            ],$this->messages, $this->attributes);

            if($validator->fails()){

                // session::flash('error',$validator->errors()->first());
                return Redirect()->back()->withErrors($validator)->withInput();
            }
          
            $delivery_request =new DeliveryRequest();
            $delivery_request->first_name=$request->first_name;
            $delivery_request->last_name=$request->last_name;
            $delivery_request->phone=$request->phone;
            $delivery_request->organization=$request->organization;
            $delivery_request->title=$request->title;
            $delivery_request->email=$request->email;
            $delivery_request->message=$request->message;
            $delivery_request->save();
             $data2["email"] = $request->newsletter_email;
                $data['email']= $request->newsletter_email;
                $data = array('email'=>"$request->newsletter_email",'type'=>"");
                Mail::send('emails.newsletter', $data,function ($m) use ($data,$data2) {
                    $m->from(env('MAIL_USERNAME'), 'Thank you for newsletter subscription');
                    $m->to($data2["email"],'User')->subject('Thank you for newsletter subscription');
                });

                // $data = array('type'=>"admin");

                $data = array('email'=>"$request->newsletter_email",'type'=>"admin");
                Mail::send('emails.newsletter', $data,function ($m) use ($data,$data2) {
                    $m->from(env('MAIL_USERNAME'), 'New User Registered');
                    $m->to(env('MAIL_USERNAME'),'Admin')->subject('New User Registered');
                });

            return redirect('/')->with('message', 'Your Request for Delivery Service Has Been Submitted Successfully!');
        }
    }

	public function about(){
		$about_details=CMS::where('page_name','About')->first();
        $app_content = CMS::where('page_name','Application Page')->first();
        $banner=Banner::where('page_name','AboutUs')->first();
        $about_us_cms=CMS::where('page_name','About Us')->where('page_section','About Us Section')->first();
        $about_work_cms=CMS::where('page_name','About Us')->where('page_section','How it works Section')->first();
		$memberships_cms=CMS::where('page_name','About Us')->where('page_section','Certifications and Memberships Section')->first();
        $membership=Membership::orderBy('id','DESC')->get();
        $location_cms=CMS::where('page_name','About Us')->where('page_section','Location Section')->first();
        $document_cms=CMS::where('page_name','Home Page')->where('page_section','Document Section')->first();
		return view('front.about',compact('document_cms','about_details','banner','app_content','about_work_cms','about_us_cms','memberships_cms','membership','location_cms'));
	}

	public function Service(){
		$banner=Banner::where('page_name','Service')->first();
		$services_content=CMS::where('page_section','Services')->first();
        $services=Service::orderBy('id','DESC')->where('status',1)->get();
        $document_cms=CMS::where('page_name','Home Page')->where('page_section','Document Section')->first();
		return view('front.service',compact('document_cms','banner','services','services_content'));
	}

    public function deliveryService(Request $request){
         if($request->method() == 'POST'){
            $validator = Validator::make($request->all(),[

                'name' => 'required',
                'pharmacy_name' => 'required',
                'address' => 'required',
                'phone' => 'required|min:12',
                'time' => 'required',
                'daily_delivery' => 'required',
                'deliver_to' => 'required',
                'delivery_destination' => 'required',

            ],$this->messages, $this->attributes);

            if($validator->fails()){
                return Redirect()->back()->withErrors($validator)->withInput();
            }
            $delivery_request =new DeliveryRequest();
            $delivery_request->name=$request->name;
            $delivery_request->pharmacy_name=$request->pharmacy_name;
            $delivery_request->address=$request->address;
            $delivery_request->phone=$request->phone;
            $delivery_request->time=$request->time;
            $delivery_request->daily_delivery=$request->daily_delivery;
            $delivery_request->deliver_to=$request->deliver_to;
            $delivery_request->delivery_destination=$request->delivery_destination;
            $delivery_request->description=$request->description;
            $delivery_request->save();
            return redirect('/request')->with('message', 'Your Request for Delivery Has Been Sumitted Successfully');
        }
        $banner=Banner::where('page_name','Request')->first();
        $document_cms=CMS::where('page_name','Home Page')->where('page_section','Document Section')->first();
		return view('front.request',compact('document_cms','banner'));
	}
   
    public function  faqs(){
        $banner=Banner::where('page_name','FAQS')->first();
        $faqs_cms=CMS::where('page_section','FAQS')->first();
        $faqs=FAQ::where('status','1')->orderBy('id','DESC')->get();
        $document_cms=CMS::where('page_name','Home Page')->where('page_section','Document Section')->first();
        return view('front.faqs',compact('document_cms','banner','faqs','faqs_cms'));
    }
	
	public function contact(Request $request){
        if($request->method() == 'POST'){
            $validator = Validator::make($request->all(),[

                'name' => 'required|regex:/^[\pL\s\-]+$/u|max:255',
                'phone' => 'required|min:12',
                'address' => 'required',
                // 'question' => 'required|regex:/^[\pL\s\-]+$/u|max:255',
                // 'email' => 'required|email|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',

            ],$this->messages, $this->attributes);

            if($validator->fails()){
                return Redirect()->back()->withErrors($validator)->withInput();
            }
            if(Auth::check()){
            $user=User::where('id',auth()->user()->id)->first();
            $inquiry =new Inquiry();
            $inquiry->name=$request->name;
            $inquiry->phone=$request->phone;
			$inquiry->purpose=$request->purpose;
			$inquiry->address=$request->address;
            $inquiry->message=$request->message;
            $inquiry->message=$request->message;
            $inquiry->email=$user->email;
            if(auth()->user()->organization != null){
                $inquiry->organization=auth()->user()->organization;
            }
            $inquiry->user_id=auth()->user()->id;
            }
            else{
                return redirect('account/login')->with('error','Login befor posting an Inquiry!');
            }
			$inquiry->save();
            $user=User::first();
            Notification::send($user, new OffersNotification($inquiry));
            return redirect('contact')->with('message', 'Your Inquiry Has Been Submitted Successfully!');
        }
        $banner=Banner::where('page_name','Contact Us')->first();
        $contact_cms=CMS::where('page_name','Contact Us')->first();
        $document_cms=CMS::where('page_name','Home Page')->where('page_section','Document Section')->first();
        return view('front.contact',compact('document_cms','banner','contact_cms'));
    }

    public function whyChoose(){
        $banner=Banner::where('page_name','Why Choose Us')->first();
        $why_choose_us=Choose::orderBy('id','DESC')->where('status',1)->get();
        $document_cms=CMS::where('page_name','Home Page')->where('page_section','Document Section')->first();
        $choose_us_cms=CMS::where('page_name','Why Choose Us')->first();
        return view('front.why-choose',compact('document_cms','banner','why_choose_us','choose_us_cms'));
    }   
	
	public function document(Request $request){
		  $validator = Validator::make($request->all(), [
            'upload_file' => 'mimes:doc,docx,pdf|max:2000000',
        ], $this->messages, $this->attributes);

        if($validator->fails())
            return redirect()->back()->with('error','File Type must be doc,dox,pdf');

        $document = new Doc();
        if($request->hasfile('upload_file'))
        {
            $file = $request->file('upload_file');
            $extention = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extention;
            $file->move(public_path('uploads/admin/Doc/'),$filename);
            $document->upload_file = 'uploads/admin/Doc/'.$filename;
        }
            $document->save();
            return redirect()->back()->with('message','Your Documentation Has Been Uploaded Successfully!');
    }

        public function accountLogin(){
            if(Auth::check()){ 
                return redirect('/');
            }else{
                $document_cms=CMS::where('page_name','Home Page')->where('page_section','Document Section')->first();
                $banner=Banner::where('page_name','LOGIN')->first();
                return view('auth.user-login',compact('banner','document_cms'));
            }
        }

        public function passwordRest(){
            return route('passwors/reset');
        }
        
        public function terms(){
            $banner=Banner::where('page_name','Terms & Conditions')->first();
            $tns_cms=CMS::where('page_name','Terms & Conditions')->first();
            $document_cms=CMS::where('page_name','Home Page')->where('page_section','Document Section')->first();
            return view('front.terms',compact('banner','tns_cms','document_cms'));
        }

        public function login(){
            $banner=Banner::where('page_name','LOGIN')->first();
            return view('auth.login',compact('banner'));
        }
         public function userRegister(){
            $banner=Banner::where('page_name','USER_REGISTER')->first();
            return view('auth.user-register',compact('banner'));
        }
          public function vendorRegister(){
            $banner=Banner::where('page_name','VENDOR_REGISTER')->first();
            return view('auth.vendor-register',compact('banner'));
        }

}