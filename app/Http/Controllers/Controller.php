<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\model\Config;
use App\model\ViewersIp;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use QuickBooksOnline\API\DataService\DataService;
use QuickBooksOnline\API\Core\OAuth\OAuth2\OAuth2LoginHelper;
use Session;
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function getQuickbookService() {
    	$refreshToken = Config::findorFail(1967);
    	if(Carbon::now()->diffInHours($refreshToken->created_at) > 90) {
    		$oauth2LoginHelper = new OAuth2LoginHelper(config('services.data_service.client_id'),config('services.data_service.client_secret'));
			$accessTokenObj = $oauth2LoginHelper->refreshAccessTokenWithRefreshToken(returnFlag(1967));
			$accessToken = $accessTokenObj->getAccessToken();
			$refreshToken = $accessTokenObj->getRefreshToken();
			
			$aTConfig = Config::firstOrNew(array('flag_type' => 'QUICKBOOK_ACCESS_TOKEN'));
	      	$aTConfig->flag_value = $accessToken;
	      	$aTConfig->save();

	      	$aTConfig = Config::firstOrNew(array('flag_type' => 'QUICKBOOK_REFRESH_TOKEN'));
	      	$aTConfig->flag_value = $refreshToken;
	      	$aTConfig->save();
		}
    	$accessToken = Config::findorFail(1966);
	    if(Carbon::now()->diffInHours($accessToken->created_at) > 0) {
	      $dataService = DataService::Configure(array(
	           'auth_mode' => 'oauth2',
	           'ClientID'        => config('services.data_service.client_id'),
	           'ClientSecret'    => config('services.data_service.client_secret'),
	           'refreshTokenKey' => returnFlag(1967),
	           'QBORealmID'      => returnFlag(1968),
	           'baseUrl'         => config('services.data_service.base_url'),
	      ));
	      $OAuth2LoginHelper = $dataService->getOAuth2LoginHelper();
	      $refreshedTokenObj = $OAuth2LoginHelper->refreshToken();

	      $accessToken = $refreshedTokenObj->getAccessToken();
	      $aTConfig = Config::firstOrNew(array('flag_type' => 'QUICKBOOK_ACCESS_TOKEN'));
	      $aTConfig->flag_value = $accessToken;
	      $aTConfig->save();

	      $refreshToken = $refreshedTokenObj->getRefreshToken();
	      $aTConfig = Config::firstOrNew(array('flag_type' => 'QUICKBOOK_REFRESH_TOKEN'));
	      $aTConfig->flag_value = $refreshToken;
	      $aTConfig->save();
    	}
    	
		return DataService::Configure(array(
	        'auth_mode'       => 'oauth2',
	        'ClientID'        => config('services.data_service.client_id'),
	        'ClientSecret'    => config('services.data_service.client_secret'),
	        'accessTokenKey'  => returnFlag(1966),
	        'refreshTokenKey' => returnFlag(1967),
	        'QBORealmID'      => returnFlag(1968),
	        'baseUrl'         => config('services.data_service.base_url'),
	     ));

	}


	// GET USER IP AND STORE IN DB
	public function userIp(){
        $keys = array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR');

    foreach ($keys as $key) {
        if (array_key_exists($key, $_SERVER) === true) {
            foreach (explode(',', $_SERVER[$key]) as $ip) {
                if (filter_var($ip, FILTER_VALIDATE_IP) !== false) {
                	return $ip;
                }
            }
        }
    }
    }
}

// $testObject = new Controller();
// $userIp=ViewersIp::where('ip_address',$testObject->userIp())->first();
// $IP=$testObject->userIp();
// // run curl request to find location info with ip address
//     $ch = curl_init('https://ipinfo.io/$IP?token=pk.eyJ1IjoiaG1teTAwOTAiLCJhIjoiY2xmOG1uaHNnMXJsajQxbzFydXZtbzNheiJ9.TyH8afoKtduom_wVHOStOQ');
//     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//     // execute!
//     $response = curl_exec($ch);
//     $result = json_decode($response);
//     dd($result);
// $userViews=new ViewersIp();
// if(!isset($userIp) && $testObject->userIp() != null){
// $userViews->ip_address=$testObject->userIp();
// $userViews->save();
// }
	// GET USER IP AND STORE IN DB

