<?php
namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\model\DepotLocation;
use App\model\Price;
use App\model\ServiceGallery;
use Validator;
use File;
use Illuminate\Http\Request;
use Cviebrock\EloquentSluggable\Services\SlugService;

use Session;

class DepotLocationController extends Controller
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
		$depotLoc=DepotLocation::orderBy('id','DESC')->get();
		return view('admin.DepotLocation.index',compact('depotLoc'));
	}
	 public function check_slug(Request $request)
    {
        $slug = SlugPrice::createSlug(Price::class , 'slug', $request->title);
        return response()->json(['slug' => $slug]);
    }


    public function show($slug) {
        $depotLoc = Price::where('slug',$slug)->first();
        // $gallery_image = ServiceGallery::where('product_id',$depotLoc->id)->get();
        return view('admin.DepotLocation.view', compact('depotLoc'));
    }

    public function create() {
        return view('admin.DepotLocation.add');
    }

    public function store(Request $request) {
         $validator = Validator::make($request->all(), [
            'radius' => 'required',
        ], $this->messages, $this->attributes);

        if($validator->fails())
            return redirect()->back()->withErrors($validator)->withInput();
        $depot = new DepotLocation;
        $depot->radius=$request->radius;
        $depot->depot_long=$request->depot_long;
        $depot->depot_lat=$request->depot_lat;
        $depot->depot_location=$request->depotLoc;
        $depot->status=1;
        $depot->save();
        return redirect('admin/depot-location')->with('message', 'Depot Location Has Been Added Successfully!');

    }

    public function edit($id) {
        $depotLoc = DepotLocation::where('id',$id)->first();
        return view('admin.DepotLocation.edit', compact('depotLoc'));
    }

    public function update(Request $request , $id) {
        $depotLocation = DepotLocation::findorFail($id);
        $validator = Validator::make($request->all(), [
        ], $this->messages, $this->attributes);

        if($validator->fails())
            return redirect()->back()->withErrors($validator->errors());
        $depot_long = ($request->depot_long != null)? $request->depot_long: $depotLocation->depot_long;
        $depot_lat=($request->depot_lat != null)? $request->depot_lat: $depotLocation->depot_lat;
        $depotLoc=($request->depotLoc != null)? $request->depotLoc: $depotLocation->depot_location;
        $radius=($request->radius != null)? $request->radius: $depotLocation->radius;
        $status=($request->status != null)? $request->status: $depotLocation->status;
            DepotLocation::where('id', $id)
                ->update([
                    'depot_long'=> $depot_long,
                    'depot_lat'=> $depot_lat,
                    'depot_location'=> $depotLoc,
                    'radius'=> $radius,
                    'status'=> $status,
                ]);

        return redirect('admin/depot-location')->with('message', 'Depot Location Has Been Updated Successfully!');
    }
    public function destroy($id) {

            DepotLocation::destroy($id);

            Session::flash('flash_message', 'Depot Has Been Deleted!');

            return redirect('/admin/depot-location');

        }

}