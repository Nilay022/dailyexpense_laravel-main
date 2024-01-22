<?php

namespace App\Exports;

use Illuminate\Support\Facades\Auth;
use App\Models\Expense;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;

class ExportFile implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection($req)
    {

        return Expense::whereBetween('date', [
            $req->startdate->format('Y-m-d'),
            $req->enddate->format('Y-m-d')
        ])->where('user_id', Auth::id())->get();
    }
}

