<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\imagetable;
use App\model\CMS;
use File;

class AboutUsContentController extends Controller
{
    public function index()
    {
        $about_cms = CMS::where('page_name','About Us')->get();
        return view('admin.CMS.About.index',compact('about_cms'));
    }
    public function edit($id)
    {
        $about_cms = CMS::findOrFail($id);
        return view('admin.CMS.About.edit',compact('about_cms'));
    }

    public function show($id)
    {
        $about_cms = CMS::findOrFail($id);
        return view('admin.CMS.About.view',compact('about_cms'));
    }

    public function update(Request $request , $id)
    {
        
        $title = '';
        $description = '';
        $description2 = '';
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
            CMS::where('id',$id)
                ->update([
                    'description' => $description,
                ]);
        }
        if ($request->description2 != null) {
            $description2 = $request->description2;
            CMS::where('id', $id)
                ->update([
                    'description2' => $description2,
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
        if ($request->hasfile('video_path')) {
            $destination6 = 'uploads/admin/CMS/'.$imagetable->video_path;
            if (File::exists($destination6)) {
                File::delete($destination6);
            }
            $file5 = $request->file('video_path');
            $extention5 = $file5->getClientOriginalExtension();
            $filename5 = time().'5.'.$extention5;
            $file5->move(public_path('uploads/admin/CMS/TNS/'),$filename5);
            CMS::where('id', $id)
                ->update([
                    'video_path' => 'uploads/admin/CMS/TNS/'.$filename5,
                ]);
        }
        return redirect('/admin/about-us')->with('message', 'Content Has Been Updated!');
    }

}


