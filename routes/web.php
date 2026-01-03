<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\NotificationController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/




// WEB ROUTES
Route::any('/', 'Web\HomeController@index')->name('webIndexPage');
Route::any('/delivery-request', 'Web\HomeController@contactForm')->name('contactFormPage');
Route::any('/about', 'Web\HomeController@about')->name('webAboutPage');
Route::any('/service', 'Web\HomeController@Service')->name('webServicePage');
Route::any('/request', 'Web\HomeController@deliveryService')->name('webRequestPage');
Route::any('/uplaod-document', 'Web\HomeController@document')->name('uploadDocument');
Route::any('/faqs', 'Web\HomeController@faqs')->name('webFaqsPage');
Route::any('/why-choose', 'Web\HomeController@WhyChoose')->name('webWhyChoosePage');
Route::any('/contact', 'Web\HomeController@Contact')->name('webContactPage');
Route::any('/newsletter', 'Web\HomeController@newsletter')->name('newsletter');
Route::any('account/login', 'Web\HomeController@accountLogin')->name('Login');
Route::any('login/callbackindex', 'Auth\RegisterController@callbackindex');
Route::any('login/callback', 'Auth\RegisterController@callback');
Route::any('password/reset', 'Web\HomeController@passwordRest')->name('PasswordReset');
Route::any('terms-and-conditions', 'Web\HomeController@terms')->name('webTermsPage');
Route::any('user-register', 'Web\HomeController@userRegister')->name('userRegisterPage');
Route::any('vendor-register', 'Web\HomeController@vendorRegister')->name('vendorRegisterPage');


// WEB ROUTES

// EXCEL ROUTES
Route::any('importExportView', 'Export\ExcelController@importExportView');
Route::any('export', 'Export\ExcelController@export')->name('export');
Route::any('import', 'Export\ExcelController@import')->name('import');
Route::any('export/user', 'Export\ExcelController@userExport')->name('userExport');
Route::any('export/order', 'Export\ExcelController@orderExport')->name('orderExport');
Route::any('export/invoice', 'Export\ExcelController@invoiceExport')->name('invoiceExport');
Route::any('download/sample', 'Export\ExcelController@downloadSample')->name('downloadSample');



Route::get('logout','Auth\LoginController@logout')->name('logout');

Auth::routes();
// Route::group(['prefix' =>'admin', 'middleware' =>['roles' =>'admin']],function(){
//     Route::get('dashboard','Admin\HomeController@Dashboard')->name('dashboard');
// });
// Route::group(['prefix' =>'account', 'middleware' =>['roles' =>'user']],function(){
//     Route::get('home','Web\HomeController@index')->name('home');
// });
Route::group(['middleware' => ['auth', 'roles'],'roles' => 'admin','prefix'=>'admin'], function (){
    Route::get('/quickbook/connect', 'Admin\QuickbookController@connect')->name('admin.quickbook.connect');
    Route::get('/quickbook/connect/callback', 'Admin\QuickbookController@connectCallback')->name('admin.quickbook.connect.callback');


    Route::resource('channel', 'Admin\ChannelController');
    // Route::get('','Auth\LoginController@login')->name('UserLogin');
    Route::get('/','Admin\HomeController@dashboard');
    Route::any('config','Admin\ConfigController@update')->name('config_settings_update');
    Route::any('favicon','Admin\HomeController@faviconUpload')->name('favicon');
    Route::any('header-logo', 'Admin\HomeController@updateLogo')->name('StoreWebLogo');
    Route::any('footer-logo', 'Admin\HomeController@footerLogo')->name('StoreWebLogo');
    Route::any('account/profile','Admin\HomeController@profile')->name('profile');
    Route::get('check_slug', 'Admin\ServicesController@check_slug')->name('check_slug');
    Route::resource('/dashboard','Admin\MyDashboardController');
    Route::resource('banner', 'Admin\BannerController');
    Route::resource('customer', 'Admin\CustomerController');
    Route::resource('faqs', 'Admin\FAQSController');
    Route::resource('faqs-content', 'Admin\FAQSContentController');
    Route::resource('document', 'Admin\DocumentController');
    Route::resource('location', 'Admin\LocationController');
    Route::resource('delivery-inquiry', 'Admin\DeliveryInquiryController'); 
    Route::resource('partner-content', 'Admin\PartnerContentController'); 
    Route::resource('hiring-process','Admin\HiringProcessController');
    Route::resource('main-banner', 'Admin\MainBannerController');
    Route::resource('homepage','Admin\HomePageController');
    Route::resource('homepage-content','Admin\HomepageContentController');
    Route::resource('services-content','Admin\ServicesContentController');
    Route::resource('services','Admin\ServicesController');
    Route::resource('why-choose-us','Admin\ChooseUsController');
    Route::resource('choose-us-content','Admin\ChooseUsContentController');
    Route::resource('gallery','Admin\GalleryController');
    Route::post('trailer/upload','Admin\TrailerController@upload');
    Route::resource('trailer/delete','Admin\TrailerController@destroy');
    Route::resource('about-us','Admin\AboutUsContentController');
    Route::resource('membership','Admin\MembershipController');
    Route::resource('contact-us','Admin\ContactUsController');
    Route::resource('application-content','Admin\ApplicationContentController');
    Route::resource('newsletters','Admin\NewsController');
    Route::any('newsletter/{id}','Admin\NewsController@destroy');
    Route::resource('inquiry','Admin\InquiryController');
    Route::resource('booking','Admin\BookingController');
    Route::resource('pricing','Admin\PricingController');
    Route::resource('depot-location','Admin\DepotLocationController');
    Route::resource('testimonial','Admin\TestimonialController');
    Route::resource('testimonial-content','Admin\TestimonialContentController');
    Route::resource('footer-menu','Admin\FooterController');
    Route::resource('terms-conditions','Admin\TNCController');
    Route::resource('users','Admin\UserController');
    Route::resource('user-management','Admin\UserManagementController');
    Route::any('user-managementt','Admin\UserManagementController@edit')->name('user-management');
    Route::resource('/invoice', 'Admin\InvoiceController');
    Route::any('/invoice-filter', 'Admin\InvoiceController@index')->name('invoiceFilter');
    Route::any('/callback', 'Admin\QuickBooksController@callback');
    Route::any('/callbackindex', 'Admin\QuickBooksController@callbackindex');
    Route::any('/delivery-order', 'Admin\DeliveryController@delivery');
    Route::get('auto-complete-address', 'Admin\AutoAddressController@googleAutoAddress');
    Route::resource('order','Admin\OrderController');
    Route::resource('orders', 'user\OrderController');
    Route::resource('estimate','Quickbook\EstimateController');
    Route::resource('product-category','Quickbook\CategoryController');
    Route::resource('product','Quickbook\ProductController');
    Route::any('order-import', 'Export\ExcelController@batchImport')->name('orderImport');
    // Route::resource('/invoiceread', 'Admin\QuickBooksController@invoiceRead');
    // Route::resource('/invoiceread', 'Admin\QuickBooksController@invoiceRead');
    Route::post('order/create','Admin\OrderController@orderCreate');
    Route::get('/users','Admin\HomeController@userDisplay');
    Route::get('/user-edit/{id}','Admin\HomeController@UserEdit');
    Route::post('/user/delete/{id}','Admin\HomeController@UserDelete');
    Route::put('/user-update/{id}','Admin\HomeController@UserUpdate');
    Route::get('/user/{id}','Admin\HomeController@ShowUser');
    Route::any('invoice-pdf/{Id}', array('as'=> 'generate.invoice.pdf', 'uses' => 'Admin\InvoiceController@generateInvoicePDF'))->name('invoice');
    Route::any('send-invoice/{Id}','Admin\InvoiceController@sendInvoice');
    Route::get('/markAsRead/{id}', function($id){
        auth()->user()->unreadNotifications->where('id', $id)->markAsRead();
        return redirect()->back();
    });
    Route::get('/markAsRead', function(){
        auth()->user()->unreadNotifications->take(5)->markAsRead();
        return redirect()->back();
    });


});



Route::group(['middleware' => ['auth', 'roles'],'roles' => 'user','prefix'=>'user'], function (){
    Route::resource('channel', 'Admin\ChannelController');
    Route::get('/','Admin\HomeController@dashboard')->name('user');
    Route::any('account/profile','Admin\HomeController@profile')->name('profile');
    // Route::resource('order','Admin\orderController');
    Route::resource('order', 'user\OrderController');
    Route::any('import-orders', 'Export\ExcelController@import')->name('OrdersImport');
    Route::resource('fav-job', 'user\FavoriteJobController');

});

Route::group(['middleware' => ['auth', 'roles'],'roles' => 'vendor','prefix'=>'vendor'], function (){
    Route::resource('channel', 'Admin\ChannelController');
    Route::any('/dashboard','Admin\HomeController@dashboard')->name('vendor');
    Route::any('import-orders', 'Export\ExcelController@import')->name('OrdersImport');
    Route::any('account/profile','Admin\HomeController@profile')->name('profile');
    // Route::resource('order','Admin\orderController');
    Route::resource('order', 'user\OrderController');
    Route::resource('fav-job', 'user\FavoriteJobController');

});




Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
