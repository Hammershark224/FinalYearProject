<?php

namespace App\Exports;

use App\Models\DishDetail;
use Maatwebsite\Excel\Concerns\FromCollection;

class DishExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return DishDetail::all();
    }
}
