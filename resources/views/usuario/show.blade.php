@extends('layouts.app')

@section('template_title')
    {{ $usuario->name ?? __('Show') . " " . __('Usuario') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Usuario</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('usuarios.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        
                                <div class="form-group mb-2 mb20">
                                    <strong>Imagendeperfil:</strong>
                                    {{ $usuario->imagendeperfil }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Nombres:</strong>
                                    {{ $usuario->nombres }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>A Paterno:</strong>
                                    {{ $usuario->a_paterno }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>A Materno:</strong>
                                    {{ $usuario->a_materno }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Teléfono:</strong>
                                    {{ $usuario->teléfono }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Perfil:</strong>
                                    {{ $usuario->perfil }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Correoelectronico:</strong>
                                    {{ $usuario->correoelectronico }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Contraseña:</strong>
                                    {{ $usuario->contraseña }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Role:</strong>
                                    {{ $usuario->role }}
                                </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
