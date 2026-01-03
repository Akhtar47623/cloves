<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\model\MainBanner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Session;
use Validator;
use App\imagetable;

class MainBannerController extends Controller
{
    private $messages = [
        'heading.required' => 'Provide a :attribute',
        'heading.max' => ':attribute can not exceed :max characters',
        'sub_title.required' => 'Provide a :attribute',
        'sub_title.max' => ':attribute can not exceed :max characters',
        'description.required' => 'Provide :attribute',
        'button_name.required' => 'Provide a :attribute',
        'button_name.string' => ':attribute must be in :string',
        'button_link.required' => 'Provide a :attribute',
        'button_link.url' => ':attribute  must be a URL',
        'image.required' => 'Provide :attribute',
        'image.mimes' => 'Provide:attribute of jpeg,jpg or png Type',
        'image.max' => 'Size of :attribute shold be less than 2 MBs',
    ];
    private $attributes = [
        'heading' => 'Slider Heading',
        'sub_title' => 'Sub Title',
        'description' => 'Description',
        'button_name' => 'Button Name',
        'button_link' => 'Button Link',
        'image' => 'Slider Image',
    ];

    public function index() {
        $banners = MainBanner::orderBy('id','DESC')->get();
        return view('admin.MainBanner.index',compact('banners'));
    }

    public function create() {
        return view('admin.MainBanner.add');
    }

    public function store(Request $request) {

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'image_path' => 'required|mimes:jpeg,jpg,png|max:2000000'
        ], $this->messages, $this->attributes);

        if($validator->fails())
            return redirect()->back()->withErrors($validator->errors());

        $banner = new MainBanner;

        $banner->title = $request->title;
        $banner->description = $request->description;
        $banner->testimonial_title = $request->testimonial_title;
        $banner->rating = $request->rating;
        $banner->reviews = $request->description;
        $banner->status=1;
        if($request->hasfile('image_path'))
        {
            $file = $request->file('image_path');
            $extention = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extention;
            $file->move(public_path('uploads/admin/MainBanner/'),$filename);
            $banner->image_path = 'uploads/admin/MainBanner/'.$filename;
        }
         if($request->hasfile('image5'))
        {
            $file5 = $request->file('image5');
            $extention5 = $file5->getClientOriginalExtension();
            $filename5 = time() . '5.' . $extention5;
            $file5->move(public_path('uploads/admin/MainBanner/'),$filename5);
            $banner->image5 = $request->image5;
            $banner->image5 = 'uploads/admin/MainBanner/'.$filename5;
        }
         if($request->hasfile('image1'))
        {
            $file1 = $request->file('image1');
            $extention1 = $file1->getClientOriginalExtension();
            $filename1 = time() . '1.' . $extention1;
            $file1->move(public_path('uploads/admin/MainBanner/'),$filename1);
            $banner->image1 = $request->image1;
            $banner->image1 = 'uploads/admin/MainBanner/'.$filename1;
        }
             if($request->hasfile('image2'))
        {
            $file2 = $request->file('image2');
            $extention2 = $file2->getClientOriginalExtension();
            $filename2 = time() . '2.' . $extention2;
            $file2->move(public_path('uploads/admin/MainBanner/'),$filename2);
            $banner->image2 = $request->image2;
            $banner->image2 = 'uploads/admin/MainBanner/'.$filename2;
        }
             if($request->hasfile('image3'))
        {
            $file3 = $request->file('image3');
            $extention3 = $file3->getClientOriginalExtension();
            $filename3 = time() . '3.' . $extention3;
            $file3->move(public_path('uploads/admin/MainBanner/'),$filename3);
            $banner->image3 = $request->image3;
            $banner->image3 = 'uploads/admin/MainBanner/'.$filename3;
        }
             if($request->hasfile('image4'))
        {
            $file4 = $request->file('image4');
            $extention4 = $file4->getClientOriginalExtension();
            $filename4 = time() . '4.' . $extention4;
            $file4->move(public_path('uploads/admin/MainBanner/'),$filename4);
            $banner->image4 = $request->image4;
            $banner->image4 = 'uploads/admin/MainBanner/'.$filename4;
        }
        
        $banner->save();
        return redirect('/admin/main-banner')->with('message', 'Main Banner Has been inserted!');
    }

    public function edit($id)
    {
        $banner = MainBanner::findOrFail($id);
        return view('admin.MainBanner.edit',compact('banner'));
    }

    public function update(Request $request , $id)
    {
        $validator = Validator::make($request->all(), [
            // 'title' => 'required|string|max:255',
            // 'image_path' => 'mimes:jpeg,jpg,png|max:2000000',
            // 'description' => 'required|string|max:255',

        ], $this->messages, $this->attributes);

        if($validator->fails())
            return redirect()->back()->withErrors($validator->errors());
        $banner = MainBanner::find($id);
        if ($request->title != null) {
            $banner->title = $request->title;
        }
        if ($request->testimonial_title != null) {
            $banner->testimonial_title = $request->testimonial_title;
        }
         if ($request->rating != null) {
            $banner->rating = $request->rating;
        }
         if ($request->reviews != null) {
            $banner->reviews = $request->reviews;
        }
        if ($request->description != null) {
            $banner->description = $request->description;
        }
        if ($request->button_name != null) {
            $banner->button_name = $request->button_name;
        }
        if ($request->button_link != null) {
            $banner->button_link = $request->button_link;
        }
         if ($request->status != null) {
            $banner->status = $request->status;
        }
        $banner->status=$request->status;

        if ($request->hasfile('image_path')) {
            $destination = public_path().'/'.$banner->image_path;
            if (File::exists($destination)) {
                File::delete($destination);
            }
            $file = $request->file('image_path');
            $extention = $file->getClientOriginalExtension();
            $filename = time().'.'.$extention;
            $file->move(public_path('uploads/admin/MainBanner/'),$filename);
            $banner->image_path = 'uploads/admin/MainBanner/'.$filename;

        }
        if ($request->hasfile('image5')) {
            $destination = public_path().'/'.$banner->image5;
            if (File::exists($destination)) {
                File::delete($destination);
            }
            $file = $request->file('image5');
            $extention = $file->getClientOriginalExtension();
            $filename = time().'5.'.$extention;
            $file->move(public_path('uploads/admin/MainBanner/'),$filename);
            $banner->image5 = 'uploads/admin/MainBanner/'.$filename;

        }
         if ($request->hasfile('image1')) {
            $destination = public_path().'/'.$banner->image1;
            if (File::exists($destination)) {
                File::delete($destination);
            }
            $file = $request->file('image1');
            $extention = $file->getClientOriginalExtension();
            $filename = time().'1.'.$extention;
            $file->move(public_path('uploads/admin/MainBanner/'),$filename);
            $banner->image1 = 'uploads/admin/MainBanner/'.$filename;

        }
        if ($request->hasfile('image2')) {
            $destination = public_path().'/'.$banner->image2;
            if (File::exists($destination)) {
                File::delete($destination);
            }
            $file = $request->file('image2');
            $extention = $file->getClientOriginalExtension();
            $filename = time().'2.'.$extention;
            $file->move(public_path('uploads/admin/MainBanner/'),$filename);
            $banner->image2 = 'uploads/admin/MainBanner/'.$filename;

        }
        if ($request->hasfile('image3')) {
            $destination = public_path().'/'.$banner->image3;
            if (File::exists($destination)) {
                File::delete($destination);
            }
            $file = $request->file('image3');
            $extention = $file->getClientOriginalExtension();
            $filename = time().'3.'.$extention;
            $file->move(public_path('uploads/admin/MainBanner/'),$filename);
            $banner->image3 = 'uploads/admin/MainBanner/'.$filename;

        }
        if ($request->hasfile('image4')) {
            $destination = public_path().'/'.$banner->image4;
            if (File::exists($destination)) {
                File::delete($destination);
            }
            $file = $request->file('image4');
            $extention = $file->getClientOriginalExtension();
            $filename = time().'4.'.$extention;
            $file->move(public_path('uploads/admin/MainBanner/'),$filename);
            $banner->image4 = 'uploads/admin/MainBanner/'.$filename;

        }
        $banner->save();
        return redirect('admin/main-banner')->with('message', 'Main Banner Has Been Updated Successfully!');
    }


    public function destroy($id) {

        MainBanner::destroy($id);

        Session::flash('flash_message', 'Banner Has Been Deleted!');

        return redirect('/admin/main-banner');

    }

}
