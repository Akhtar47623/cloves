<?php
namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\model\Inquiry;
use App\model\Service;
use App\model\ServiceGallery;
use Validator;
use File;
use Illuminate\Http\Request;
use Cviebrock\EloquentSluggable\Services\SlugService;

use Session;

class ServicesController extends Controller
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
		$services=Service::orderBy('id','DESC')->get();
		return view('admin.Services.index',compact('services'));
	}
	 public function check_slug(Request $request)
    {
        $slug = SlugService::createSlug(Service::class , 'slug', $request->title);
        return response()->json(['slug' => $slug]);
    }


    public function show($slug) {
        $services = Service::where('slug',$slug)->first();
        // $gallery_image = ServiceGallery::where('product_id',$services->id)->get();
        return view('admin.Services.view', compact('services'));
    }

    public function create() {
        return view('admin.Services.add');
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'slug' => 'required',
            'image_path' => 'required|mimes:jpeg,jpg,png|max:2000000',
            // 'image1' => 'required|mimes:jpeg,jpg,png|max:2000000',
            'description' => 'required',
            // 'long_description' => 'required',
            // 'gallery_image' => 'required|min:2',
            // 'gallery_image.*'  => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], $this->messages, $this->attributes);

        if($validator->fails())
            return redirect()->back()->withErrors($validator)->withInput();
        $services = new Service;
        $services->title=$request->title;
        $services->slug=$request->slug;
        $services->description=$request->description;
        $services->long_description=$request->long_description;
        $services->status=1;
        if($request->hasfile('image_path'))
        {
            $file = $request->file('image_path');
            $extention = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extention;
            $file->move(public_path('uploads/admin/services_images/'),$filename);
            $services->image_path = $request->image;
            $services->image_path = 'uploads/admin/services_images/'.$filename;
        }
         if($request->hasfile('image1'))
        {
            $file = $request->file('image1');
            $extention = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extention;
            $file->move(public_path('uploads/admin/services_images/'),$filename);
            $services->image1 = $request->image;
            $services->image1 = 'uploads/admin/services_images/'.$filename;
        }
        $services->save();
        return redirect('/admin/services')->with('message', 'New Service is Added!');
    }

    public function edit($id) {
        $services = Service::where('id',$id)->first();
        // $service_gallery = ServiceGallery::where('product_id',$id)->orderBy('id','DESC')->take(2)->get();
        return view('admin.Services.edit', compact('services'));
    }

    public function update(Request $request , $id) {

        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'slug' => 'required',
            // 'image_path' => 'required|mimes:jpeg,jpg,png|max:2000000',
            'description' => 'required',
            'long_description' => 'required', 
            // 'gallery_image' =>'min:2',
        ], $this->messages, $this->attributes);

        if($validator->fails())
            return redirect()->back()->withErrors($validator->errors());

        $title = $request->title;
        $slug = $request->slug;
        $description = $request->description;
        $long_description = $request->long_description;
        $status = $request->status;
        $validArr = array();
        if($request->file('image_path')) {
            $validArr['image_path'] = 'required|mimes:jpeg,jpg,png,gif|required|max:10000';
        }
        $this->validate($request, $validArr);
        $requestData = $request->all();
        $services = Service::where('id', $id)->first();
        if($request->hasfile('image_path'))
        {
             $destination2 = public_path().'/'.$services->image_path;
            if (File::exists($destination2)) {
                File::delete($destination2);
            }
            $file2 = $request->file('image_path');
            $extention2 = $file2->getClientOriginalExtension();
            $filename2 = time().'1.'.$extention2;
            $file2->move(public_path('uploads/admin/services_images/'),$filename2);
            Service::where('id', $id)
                ->update(['image_path' => 'uploads/admin/services_images/'.$filename2,'title'=> $title,'slug'=> $slug, 'description' => $description,'long_description' => $long_description]);
        }
         if($request->hasfile('image1'))
        {
             $destination3 = public_path().'/'.$services->image1;
            if (File::exists($destination3)) {
                File::delete($destination3);
            }
            $file3 = $request->file('image1');
            $extention3 = $file3->getClientOriginalExtension();
            $filename3 = time().'1.'.$extention3;
            $file3->move(public_path('uploads/admin/services_images/'),$filename3);
            Service::where('id', $id)
                ->update(['image1' => 'uploads/admin/services_images/'.$filename3,'title'=> $title,'slug'=> $slug, 'description' => $description,'long_description' => $long_description]);
        }

        else{
            Service::where('id', $id)
                ->update([
                    'title'=> $title,
                    'slug'=> $slug,
                    'description'=> $description,
                    'long_description'=> $long_description,
                    'status' => $status
                ]);
        }

        return redirect('admin/services')->with('message', 'Service Record is Updated!');
    }

    public function destroy($slug) {
        $service=Service::where('slug',$slug)->first();
        // ServiceGallery::where('product_id',$service->id)->delete();
        $service=Service::where('slug',$slug)->delete();
        Session::flash('flash_message', 'Service Has Been Deleted!');
        return redirect('admin/services');
    }

}