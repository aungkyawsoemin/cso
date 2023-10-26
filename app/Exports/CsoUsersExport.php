<?php

namespace App\Exports;

use App\Models\CsoUser;
use Maatwebsite\Excel\Concerns\FromCollection;

class CsoUsersExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return CsoUser::all();
    }
}
