<?php
   
namespace App\Http\Controllers\Export;
use App\Http\Controllers\Controller;
use QuickBooksOnline\API\DataService\DataService;
use QuickBooksOnline\API\Core\Http\Serialization\XmlObjectSerializer;
use QuickBooksOnline\API\Facades\Invoice;
// use App\Http\Controllers\Admin\InvoiceExport;
use Illuminate\Http\Request;
use App\Exports\InquiryExport;
use App\Exports\UserExport;
use App\Exports\OrderExport;
use App\Exports\InvoicesExport;
use App\Imports\OrdersImport;
use App\Imports\batchOrderImport;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Validators\Failure;
use Illuminate\Support\Facades\Storage;
use Session;

use Auth;
  
class ExcelController extends Controller
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function importExportView()
    {
       return view('import');
    }
   
    /**
    * @return \Illuminate\Support\Collection
    */
    public function export() 
    {
        return Excel::download(new InquiryExport, 'inquiry.xlsx');
    }

        public function userExport() 
    {
        return Excel::download(new UserExport, 'users.xlsx');
    }
         public function orderExport() 
    {
        return Excel::download(new OrderExport, 'orders.xlsx');
    }
    

    /**
    * @return \Illuminate\Support\Collection
    */

    // End User Import Orders
    public function import(Request $request) 
    {
        if(Auth::check()){
            $file = $request->file('upload_file')->store('import');
            $imports = new OrdersImport;
            $imports->import(new OrdersImport,storage_path('app/'.$file));
            if($imports->failures()->isNotEmpty())
            {
                Storage::delete($request->file('upload_file')->store('import'));
                return view('admin.UserOrder.excel_error')->withFailures($imports->failures());
            }
            Storage::delete($request->file('upload_file')->store('import'));
            return redirect()->back()->with('success','Order Has Been Created Successfully!');
            // try {

            //         $file=Excel::import(new OrdersImport,request()->file('upload_file'));
            //         return redirect()->back();
            //     } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            //          $failures = $e->failures();
            //          //   foreach ($failures as $failure) {
            //          //     $failure->row(); // row that went wrong
            //          //     $failure->attribute(); // either heading key (if using heading row concern) or column index
            //          //     $failure->errors(); // Actual error messages from Laravel validator
            //          //     $failure->values(); // The values of the row that has failed.
            //          // }
            //          // return redirect()->back()->with('error',$failures);
            //         Session::flash('flash_message',$failures);
            //         return redirect()->back();

                        
            //     }
        }
        else{
            return redirect()->back()->with('error','Login before placing an order');
        }
    }

    // Admin Import Orders
      public function batchImport(Request $request) 
    {      
            $file = $request->file('file')->store('import');
            $imports = new batchOrderImport;
            $imports->import($imports,storage_path('app/'.$file));

            if($imports->failures()->isNotEmpty())
            {   
                Storage::delete($request->file('file')->store('import'));
                return view('admin.Orders.excel_error')->withFailures($imports->failures());

            }

            Storage::delete($request->file('file')->store('import'));
            return redirect()->back()->with('success','Order Has Been Created Successfully!');
    }

    public function invoiceExport(){
         return Excel::download(new InvoicesExport,'invoices.xlsx');
    }
}

