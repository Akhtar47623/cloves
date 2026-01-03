<?php
namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\model\Doc;
use Illuminate\Http\Request;
use Session;

class DocumentController extends Controller
{
    public function index()
    {
        $documents =Doc::orderBy('id', 'DESC')->get();
        return view('admin.Document.index', compact('documents'));
    }

    public function show($id)
    {
        $documents =Doc::findOrFail($id);
        return view('admin.Document.view',compact('documents'));
    }

    public function destroy($id)
    {
        Doc::destroy($id);
        Session::flash('flash_message', 'Document Has Been Deleted!');
        return redirect('admin/document');
    }
}

