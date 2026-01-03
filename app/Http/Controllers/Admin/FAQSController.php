<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\model\FAQ;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Session;
use Validator;
use App\imagetable;

class FAQSController extends Controller
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
        $faqs = FAQ::orderBy('id','DESC')->get();
        return view('admin.FAQ.index',compact('faqs'));
    }

    public function create() {
        return view('admin.FAQ.add');
    }

    public function store(Request $request) {

        $validator = Validator::make($request->all(), [
            'question' => 'required|string|max:255',
            'answer' => 'required|string|max:255',
        ], $this->messages, $this->attributes);

        if($validator->fails())
            return redirect()->back()->withErrors($validator->errors());

        $faqs=new FAQ();
        $faqs->question=$request->question;
        $faqs->status=1;
        $faqs->answer=$request->answer;
        $faqs->save();
        return redirect('/admin/faqs')->with('message', 'FAQS Has been Created!');
    }

    public function edit($id)
    {
        $faqs = FAQ::findOrFail($id);
        return view('admin.FAQ.edit',compact('faqs'));
    }

    public function update(Request $request , $id)
    {

        $validator = Validator::make($request->all(), [
            // 'heading' => 'required|string|max:255',
            // 'image_path' => 'required|mimes:jpeg,jpg,png|max:2000000'
        ], $this->messages, $this->attributes);

        if($validator->fails())
            return redirect()->back()->withErrors($validator->errors());
        $faqs = FAQ::find($id);
        if ($request->question != null) {
            $faqs->question = $request->question;
        }
        if ($request->answer != null) {
            $faqs->answer = $request->answer;
        }
        if ($request->description != null) {
            $faqs->description = $request->description;
        }
        if ($request->button_name != null) {
            $faqs->button_name = $request->button_name;
        }
        if ($request->button_link != null) {
            $faqs->button_link = $request->button_link;
        }
        $faqs->status=$request->status;        
        $faqs->save();
        return redirect('admin/faqs')->with('message', 'FAQS Has Been Updated Successfully!');
    }
     public function destroy($id) {

        FAQ::destroy($id);

        Session::flash('flash_message', 'FAQS Has Been Deleted!');

        return redirect('/admin/faqs');

    }

}
