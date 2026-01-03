<?php

namespace App\Exports;

use App\model\Inquiry;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class InquiryExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Inquiry::select('name','email','phone','purpose','address','message','created_at')->get();
    }
       public function headings(): array
    {
        return ["Full Name", "Email", "Phone","Purpose","Address", "Message","Date"];
    }
}
