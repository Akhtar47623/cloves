<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */  

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    protected function authenticated(Request $request, $user){
        if($user->hasRole('admin')){
        return response()->json(['roles'=> 'admin']);
            // return redirect('/admin')->with('message','Login Successfully!');
        }
        else if($user->hasRole('user')){
        return response()->json(['roles'=> 'user']);
            // return redirect('/user')->with('message','Your are Loggin Successfully!');
        }
        else if($user->hasRole('vendor')){
            //     public function userIp(){
            //     $keys = array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR');
            // foreach ($keys as $key) {
            //     if (array_key_exists($key, $_SERVER) === true) {
            //         foreach (explode(',', $_SERVER[$key]) as $ip) {
            //             if (filter_var($ip, FILTER_VALIDATE_IP) !== false) {
            //                 return $ip;
            //             }
            //         }
            //     }
            // }
            // }
            // $userIp=ViewersIp::where('ip_address',$testObject->userIp())->first();
            // $ip=$testObject->userIp();
            // $loc=file_get_contents("http://ipinfo.io/$ip");
            // $locc=json_decode($loc);
        return response()->json(['roles'=> 'vendor']); 
            // return redirect('/vendor/dashboard')->with('message','Your are Loggin Successfully!');
        }
        else{
            return redirect('/account/login')->with('error','Your Credentials do not matched!');
            Auth::logout();
        }
            
    }
    // protected function login(Request $request){
    //     dd('here');
    // }
}
