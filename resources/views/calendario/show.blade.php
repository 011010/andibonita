@extends('layouts.app')

@section('template_title')
    {{ $calendario->id ?? __('Show') . " " . __('calendarios') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Calendario</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('calendarios.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        
                                <div class="form-group mb-2 mb20">
                                    <strong>Semestre:</strong>
                                    {{ $tutorado->semestre }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Grupo:</strong>
                                    {{ $tutorado->grupo }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Carrera:</strong>
                                    {{ $tutorado->carrera }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Numerocontrol:</strong>
                                    {{ $tutorado->numerocontrol }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Nombre:</strong>
                                    {{ $tutorado->nombre }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>A Paterno:</strong>
                                    {{ $tutorado->a_paterno }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>A Materno:</strong>
                                    {{ $tutorado->a_materno }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Correoelectronico:</strong>
                                    {{ $tutorado->correoelectronico }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Contraseña:</strong>
                                    {{ $tutorado->contraseña }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Role:</strong>
                                    {{ $tutorado->role }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Tutor asignado:</strong>
                                    {{ $tutorado->tutor_id }}
                                </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
