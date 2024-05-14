@extends('layouts.app')

@section('template_title')
    Tutorados
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Tutorados') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('tutorados.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
                                        
									<th >Semestre</th>
									<th >Grupo</th>
									<th >Carrera</th>
									<th >Numerocontrol</th>
									<th >Nombre</th>
									<th >A Paterno</th>
									<th >A Materno</th>
									<th >Correoelectronico</th>
									<th >Contraseña</th>
									<th >Role</th>
									<th >Asignar Tutor</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($tutorados as $tutorado)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
										<td >{{ $tutorado->semestre }}</td>
										<td >{{ $tutorado->grupo }}</td>
										<td >{{ $tutorado->carrera }}</td>
										<td >{{ $tutorado->numerocontrol }}</td>
										<td >{{ $tutorado->nombre }}</td>
										<td >{{ $tutorado->a_paterno }}</td>
										<td >{{ $tutorado->a_materno }}</td>
										<td >{{ $tutorado->correoelectronico }}</td>
										<td >{{ $tutorado->contraseña }}</td>
										<td >{{ $tutorado->role }}</td>
										<td >{{ $tutorado->tutor_id }}</td>

                                            <td>
                                                <form action="{{ route('tutorados.destroy', $tutorado->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('tutorados.show', $tutorado->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('tutorados.edit', $tutorado->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
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
                {!! $tutorados->withQueryString()->links() !!}
            </div>
        </div>
    </div>
@endsection
