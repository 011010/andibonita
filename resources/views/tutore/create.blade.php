@extends('layouts.app')

@section('template_title')
    {{ __('Create') }} Tutore
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Create') }} Tutore</span>
                    </div>
                    <div class="card-body bg-white">
                        <form method="POST" action="{{ route('tutores.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            <input type="file" name="import_file" />
                            <button class="btn btn-primary" type="submit">Importar</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
