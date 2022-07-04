<?php

namespace App\Exports;

use Maatwebsite\Excel\Excel;
use App\TempVid as AppTempVid;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\FromCollection;

class TempVid implements FromCollection, WithHeadings
{
    use Exportable;
    
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return AppTempVid::select('nama_file','tipe_file')->get();
    }
    public function headings(): array
    {
        return ['nama_file','tipe_file'];
    }
}
