<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\model\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Session;
use Validator;
use App\imagetable;

class BannerController extends Controller
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
        'image_path.required' => 'Provide :attribute',
        'image_path.mimes' => 'Provide:attribute of jpeg,jpg or png Type',
        'image_path.max' => 'Size of :attribute shold be less than 2 MBs',
    ];
    private $attributes = [
        'heading' => 'Slider Heading',
        'sub_title' => 'Sub Title',
        'description' => 'Description',
        'button_name' => 'Button Name',
        'button_link' => 'Button Link',
        'image_path' => 'Slider Image',
    ];

    public function index() {
        $banners = Banner::all();
        return view('admin.banner.index',compact('banners'));
    }

    public function create() {
        return view('admin.banner.add');
    }

    public function store(Request $request) {

        $validator = Validator::make($request->all(), [
            'heading' => 'required|string|max:255',
            'image_path' => 'required|mimes:jpeg,jpg,png|max:2000000'
        ], $this->messages, $this->attributes);

        if($validator->fails())
            return redirect()->back()->withErrors($validator->errors());

        $banner = new Banner;

        $banner->heading = $request->heading;
        if($request->hasfile('image_path'))
        {
            $file = $request->file('image_path');
            $extention = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extention;
            $file->move(public_path('uploads/admin/banner/'),$filename);
            $banner->image_path = 'uploads/admin/banner/'.$filename;
        }
        $banner->save();
        return redirect('/admin/banner')->with('message', 'Slider Has been inserted!');
    }

    public function edit($id)
    {
        $banner_detail = Banner::findOrFail($id);
        return view('admin.banner.edit',compact('banner_detail'));
    }

    public function update(Request $request , $id)
    {

        $validator = Validator::make($request->all(), [
            // 'heading' => 'required|string|max:255',
            // 'image_path' => 'required|mimes:jpeg,jpg,png|max:2000000'
        ], $this->messages, $this->attributes);

        if($validator->fails())
            return redirect()->back()->withErrors($validator->errors());
        $banner = Banner::find($id);
        if ($request->heading != null) {
            $banner->heading = $request->heading;
        }
        if ($request->sub_title != null) {
            $banner->sub_title = $request->sub_title;
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

        if ($request->hasfile('image_path')) {
            $destination = public_path().'/'.$banner->image_path;
            if (File::exists($destination)) {
                File::delete($destination);
            }
            $file = $request->file('image_path');
            $extention = $file->getClientOriginalExtension();
            $filename = time().'.'.$extention;
            $file->move(public_path('uploads/admin/banner/'),$filename);
            $banner->image_path = 'uploads/admin/banner/'.$filename;

        }
        $banner->save();
        return redirect('admin/banner')->with('message', 'Banner Info Has Been Updated Successfully!');
    }

}
