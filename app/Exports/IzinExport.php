<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\fromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class IzinExport implements fromArray, WithHeadings, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $laporan;

    public function __construct(array $laporan)
    {
        $this->laporan = $laporan;
    }
    public function headings(): array
    {
        return [
            'Nama',
            'Sakit',
            'Izin',
            'Terlambat',
        ];
    }
    public function array(): array
    {
        return $this->laporan;
    }
}
