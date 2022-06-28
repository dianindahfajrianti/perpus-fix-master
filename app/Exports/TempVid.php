<?php

namespace App\Exports;

use Maatwebsite\Excel\Excel;
use App\TempVid as AppTempVid;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class TempVid implements FromCollection, WithHeadingRow
{
    use Exportable;
    
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return AppTempVid::all();
    }
}
