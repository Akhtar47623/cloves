<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\imagetable;
use App\model\CMS;
use File;

class CMSController extends Controller
{
	public function __construct()
	{
		 //$this->middleware('auth');
		$logo = imagetable::
					 select('img_path')
					 ->where('table_name','=','logo')
					 ->first();

		$favicon = imagetable::
					 select('img_path')
					 ->where('table_name','=','favicon')
					 ->first();

		View()->share('logo',$logo);
		View()->share('favicon',$favicon);

	}

    public function index()
    {
        $CMS_details = CMS::all();
        return view('admin.CMS.index',compact('CMS_details'));
    }
    public function create()
    {
        return view('admin.CMS.create');
    }
    public function store(Request $request)
    {
        $CMS_content = new CMS;
        $CMS_content->title=$request->heading;
        $CMS_content->description=$request->description;
        $CMS_content->button1=$request->button1;
        $CMS_content->button1link=$request->button1link;
        $CMS_content->button2=$request->button2;
        $CMS_content->button2link=$request->button2link;
        $CMS_content->button3=$request->button3;
        $CMS_content->button3link=$request->button3link;
        $CMS_content->button4=$request->button4;
        $CMS_content->button4link=$request->button4link;
        if($request->hasfile('image'))
        {
            $file = $request->file('image');
            $extention = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extention;
            $file->move(public_path('uploads/admin/CMS/'),$filename);
            $CMS_content->image_path = 'uploads/admin/CMS/'.$filename;
        }
        $CMS_content->save();
        return redirect('/admin/CMS')->with('message', 'CMS content!');
    }
    public function edit($id)
    {
        $CMS_details = CMS::findOrFail($id);
        return view('admin.CMS.edit',compact('CMS_details'));
    }
    public function update(Request $request , $id)
    {
        $title = '';
        $description = '';
        $image_path = '';
        $title1 = '';
        $text1 = '';
        $image1 = '';
        $title2 = '';
        $text2 = '';
        $image2 = '';
        $title3 = '';
        $text3 = '';
        $image3 = '';
        $title4 = '';
        $text4 = '';
        $image4 = '';
        $button1 = '';
        $button1link = '';
        $button2 = '';
        $button2link = '';
        $button3 = '';
        $button3link = '';
        $button4 = '';
        $button4link = '';
        $founding = '';
        $f_year = '';
        $happy_customer = '';
        $hp_year = '';
        $asc_companies = '';
        $ac_year = '';
        $offices = '';
        $o_year = '';
        $team_member = '';
        $team_count= '';
        $completed_projects = '';
        $cp_count = '';
        $imagetable = CMS::where('id', $id)->first();
        if ($request->heading != null) {
            $title = $request->heading;
            CMS::where('id', $id)
                ->update([
                    'title' => $title,
                ]);
        }
        if ($request->description != null) {
            $description = $request->description;
            CMS::where('id', $id)
                ->update([
                    'description' => $description,
                ]);
        }
        if ($request->button1 != null) {
            $button1 = $request->button1;
            CMS::where('id', $id)
                ->update([
                    'button1' => $button1,
                ]);
        }
        if ($request->button1link != null) {
            $button1link = $request->button1link;
            CMS::where('id', $id)
                ->update([
                    'button1link' => $button1link,
                ]);
        }
        if ($request->button2 != null) {
            $button2 = $request->button2;
            CMS::where('id', $id)
                ->update([
                    'button2' => $button2,
                ]);
        }
        if ($request->button2link != null) {
            $button2link = $request->button2link;
            CMS::where('id', $id)
                ->update([
                    'button2link' => $button2link,
                ]);
        }
        if ($request->button3 != null) {
            $button3 = $request->button3;
            CMS::where('id', $id)
                ->update([
                    'button3' => $button3,
                ]);
        }
        if ($request->button3link != null) {
            $button3link = $request->button3link;
            CMS::where('id', $id)
                ->update([
                    'button3link' => $button3link,
                ]);
        }
        if ($request->button4 != null) {
            $button4 = $request->button4;
            CMS::where('id', $id)
                ->update([
                    'button4' => $button4,
                ]);
        }
        if ($request->button4link != null) {
            $button4link = $request->button4link;
            CMS::where('id', $id)
                ->update([
                    'button4link' => $button4link,
                ]);
        }
        if ($request->hasfile('image_path')) {
            $destination1 = 'uploads/admin/CMS/'.$imagetable->image_path;
            if (File::exists($destination1)) {
                File::delete($destination1);
            }
            $file1 = $request->file('image_path');
            $extention1 = $file1->getClientOriginalExtension();
            $filename1 = time().'1.'.$extention1;
            $file1->move(public_path('uploads/admin/CMS/'),$filename1);
            CMS::where('id', $id)
                ->update([
                    'image_path' => 'uploads/admin/CMS/'.$filename1,
                ]);
        }
        if ($request->title1 != null) {
            $title1 = $request->title1;
            CMS::where('id', $id)
                ->update([
                    'title1' => $title1,
                ]);
        }
        if ($request->text1 != null) {
            $text1 = $request->text1;
            CMS::where('id', $id)
                ->update([
                    'text1' => $text1,
                ]);
        }
        if ($request->hasfile('image1')) {
            $destination2 = 'uploads/admin/CMS/'.$imagetable->image1;
            if (File::exists($destination2)) {
                File::delete($destination2);
            }
            $file = $request->file('image1');
            $extention = $file->getClientOriginalExtension();
            $filename = time().'1.'.$extention;
            $file->move(public_path('uploads/admin/CMS/'),$filename);
            CMS::where('id', $id)
                ->update([
                    'image1' => 'uploads/admin/CMS/'.$filename,
                ]);
        }
        if ($request->title2 != null) {
            $title2 = $request->title2;
            CMS::where('id', $id)
                ->update([
                    'title2' => $title2,
                ]);
        }
        if ($request->text2 != null) {
            $text2 = $request->text2;
            CMS::where('id', $id)
                ->update([
                    'text2' => $text2,
                ]);
        }
        if ($request->hasfile('image2')) {
            $destination3 = 'uploads/admin/CMS/'.$imagetable->image2;
            if (File::exists($destination3)) {
                File::delete($destination3);
            }
            $file2 = $request->file('image2');
            $extention2 = $file2->getClientOriginalExtension();
            $filename2 = time().'2.'.$extention2;
            $file2->move(public_path('uploads/admin/CMS/'),$filename2);
            CMS::where('id', $id)
                ->update([
                    'image2' => 'uploads/admin/CMS/'.$filename2,
                ]);
        }
        if ($request->title3 != null) {
            $title3 = $request->title3;
            CMS::where('id', $id)
                ->update([
                    'title3' => $title3,
                ]);
        }
        if ($request->text3 != null) {
            $text3 = $request->text3;
            CMS::where('id', $id)
                ->update([
                    'text3' => $text3,
                ]);
        }
        if ($request->hasfile('image3')) {
            $destination4 = 'uploads/admin/CMS/'.$imagetable->image3;
            if (File::exists($destination4)) {
                File::delete($destination4);
            }
            $file3 = $request->file('image3');
            $extention3 = $file3->getClientOriginalExtension();
            $filename3 = time().'3.'.$extention3;
            $file3->move(public_path('uploads/admin/CMS/'),$filename3);
            CMS::where('id', $id)
                ->update([
                    'image3' => 'uploads/admin/CMS/'.$filename3,
                ]);
        }
        if ($request->title4 != null) {
            $title4 = $request->title4;
            CMS::where('id', $id)
                ->update([
                    'title4' => $title4,
                ]);
        }
        if ($request->text4 != null) {
            $text4 = $request->text4;
            CMS::where('id', $id)
                ->update([
                    'text4' => $text4,
                ]);
        }
        if ($request->founding != null) {
            $founding = $request->founding;
            CMS::where('id', $id)
                ->update([
                    'founding' => $founding,
                ]);
        }
        if ($request->f_year != null) {
            $f_year = $request->f_year;
            CMS::where('id', $id)
                ->update([
                    'f_year' => $f_year,
                ]);
        }

        if ($request->happy_customer != null) {
            $happy_customer = $request->happy_customer;
            CMS::where('id', $id)
                ->update([
                    'happy_customer' => $happy_customer,
                ]);
        }

        if ($request->hp_year!= null) {
            $hp_year = $request->hp_year;
            CMS::where('id', $id)
                ->update([
                    'hp_year' => $hp_year,
                ]);
        }
        if ($request->asc_companies!= null) {
            $asc_companies = $request->asc_companies;
            CMS::where('id', $id)
                ->update([
                    'asc_companies' => $asc_companies,
                ]);
        }
        if ($request->ac_year!= null) {
            $ac_year = $request->ac_year;
            CMS::where('id', $id)
                ->update([
                    'ac_year' => $ac_year,
                ]);
        }
        if ($request->offices!= null) {
            $offices = $request->offices;
            CMS::where('id', $id)
                ->update([
                    'offices' => $offices,
                ]);
        }
        if ($request->o_year!= null) {
            $o_year = $request->o_year;
            CMS::where('id', $id)
                ->update([
                    'o_year' => $o_year,
                ]);
        }
        if ($request->team_member!= null) {
            $team_member = $request->team_member;
            CMS::where('id', $id)
                ->update([
                    'team_member' => $team_member,
                ]);
        }
        if ($request->team_count!= null) {
            $team_count = $request->team_count;
            CMS::where('id', $id)
                ->update([
                    'team_count' => $team_count,
                ]);
        }
        if ($request->completed_projects!= null) {
            $completed_projects = $request->completed_projects;
            CMS::where('id', $id)
                ->update([
                    'completed_projects' => $completed_projects,
                ]);
        }
        if ($request->cp_count!= null) {
            $cp_count = $request->cp_count;
            CMS::where('id', $id)
                ->update([
                    'cp_count' => $cp_count,
                ]);
        }
        if ($request->hasfile('image4')) {
            $destination5 = 'uploads/admin/CMS/'.$imagetable->image4;
            if (File::exists($destination5)) {
                File::delete($destination5);
            }
            $file4 = $request->file('image4');
            $extention4 = $file4->getClientOriginalExtension();
            $filename4 = time().'4.'.$extention4;
            $file4->move(public_path('uploads/admin/CMS/'),$filename4);
            CMS::where('id', $id)
                ->update([
                    'image4' => 'uploads/admin/CMS/'.$filename4,
                ]);
        }
        return redirect('/admin/CMS')->with('message', 'CMS content Has Been Updated!');
    }

    public function updateLogo(Request $request)
    {
        if($request->method() != 'POST')
            return view('admin.logo.index-logo');
        $validArr = array();
        if($request->file('image')) {
            $validArr['image'] = 'required|mimes:jpeg,jpg,png,gif|required|max:10000';
        }
        $this->validate($request, $validArr);

        $imagetable = imagetable::where('table_name', 'logo')->first();
        if ($request->hasfile('image')) {
            $destination = 'public/uploads/admin/'.$imagetable->image_path;
            if (\Illuminate\Support\Facades\File::exists($destination)) {
                File::delete($destination);
            }
            $file = $request->file('image');
            $extention = $file->getClientOriginalExtension();
            $filename = time().'.'.$extention;
            $file->move(public_path('/uploads/imagetable/'),$filename);
        } else{
            return redirect()->back()->with('flash_message','Please Provide Logo Image');
        }
        imagetable::where('table_name', 'logo')
            ->update(['img_path' => 'uploads/imagetable/'.$filename]);

        $validArr = array();
                $validArr['logo'] = 'required|string|max:255';

            $this->validate($request, $validArr);
        imagetable::where('table_name', 'logo')
                            ->update(['img_path' => $request->logo]);
        session()->flash('message', 'Logo Image updated Successfully');
        return redirect('admin/logo');
    }

    public function faviconUpload(Request $request) {
        if($request->method() != 'POST')
            return view('admin.dashboard.index-favicon');
        $validArr = array();
        if($request->file('image')) {
            $validArr['image'] = 'required|mimes:jpeg,jpg,png,gif|required|max:10000';
        }
        $this->validate($request, $validArr);

        if ($request->hasfile('image')) {
            $destination = 'uploads/admin/'. imagetable::where('table_name', 'favicon')->first()->image_path;
            if (\Illuminate\Support\Facades\File::exists($destination)) {
                File::delete($destination);
            }
            $file = $request->file('image');
            $extention = $file->getClientOriginalExtension();
            $filename = time().'.'.$extention;
            $file->move(public_path('uploads/imagetable/'),$filename);
        } else{
            return redirect()->back()->with('flash_message','Please Provide Favicon Image');
        }
        imagetable::where('table_name', 'favicon')
            ->update(['img_path' => 'uploads/imagetable/'.$filename]);
        session()->flash('message', 'Successfully updated the favicon');
        return redirect('admin/favicon');
    }


}

