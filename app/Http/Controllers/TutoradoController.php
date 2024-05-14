<?php

namespace App\Http\Controllers;

use App\Models\Tutorado;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\TutoradoRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\TutoradosImport;
use App\Models\Tutore;

class TutoradoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $tutorados = Tutorado::paginate();

        return view('tutorado.index', compact('tutorados'))
            ->with('i', ($request->input('page', 1) - 1) * $tutorados->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $tutorado = new Tutorado();

        return view('tutorado.create', compact('tutorado'));

        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
      

        $file=$request->file('import_file');

        Excel::import(new TutoradosImport, $file);

        return Redirect::route('tutorados.index')
            ->with('success', 'Tutorado created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $tutorado = Tutorado::find($id);

        return view('tutorado.show', compact('tutorado'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $tutorado = Tutorado::find($id);
        $tutores = Tutore::all(); // Obtener todos los tutores disponibles
    
        return view('tutorado.edit', compact('tutorado', 'tutores'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TutoradoRequest $request, Tutorado $tutorado): RedirectResponse
    {
        $tutorado->update($request->validated());

        return Redirect::route('tutorados.index')
            ->with('success', 'Tutorado updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        Tutorado::find($id)->delete();

        return Redirect::route('tutorados.index')
            ->with('success', 'Tutorado deleted successfully');
    }
}
