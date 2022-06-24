<?php

namespace App\Exports;

use Maatwebsite\Excel\Excel;
use App\TempVid as AppTempVid;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\FromCollection;

class TempVid implements FromCollection, Responsable
{
    use Exportable;
    /**
    * It's required to define the fileName within
    * the export class when making use of Responsable.
    */
    private $fileName = 'videolist.xlsx';
    
    /**
    * Optional Writer Type
    */
    private $writerType = Excel::XLSX;
    
    /**
    * Optional headers
    */
    private $headers = [
        'Content-Type' => 'text/csv',
    ];

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return AppTempVid::all();
    }
}
