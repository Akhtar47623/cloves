<?php
namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;

use App\model\Blog;
use App\model\Membership;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\File;

use Validator;

use Session;
class MembershipController extends Controller

{

    private $messages = [

        'title.required' => 'Provide a :attribute',

        'title.max' => ':attribute can not exceed :max characters',

        'blogger_name.required' => 'Provide a :attribute',

        'blogger_name.max' => ':attribute can not exceed :max characters',

        'description.required' => 'Provide :attribute',

        'image.required' => 'Provide :attribute',

        'image.mimes' => 'Provide file of jpeg,jpg or png Type',

        'image.max' => 'Size of :attribute shold be less than 2 MBs',

    ];

    private $attributes = [

        'title' => 'Blog Title',

        'blogger_name' => 'Blogger Name',

        'description' => 'Description',

        'image' => 'Image',

    ];

    public function index() {

        $membership = Membership::orderBy('id','DESC')->get();
        return view('admin.Membership.index', compact('membership'));

    }

    public function create() {

        return view('admin.Membership.add');

    }

    public function store(Request $request) {

        $validator = Validator::make($request->all(), [



            'description' => 'required',
            'image_path' => 'required|image|mimes:jpeg,png,jpg|max:2000000',
            // 'link' => 'required|url',

        ], $this->messages, $this->attributes);


        if($validator->fails())

            return redirect()->back()->withErrors($validator)->withInput();

        $membership = new Membership;
        
        $membership->link = $request->link;
        $membership->status =1;
        $membership->description = $request->description;
          if($request->hasfile('image_path'))
        {
            $file = $request->file('image_path');
            $extention = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extention;
            $file->move(public_path('uploads/admin/Membership/'),$filename);
            $membership->image_path = 'uploads/admin/Membership/'.$filename;
        }

        $membership->save();

        return redirect('/admin/membership')->with('message', 'New Membership Has Been Added!');

    }

    public function edit($id) {

        $membership = Membership::findOrFail($id);

        return view('admin.Membership.edit', compact('membership'));

    }

    public function show($id) {

        $membership = Membership::findOrFail($id);

        return view('admin.Membership.view', compact('membership'));

    }

    public function update(Request $request , $id) {

      $validator = Validator::make($request->all(), [

            // 'link' => 'required|url',

            'description' => 'required',


        ], $this->messages, $this->attributes);



        if($validator->fails())

            return redirect()->back()->withErrors($validator)->withInput();


        $link = $request->link;
        $description = $request->description;
        $status = $request->status;
        Membership::where('id',$id)->update([
            'link' => $link,
            'description' => $description,
            'status' => $status,
        ]);
        $membership = Membership::where('id', $id)->first();
        if($request->hasfile('image_path'))
        {
             $destination2 = public_path().'/'.$membership->image_path;
            if (File::exists($destination2)) {
                File::delete($destination2);
            }
            $file2 = $request->file('image_path');
            $extention2 = $file2->getClientOriginalExtension();
            $filename2 = time().'1.'.$extention2;
            $file2->move(public_path('uploads/admin/Membership/'),$filename2);
            Membership::where('id', $id)
                ->update(['image_path' => 'uploads/admin/Membership/'.$filename2,'link'=> $link,'description' => $description,'status' => $status]);
        }

       
        return redirect('admin/membership')->with('message', 'Membership has been Updated!');

    }

    public function destroy($id) {

        Membership::destroy($id);

        Session::flash('flash_message', 'Membership Has Been Deleted!');

        return redirect('admin/membership');

    }

}

