@extends('layouts.app')

@section('template_title')
    Tutores
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Tutores') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('tutores.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Create New') }}
                                </a>
                              </div>
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success m-4">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="card-body bg-white">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>
                                        
									<th >Division</th>
									<th >Nombre</th>
									<th >A Paterno</th>
									<th >A Materno</th>
									<th >Correo Electronico</th>
									<th >Contraseña</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($tutores as $tutore)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
										<td >{{ $tutore->division }}</td>
										<td >{{ $tutore->nombre }}</td>
										<td >{{ $tutore->a_paterno }}</td>
										<td >{{ $tutore->a_materno }}</td>
										<td >{{ $tutore->correo_electronico }}</td>
										<td >{{ $tutore->contraseña }}</td>

                                            <td>
                                                <form action="{{ route('tutores.destroy', $tutore->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('tutores.show', $tutore->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('tutores.edit', $tutore->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="event.preventDefault(); confirm('Are you sure to delete?') ? this.closest('form').submit() : false;"><i class="fa fa-fw fa-trash"></i> {{ __('Delete') }}</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $tutores->withQueryString()->links() !!}
            </div>
        </div>
    </div>
@endsection
