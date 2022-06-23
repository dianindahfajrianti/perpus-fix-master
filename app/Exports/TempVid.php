<?php

namespace App\Exports;

use App\TempVid as AppTempVid;
use Maatwebsite\Excel\Concerns\FromCollection;

class TempVid implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        
    }
}
