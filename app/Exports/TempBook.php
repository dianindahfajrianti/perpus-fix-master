<?php

namespace App\Exports;

use Maatwebsite\Excel\Excel;
use App\TempBook as AppTempBook;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\FromCollection;

class TempBook implements FromCollection, WithHeadings
{
    use Exportable;

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return AppTempBook::select('judul',
        'deskripsi',
        'th_terbit',
        'penerbit',
        'pengarang',
        'jenjang',
        'kelas',
        'jurusan',
        'mapel',
        'nama_file','tipe_file')->get();
    }
    public function headings(): array
    {
        return ['judul',
        'deskripsi',
        'th_terbit',
        'penerbit',
        'pengarang',
        'jenjang',
        'kelas',
        'jurusan',
        'mapel',
            'nama_file','tipe_file'];
    }
}
