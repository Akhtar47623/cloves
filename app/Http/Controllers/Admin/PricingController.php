<?php
namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\model\Inquiry;
use App\model\Price;
use App\model\ServiceGallery;
use Validator;
use File;
use Illuminate\Http\Request;
use Cviebrock\EloquentSluggable\Services\SlugService;

use Session;

class PricingController extends Controller
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
		$prices=Price::orderBy('id','DESC')->get();
		return view('admin.Pricing.index',compact('prices'));
	}
	 public function check_slug(Request $request)
    {
        $slug = SlugPrice::createSlug(Price::class , 'slug', $request->title);
        return response()->json(['slug' => $slug]);
    }


    public function show($slug) {
        $prices = Price::where('slug',$slug)->first();
        // $gallery_image = ServiceGallery::where('product_id',$prices->id)->get();
        return view('admin.Pricing.view', compact('prices'));
    }

    public function create() {
        return view('admin.Pricing.add');
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
        $prices = new Price;
        $prices->service_location=$request->service_location;
        $prices->service_long=$request->service_long;
        $prices->service_lat=$request->service_lat;
        $prices->source_location=$request->source_location;
        $prices->destination_location=$request->destination_location;
        $prices->shipping_price=$request->shipping_price;
        $prices->total_distance=$request->total_distance;
        $prices->total_amount=$request->total_amount;
        $prices->save();
        return redirect('/admin/pricing')->with('message', 'New Price Has Been Added!');
    }

    public function edit($id) {
        $prices = Price::where('id',$id)->first();
        return view('admin.Pricing.edit', compact('prices'));
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
            Price::where('id', $id)
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
        $price=Price::where('id',$id)->first();
        $price=Price::where('id',$id)->delete();
        Session::flash('flash_message', 'Price Has Been Deleted!');
        return redirect('admin/pricing');
    }

}