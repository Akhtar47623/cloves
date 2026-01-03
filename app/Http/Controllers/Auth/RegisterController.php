<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use App\Profile;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use QuickBooksOnline\API\DataService\DataService;
use QuickBooksOnline\API\Core\Http\Serialization\XmlObjectSerializer;
use QuickBooksOnline\API\Facades\Invoice;
use QuickBooksOnline\API\Facades\Customer;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Auth;
use Session;
use Cookie;
use App\Model\Config;
use Carbon\Carbon;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;


    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }    
        /**
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {   

        if($data['userRole'] =='vendor'){
        $validator = Validator::make($data, [
            'phone' => ['required'],
            'location' => ['required'],
            'reg_email' => ['required', 'string', 'email', 'max:255', 'unique:users,email','regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix'],
            'reg_password' => ['required', 'string', 'min:8', 'same:password_confirmation','required_with:password_confirmation'],
            'organization' => ['required', 'string','max:255'],
            ],
            [
            'organization.required' => 'Provide Your Organization',
            'reg_email.required' => 'Provide Your Email',
            'reg_email.unique' => 'Email Already Exist',
            'reg_password.required' => 'Create Password',
            'location.required' => 'Provide Location',
            'phone.required' => 'Provide Phone Number',
            ]
        );
        $validator->setAttributeNames([
            'reg_email' => 'Email',
            'reg_password' => 'Password',
            'organization' =>'Organization',
            'phone' => 'phone',
        ]);

        // if($validator->fails())
        Session::flash('register_error', 'This is a message!'); 
        return $validator;  
    }
    elseif($data['userRole']=='user'){

        $validator = Validator::make($data, [
            'first_name' => ['required','string','regex:/^[\pL\s\-]+$/u', 'max:255'],
            'last_name' => ['required', 'string','regex:/^[\pL\s\-]+$/u', 'max:255'],
            'phone' => ['required'],
            'location' => ['required'],
            'reg_email' => ['required', 'string', 'email', 'max:255', 'unique:users,email','regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix'],
            'reg_password' => ['required', 'string', 'min:8', 'same:password_confirmation','required_with:password_confirmation'],
            ],
            [
            'first_name.required' => 'Provide Your First Name',
            'first_name.regex' => 'Invalid Name Format',
            'last_name.regex' => 'Invalid Name Format',
            'last_name.required' => 'Provide Your Last Name',
            'reg_email.required' => 'Provide Your Email',
            'reg_email.unique' => 'Email Already Exist',
            'reg_password.required' => 'Create Password',
            'location.required' => 'Provide Location',
            'phone.required' => 'Provide Phone Number',
            ]
        );
        $validator->setAttributeNames([
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'reg_email' => 'Email',
            'reg_password' => 'Password',
            'phone' => 'phone',
        ]);

        // if($validator->fails())
        Session::flash('register_error', 'This is a message!'); 
        return $validator;
    }
    }

     /**
     * @param  array  $data
     * @return \App\User
     */

    protected function create(array $data)
    {
        $dataService = $this->getQuickbookService();
        if($data['userRole'] == 'vendor'){
        $user  = new User;
        $user->email = $data['reg_email'];
        $user->organization = $data['organization'];
        $user->reg_no = $data['reg_no'];
        $user->org_url = $data['org_url'];
        $user->organization = $data['organization'];
        $user->phone = $data['phone'];
        $user->location = $data['location'];
        $user->country = $data['country'];
        $user->city = $data['city'];
        $user->state = $data['state'];
        $user->postal = $data['postcode'];
        $user->address = $data['address'];
        $locName = explode(",", $data['location']);
        $user->location_name = $locName[0];
        $user->order_id= strtoupper(substr($data['organization'],0,2));
        $user->password = Hash::make($data['reg_password']);
        $user->save();
        $user->assignrole('vendor');
        $profile = new Profile;
        $profile->user_id = $user->id;
        $profile->country = $data['country'];
        $profile->city = $data['city'];
        $profile->state = $data['state'];
        $profile->postal = $data['postcode'];
        $profile->address = $data['address'];
        $profile->save();
           $customerObj = Customer::create([
                "PrimaryEmailAddr" => ["Address" => $data['reg_email']],
                "DisplayName" => $data['organization'],
                "Active" => "true",
                "PrimaryPhone" => ["FreeFormNumber" => $data['phone']],
                "CustomerTypeRef" => ''.env("LEAD_ROLE").'',
                "CompanyName" => $data['organization'], 
                "BillAddr" => [
                    "City" => $data['city'],
                    "PostalCode" => $data['postcode'],
                    "Country" => $data['country'],
                    "Line1" => $data['address']

                ]
            ]);
            $resultingCustomerObj = $dataService->Add($customerObj);
            $error = $dataService->getLastError();
            if ($error) {
                echo "The Status code is: " . $error->getHttpStatusCode() . "\n";
                echo "The Helper message is: " . $error->getOAuthHelperError() . "\n";
                echo "The Response message is: " . $error->getResponseBody() . "\n";
            } 
            return $user;
        }
        elseif($data['userRole'] == 'user'){
        $user  = new User;
        $user->first_name = $data['first_name'];
        $user->last_name = $data['last_name'];
        $user->fname = $data['first_name'].' '.$data['last_name'];
        $user->email = $data['reg_email'];
        $user->phone = $data['phone'];
        $user->location = $data['location'];
        $user->country = $data['country'];
        $user->city = $data['city'];
        $user->state = $data['state'];
        $user->postal = $data['postcode'];
        $user->address = $data['address'];
        $locName = explode(",", $data['location']);
        $user->location_name = $locName[0];
        $user->order_id= strtoupper(substr($data['first_name'],0,2).substr($data['last_name'],0,2));
        $user->password = Hash::make($data['reg_password']);
        $user->save();
        $user->assignrole('user');
        $profile = new Profile;
        $profile->user_id = $user->id;
        $profile->country = $data['country'];
        $profile->city = $data['city'];
        $profile->state = $data['state'];
        $profile->postal = $data['postcode'];
        $profile->address = $data['address'];
        $profile->save();
           $customerObj = Customer::create([
                "PrimaryEmailAddr" => ["Address" => $data['reg_email']],
                "DisplayName" => $data['first_name'].' '.$data['last_name'],
                "Active" => "true",
                "PrimaryPhone" => ["FreeFormNumber" => $data['phone']],
                "CustomerTypeRef" => ''.env("LEAD_ROLE").'',
                "BillAddr" => [
                    "City" => $data['city'],
                    "PostalCode" => $data['postcode'],
                    "Country" => $data['country'],
                    "Line1" => $data['address']

                ]
            ]); 
            $resultingCustomerObj = $dataService->Add($customerObj);
            $error = $dataService->getLastError();
            if ($error) {
                echo "The Status code is: " . $error->getHttpStatusCode() . "\n";
                echo "The Helper message is: " . $error->getOAuthHelperError() . "\n";
                echo "The Response message is: " . $error->getResponseBody() . "\n";
            }
            return $user;
        }
    }

     public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        $this->guard()->login($this->create($request->all()));
        if(auth()->user()->roles[0]->name == 'vendor'){
            return redirect()->route('vendor');
        }
        else if(auth()->user()->roles[0]->name == 'user'){
            return redirect()->route('user');
        }
    }

}
