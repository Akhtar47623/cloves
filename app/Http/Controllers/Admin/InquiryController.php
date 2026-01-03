<?php
namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\model\Inquiry;
use App\User;
use Illuminate\Http\Request;
use Session;

class InquiryController extends Controller
{
    public function index()
    {
        $contact_inquiry =Inquiry::orderBy('id', 'DESC')->get();
        $users=User::where('id','!=',1)->get();
        return view('admin.Contact.index', compact('contact_inquiry','users'));
    }

    public function show($id)
    {
        $contact_inquiry =Inquiry::findOrFail($id);
        return view('admin.Contact.view',compact('contact_inquiry'));
    }
      public function store(Request $request)
    { 

        $contact_inquiry =Inquiry::where('email',$request->email)->get();
        if(!$contact_inquiry){
        $contact_inquiry =Inquiry::orderBy('id','DESC')->get();
        }

        return view('admin.Contact.index',compact('contact_inquiry'));
    }

    public function destroy($id)
    {
        Inquiry::destroy($id);
        Session::flash('flash_message', 'Inquiry Has Been Deleted!');
        return redirect('admin/inquiry');
    }
}

