<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function welcome()
    {
        // Lógica para mostrar el panel de control del administrador
        return view('admin.welcome');
    }
}