@extends('layouts.app')

@section('template_title')
    {{ $alumnosu->name ?? __('Show') . " " . __('Alumnosu') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Alumnosu</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('alumnosus.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        
                                <div class="form-group mb-2 mb20">
                                    <strong>Alumno Id:</strong>
                                    {{ $alumnosu->alumno_id }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Tutor Id:</strong>
                                    {{ $alumnosu->tutor_id }}
                                </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
