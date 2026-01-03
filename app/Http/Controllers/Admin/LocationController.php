<?php
namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;

use App\model\Blog;
use App\model\Location;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\File;

use Validator;

use Session;
class LocationController extends Controller

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

        $locations = Location::orderBy('id','DESC')->get();

        return view('admin.OurLocation.index', compact('locations'));

    }

    public function create() {

        return view('admin.OurLocation.add');

    }

    public function store(Request $request) {

        $validator = Validator::make($request->all(), [

            'location' => 'required|string|max:255',


        ], $this->messages, $this->attributes);


        if($validator->fails())

            return redirect()->back()->withErrors($validator)->withInput();

        $locations = new Location;
        
        $locations->location = $request->location;

        $locations->save();

        return redirect('/admin/location')->with('message', 'New Location Has Been Added!');

    }

    public function edit($id) {

        $locations = Location::findOrFail($id);

        return view('admin.OurLocation.edit', compact('locations'));

    }

    public function show($id) {

        $locations = Location::findOrFail($id);

        return view('admin.OurLocation.view', compact('locations'));

    }

    public function update(Request $request , $id) {

        $validator = Validator::make($request->all(), [

            // 'title' => 'required|string|max:255',

        ], $this->messages, $this->attributes);

        if($validator->fails())

            return redirect()->back()->withErrors($validator)->withInput();

        if($request->location != null){

        $location = $request->location;
        }
            Location::where('id', $id)

            ->update([

                'location' => $location

            ]);

        return redirect('admin/location')->with('message', 'Location has been Updated!');
        }




    public function destroy($id) {

        Location::destroy($id);

        Session::flash('flash_message', 'Location Has Been Deleted!');

        return redirect('admin/location');

    }

}

