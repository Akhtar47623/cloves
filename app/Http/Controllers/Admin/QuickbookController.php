<?php

namespace App\Http\Controllers\Admin; 

use App\Http\Controllers\Controller;

use QuickBooksOnline\API\DataService\DataService;
use QuickBooksOnline\API\Core\Http\Serialization\XmlObjectSerializer;
use QuickBooksOnline\API\Facades\Invoice;
use QuickBooksOnline\API\Facades\Customer;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\model\Config;


class QuickbookController extends Controller
{
  protected $dataService;

  public function __construct() {
      $this->dataService = DataService::Configure(array(
        'auth_mode' => 'oauth2',
        'ClientID' => config('services.data_service.client_id'),
        'ClientSecret' => config('services.data_service.client_secret'),
        'RedirectURI' => route('admin.quickbook.connect.callback'),
        'scope' => config('services.data_service.scope'),
        'baseUrl' => config('services.data_service.base_url'),
      ));
  }

  public function connect() {
    $OAuth2LoginHelper = $this->dataService->getOAuth2LoginHelper();
    $authorizationCodeUrl = $OAuth2LoginHelper->getAuthorizationCodeURL();
    return redirect($authorizationCodeUrl);
  }

  public function connectCallback() {
    $OAuth2LoginHelper =$this->dataService->getOAuth2LoginHelper();
    $accessTokenObj = $OAuth2LoginHelper->exchangeAuthorizationCodeForToken($_GET['code'], $_GET['realmId']);
    $accessToken = $accessTokenObj->getAccessToken();
    $updateToken=$this->dataService->updateOAuth2Token($accessTokenObj);
    $refreshToken= $accessTokenObj->getRefreshToken();

    $aTConfig = Config::firstOrNew(array('flag_type' => 'QUICKBOOK_ACCESS_TOKEN'));
    $aTConfig->flag_value = $accessToken;
    $aTConfig->save();

    $aTConfig = Config::firstOrNew(array('flag_type' => 'QUICKBOOK_REAL_MID'));
    $aTConfig->flag_value = $_GET['realmId'];
    $aTConfig->save();

    $rTConfig = Config::firstOrNew(array('flag_type' => 'QUICKBOOK_REFRESH_TOKEN'));
    $rTConfig->flag_value = $refreshToken;
    $rTConfig->save();

    return redirect('/admin/');
  }
}