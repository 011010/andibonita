<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InvitadoController extends Controller
{
    public function dashboard()
    {
        // Lógica para mostrar el panel de control del usuario invitado
        return view('invitado.dashboard');
    }
}