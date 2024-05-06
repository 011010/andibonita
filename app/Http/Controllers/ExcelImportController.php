<?php

namespace App\Http\Controllers;

use Maatwebsite\Excel\Facades\Excel;
use App\Imports\AlumnosImport; // Asegúrate de crear este importador
use Illuminate\Http\Request;

class ExcelImportController extends Controller
{
    public function import(Request $request)
    {
        $request->validate([
            'excel_file' => 'required|mimes:xlsx,xls',
        ]);

        $file = $request->file('excel_file');

        Excel::import(new AlumnosImport, $file);

        return back()->with('success', 'Datos importados correctamente.');
    }
}
