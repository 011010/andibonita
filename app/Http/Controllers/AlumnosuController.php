<?php

namespace App\Http\Controllers;

use App\Models\Alumnosu;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\AlumnosuRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class AlumnosuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $alumnosus = Alumnosu::paginate();

        return view('alumnosu.index', compact('alumnosus'))
            ->with('i', ($request->input('page', 1) - 1) * $alumnosus->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $alumnosu = new Alumnosu();

        return view('alumnosu.create', compact('alumnosu'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AlumnosuRequest $request): RedirectResponse
    {
        Alumnosu::create($request->validated());

        return Redirect::route('alumnosus.index')
            ->with('success', 'Alumnosu created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $alumnosu = Alumnosu::find($id);

        return view('alumnosu.show', compact('alumnosu'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $alumnosu = Alumnosu::find($id);

        return view('alumnosu.edit', compact('alumnosu'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AlumnosuRequest $request, Alumnosu $alumnosu): RedirectResponse
    {
        $alumnosu->update($request->validated());

        return Redirect::route('alumnosus.index')
            ->with('success', 'Alumnosu updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        Alumnosu::find($id)->delete();

        return Redirect::route('alumnosus.index')
            ->with('success', 'Alumnosu deleted successfully');
    }
}
