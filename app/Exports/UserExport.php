<?php

namespace App\Exports;

use App\model\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UserExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return User::select('fname','email','phone','organization','country','city')->where('id','!=',1)->get();
    }
      public function headings(): array
    {
        return ["Full Name","Email","Phone","Organization", "Country","City"];
    }
}

