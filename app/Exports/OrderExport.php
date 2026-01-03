<?php

namespace App\Exports;

use App\model\Order;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class OrderExport implements FromCollection, WithHeadings, ShouldAutoSize,WithStyles,WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
         return Order::select('order_id','full_name','email','product','organization','delivery_type','priority','latitude','langitude','current_date','time_from','time_to','duration','boxes','notes')->where('status',0)->get();
    }
     public function headings(): array
    {
        return [
            ["Follow the highlighted Instructions before uploading the Form!"],
            ["Uniqe Identifier for each Order","Full Name","xyz@mail.com","Product Name","Organization Name","Order Type may be ( D,P,T ) specified for ( Delivery, Pickup, Task ) respectively","Priority has three modes ( H, M, L ) specified for( High/Critical, Medium, Low ) respectively", "Latitude against the location","Longitude against the location","Date", "Time window from","Time window to ","Time at the Location Required to upload the goods or perform a task(in minutes).","Load requirements of the order. i-e  how many load units(Number of boxes,kilos,pounds,liters etc) should be delivered.","Short Description less than 200 char(optional)."],
            ["Order Id", "Full Name","Email","Product","Organization","Order Type","Priority","Latitude","Longitude","Date","Time From","Time To","Duration","Boxes","Notes"]
        ];
    }

    // STYLE OF ROW
     public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1    => ['text' => ['red' => true]],

            // Styling a specific cell by coordinate.
            3 => ['font' => ['bold' => true],'font' => ['size' => 14]],

            // Styling an entire column.
            // 'C'  => ['font' => ['size' => 16]],
        ];
    }


    // COlOR THE ROW OF EXCEL 
           public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
  
                $event->sheet->getDelegate()->getStyle('A1:A1')
                        ->getFill()
                        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                        ->getStartColor()
                        ->setARGB('DD4B39');
                        $event->sheet->getDelegate()->getStyle('A2:p2')
                        ->getFill()
                        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                        ->getStartColor()
                        ->setARGB('DD4B39');
  
            },

        ];
        $event->sheet->styleCells(
                   'C7:G7',
            [
                'alignment' => [
                       'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                ],                        
               'font' => [
                        'name' => 'Century Gothic',
                        'size' => 11,
                        'bold' => true,
                        'color' => ['argb' => 'EB2B02'],
                 ]
              ]
        );

    }
                   

}

