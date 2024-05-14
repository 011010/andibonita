<?php

namespace App\Http\Controllers;

use App\Models\Tutore;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\TutoreRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\TutoresImport;
class TutoreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $tutores = Tutore::paginate();

        return view('tutore.index', compact('tutores'))
            ->with('i', ($request->input('page', 1) - 1) * $tutores->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $tutore = new Tutore();

        return view('tutore.create', compact('tutore'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       
        $file=$request->file('import_file');

        Excel::import(new TutoresImport , $file);


        return Redirect::route('tutores.index')
            ->with('success', 'Tutore created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $tutore = Tutore::find($id);

        return view('tutore.show', compact('tutore'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $tutore = Tutore::find($id);

        return view('tutore.edit', compact('tutore'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TutoreRequest $request, Tutore $tutore): RedirectResponse
    {
        $tutore->update($request->validated());

        return Redirect::route('tutores.index')
            ->with('success', 'Tutore updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        Tutore::find($id)->delete();

        return Redirect::route('tutores.index')
            ->with('success', 'Tutore deleted successfully');
    }
}
