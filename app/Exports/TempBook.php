<?php

namespace App\Exports;

use App\TempBook as AppTempBook;
use Maatwebsite\Excel\Excel;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class TempBook implements FromCollection, WithHeadingRow
{
    use Exportable;

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return AppTempBook::all();
    }
}
