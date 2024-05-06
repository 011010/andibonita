@extends('layouts.app')

@section('template_title')
    {{ $alumno->name ?? __('Show') . " " . __('Alumno') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Alumno</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('alumnos.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        
                                <div class="form-group mb-2 mb20">
                                    <strong>Semestre:</strong>
                                    {{ $alumno->semestre }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Grupo:</strong>
                                    {{ $alumno->grupo }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Numerodecontrol:</strong>
                                    {{ $alumno->numerodecontrol }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Nombre:</strong>
                                    {{ $alumno->nombre }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>A Paterno:</strong>
                                    {{ $alumno->a_paterno }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>A Materno:</strong>
                                    {{ $alumno->a_materno }}
                                </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
