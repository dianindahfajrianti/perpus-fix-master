<?php

namespace App\Exports;

use App\TempBook as AppTempBook;
use Maatwebsite\Excel\Excel;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\FromCollection;

class TempBook implements FromCollection, Responsable
{
    use Exportable;
    /**
    * It's required to define the fileName within
    * the export class when making use of Responsable.
    */
    private $fileName = 'booklist.xlsx';
    
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
        return AppTempBook::all();
    }
}
