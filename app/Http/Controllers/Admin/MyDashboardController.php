<?php
namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\model\MyDashboard;
use App\model\Order;
use App\model\ViewersIp;
use App\model\ServiceGallery;
use Validator;
use File;
use Illuminate\Http\Request;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Session;
use Carbon\Carbon;

class MyDashboardController extends Controller
{
     private $messages = [
        'title.required' => 'Provide a :attribute',
        'short_description.required' => 'Provide :attribute',
        'long_description.required' => 'Provide :attribute',
        'image_path.required' => 'Provide :attribute',
        'image_path.mimes' => 'Provide:attribute of jpeg,jpg or png Type',
        'image.required' => 'Provide :attribute',
        'image.mimes' => 'Provide:attribute of jpeg,jpg or png Type',
        'gallery_image.required' => 'Provide :attribute',
        'gallery_image.min' => ':attribute must be at least Two',
        'gallery_image.mimes' => 'Provide:attribute of jpeg,jpg or png Type',
    ];
    private $attributes = [
        'title' => 'Title',
        'slug' => 'Slug',
        'short_description' => 'Short Description',
        'long_description' => 'Long Description',
        'image_path' => 'Image',
        'image' => 'Image',
        'gallery_image' => 'Gallery Images'
    ];

	public function index(){
        $current_week=Order::whereBetween('created_at', [ Carbon::parse('last monday')->startOfDay(), Carbon::parse('next friday')->endOfDay(),])->get();
        $previous_week=Order::whereBetween('created_at', [Carbon::now()->subWeek()->startOfWeek(), Carbon::now()->subWeek()->endOfWeek()])->get();
        // Current Year Data
        $jan=Order::whereYear('created_at',  Carbon::now()->year)->whereMonth('created_at', '1')->count();
        $feb=Order::whereYear('created_at',  Carbon::now()->year)->whereMonth('created_at', '2')->count();
        $march=Order::whereYear('created_at',  Carbon::now()->year)->whereMonth('created_at', '3')->count();
        $april=Order::whereYear('created_at',  Carbon::now()->year)->whereMonth('created_at', '4')->count();
        $may=Order::whereYear('created_at',  Carbon::now()->year)->whereMonth('created_at', '5')->count();
        $jun=Order::whereYear('created_at',  Carbon::now()->year)->whereMonth('created_at', '6')->count();
        $july=Order::whereYear('created_at',  Carbon::now()->year)->whereMonth('created_at', '7')->count();
        $aug=Order::whereYear('created_at',  now()->subYear()->year)->whereMonth('created_at', '8')->count();
        $sep=Order::whereYear('created_at',  Carbon::now()->year)->whereMonth('created_at', '9')->count();
        $oct=Order::whereYear('created_at',  Carbon::now()->year)->whereMonth('created_at', '10')->count();
        $nov=Order::whereYear('created_at',  Carbon::now()->year)->whereMonth('created_at', '11')->count();
        $dec=Order::whereYear('created_at',  Carbon::now()->year)->whereMonth('created_at', '12')->count();
        // Current Year Data
        // Previous Year Data
         $previous_jan=Order::whereYear('created_at',  now()->year-1)->whereMonth('created_at', '1')->count();
        $previous_feb=Order::whereYear('created_at',  now()->year-1)->whereMonth('created_at', '2')->count();
        $previous_march=Order::whereYear('created_at', now()->year-1)->whereMonth('created_at', '3')->count();
        $previous_april=Order::whereYear('created_at', now()->year-1)->whereMonth('created_at', '4')->count();
        $previous_may=Order::whereYear('created_at',  now()->year-1)->whereMonth('created_at', '5')->count();
        $previous_jun=Order::whereYear('created_at',  now()->year-1)->whereMonth('created_at', '6')->count();
        $previous_july=Order::whereYear('created_at', now()->year-1)->whereMonth('created_at', '7')->count();
        $previous_aug=Order::whereYear('created_at',  now()->subYear()->year)->whereMonth('created_at', '8')->count();
        $previous_sep=Order::whereYear('created_at',  now()->year-1)->whereMonth('created_at', '9')->count();
        $previous_oct=Order::whereYear('created_at',  now()->year-1)->whereMonth('created_at', '10')->count();
        $previous_nov=Order::whereYear('created_at',  now()->year-1)->whereMonth('created_at', '11')->count();
        $previous_dec=Order::whereYear('created_at',  now()->year-1)->whereMonth('created_at', '12')->count();

        $delivery=Order::orderBy('id','DESC')->where('order_type','D')->count();
        $pickup=Order::orderBy('id','DESC')->where('order_type','P')->count();
		$task=Order::orderBy('id','DESC')->where('order_type','T')->count();
        // Order Status
        $pending=Order::where('delivery_status','pending')->count();
        $delivered=Order::where('delivery_status','delivered')->count();
        $dispatched=Order::where('delivery_status','dispatched')->count();
        // Order Status
        $crnt_mnth_views=ViewersIp::whereYear('created_at', now()->year)->whereMonth('created_at',now()->month)->count();
        $pre_mnth_views=ViewersIp::whereYear('created_at', now()->year)->whereMonth('created_at',now()->month -1)->count();
        $total_views=ViewersIp::all()->count();
        
		return view('admin.MyDashboard.index',compact('delivery','pickup','task','jan','feb','march','april','may','jun','july','aug','sep','oct','nov','dec','previous_jan','previous_feb','previous_march','previous_april','previous_may','previous_jun','previous_july','previous_aug','previous_sep','previous_oct','previous_nov','previous_dec','pending','delivered','dispatched','crnt_mnth_views','pre_mnth_views','total_views'));
	}
	 public function check_slug(Request $request)
    {
        $slug = MyDashboard::createSlug(MyDashboard::class , 'slug', $request->title);
        return response()->json(['slug' => $slug]);
    }


    public function show($slug) {
        $Mydashboard = MyDashboard::where('slug',$slug)->first();
        // $gallery_image = ServiceGallery::where('product_id',$Mydashboard->id)->get();
        return view('admin.MyDashboard.view', compact('Mydashboard'));
    }

    public function create() {
        return view('admin.MyDashboard.add');
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'source_location' => 'required',
            'destination_location' => 'required',
            'shipping_price' => 'required',
            'total_distance' => 'required',
            'total_amount' => 'required',
        ], $this->messages, $this->attributes);

        if($validator->fails())
            return redirect()->back()->withErrors($validator)->withInput();
        $Mydashboard = new Price;
        $Mydashboard->service_location=$request->service_location;
        $Mydashboard->service_long=$request->service_long;
        $Mydashboard->service_lat=$request->service_lat;
        $Mydashboard->source_location=$request->source_location;
        $Mydashboard->destination_location=$request->destination_location;
        $Mydashboard->shipping_price=$request->shipping_price;
        $Mydashboard->total_distance=$request->total_distance;
        $Mydashboard->total_amount=$request->total_amount;
        $Mydashboard->save();
        return redirect('/admin/pricing')->with('message', 'New Price Has Been Added!');
    }

    public function edit($id) {
        $Mydashboard = MyDashboard::where('id',$id)->first();
        return view('admin.MyDashboard.edit', compact('prices'));
    }

    public function update(Request $request , $id) {

        $validator = Validator::make($request->all(), [
            'source_location' => 'required',
            'destination_location' => 'required',
            'shipping_price' => 'required',
            'total_distance' => 'required',
            'total_amount' => 'required',
        ], $this->messages, $this->attributes);

        if($validator->fails())
            return redirect()->back()->withErrors($validator->errors());
        $source_location=$request->source_location;
        $destination_location=$request->destination_location;
        $shipping_price=$request->shipping_price;
        $total_distance=$request->total_distance;
        $total_amount=$request->total_amount;
            MyDashboard::where('id', $id)
                ->update([
                    'source_location'=> $source_location,
                    'destination_location'=> $destination_location,
                    'shipping_price'=> $shipping_price,
                    'total_distance'=> $total_distance,
                    'total_amount' => $total_amount
                ]);

        return redirect('admin/pricing')->with('message', 'Price Record is Updated!');
    }

    public function destroy($id) {
        $price=MyDashboard::where('id',$id)->first();
        $price=MyDashboard::where('id',$id)->delete();
        Session::flash('flash_message', 'Price Has Been Deleted!');
        return redirect('admin/pricing');
    }

}