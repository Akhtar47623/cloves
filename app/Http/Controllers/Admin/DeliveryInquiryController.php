<?php
namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\model\DeliveryInquiry;
use Illuminate\Http\Request;
use Session;

class DeliveryInquiryController extends Controller
{
    public function index()
    {
        $delivery_inquiry =DeliveryInquiry::orderBy('id', 'DESC')->get();
        return view('admin.DeliveryInquiry.index', compact('delivery_inquiry'));
    }

    public function show($id)
    {
        $delivery_inquiry =DeliveryInquiry::findOrFail($id);
        return view('admin.DeliveryInquiry.view',compact('delivery_inquiry'));
    }

    public function destroy($id)
    {
        DeliveryInquiry::destroy($id);
        Session::flash('flash_message', 'Inquiry Has Been Deleted!');
        return redirect('admin/delivery-inquiry');
    }
}

