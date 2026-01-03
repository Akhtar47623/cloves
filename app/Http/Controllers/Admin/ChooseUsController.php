<?php
namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\model\Inquiry;
use App\model\Choose;
use App\model\ServiceGallery;
use Validator;
use File;
use Illuminate\Http\Request;
use Cviebrock\EloquentSluggable\why_choose_us\SlugService;

use Session;

class ChooseUsController extends Controller
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
        $why_choose_us=Choose::orderBy('id','DESC')->get();
        return view('admin.Why_Choose_Us.index',compact('why_choose_us'));
    }
    //  public function check_slug(Request $request)
    // {
    //     $slug = SlugChoose::createSlug(Choose::class , 'slug', $request->title);
    //     return response()->json(['slug' => $slug]);
    // }


    public function show($id) {
        $why_choose_us = Choose::where('id',$id)->first();
        // $gallery_image = ServiceGallery::where('product_id',$why_choose_us->id)->get();
        return view('admin.Why_Choose_Us.view', compact('why_choose_us'));
    }

    public function create() {
        return view('admin.Why_Choose_Us.add');
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            // 'slug' => 'required',
            'image_path' => 'required|mimes:jpeg,jpg,png|max:2000000',
            'description' => 'required',
        ], $this->messages, $this->attributes);

        if($validator->fails())
            return redirect()->back()->withErrors($validator)->withInput();
        $why_choose_us = new Choose;
        $why_choose_us->title=$request->title;
        $why_choose_us->description=$request->description;
        $why_choose_us->status=1;
        if($request->hasfile('image_path'))
        {
            $file = $request->file('image_path');
            $extention = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extention;
            $file->move(public_path('uploads/admin/why_choose_us/'),$filename);
            $why_choose_us->image_path = $request->image;
            $why_choose_us->image_path = 'uploads/admin/why_choose_us/'.$filename;
        }
        $why_choose_us->save();
        return redirect('/admin/why-choose-us')->with('message', 'Choose Us Details is Added!');
    }

    public function edit($id) {
        $why_choose_us = Choose::where('id',$id)->first();
        // $service_gallery = ServiceGallery::where('product_id',$id)->orderBy('id','DESC')->take(2)->get();
        return view('admin.Why_Choose_Us.edit', compact('why_choose_us'));
    }

    public function update(Request $request , $id) {

        $validator = Validator::make($request->all(), [
            'title' => 'required',
            // 'slug' => 'required',
            // 'image_path' => 'required|mimes:jpeg,jpg,png|max:2000000',
            'description' => 'required',
        ], $this->messages, $this->attributes);

        if($validator->fails())
            return redirect()->back()->withErrors($validator->errors());

        $title = $request->title;
        // $slug = $request->slug;
        $description = $request->description;
        $status = $request->status;
        $validArr = array();
        if($request->file('image_path')) {
            $validArr['image_path'] = 'required|mimes:jpeg,jpg,png,gif|required|max:10000';
        }
        $this->validate($request, $validArr);
        $requestData = $request->all();
        $why_choose_us = Choose::where('id', $id)->first();
        if($request->hasfile('image_path'))
        {
             $destination2 = public_path().'/'.$why_choose_us->image_path;
            if (File::exists($destination2)) {
                File::delete($destination2);
            }
            $file2 = $request->file('image_path');
            $extention2 = $file2->getClientOriginalExtension();
            $filename2 = time().'1.'.$extention2;
            $file2->move(public_path('uploads/admin/why_choose_us/'),$filename2);
            Choose::where('id', $id)
                ->update(['image_path' => 'uploads/admin/why_choose_us/'.$filename2,'title'=> $title,'description' => $description]);
        }

        else{
            Choose::where('id', $id)
                ->update([
                    'title'=> $title,
                    // 'slug'=> $slug,
                    'description'=> $description,
                    'status' => $status
                ]);
        }
        return redirect('admin/why-choose-us')->with('message', 'Choose Us Details is Updated!');
    }

    public function destroy($id) {
        $service=Choose::where('id',$id)->first();
        // ServiceGallery::where('product_id',$service->id)->delete();
        $service=Choose::where('id',$id)->delete();
        Session::flash('flash_message', 'Choose Us Details Been Deleted!');
        return redirect('admin/why-choose-us');
    }

}