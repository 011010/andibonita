@extends('layouts.app')

@section('template_title')
    Usuarios
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Usuarios') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('usuarios.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
                                        
									<th >Imagendeperfil</th>
									<th >Nombres</th>
									<th >A Paterno</th>
									<th >A Materno</th>
									<th >Teléfono</th>
									<th >Perfil</th>
									<th >Correoelectronico</th>
									<th >Contraseña</th>
									<th >Role</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($usuarios as $usuario)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
										<td >{{ $usuario->imagendeperfil }}</td>
										<td >{{ $usuario->nombres }}</td>
										<td >{{ $usuario->a_paterno }}</td>
										<td >{{ $usuario->a_materno }}</td>
										<td >{{ $usuario->teléfono }}</td>
										<td >{{ $usuario->perfil }}</td>
										<td >{{ $usuario->correoelectronico }}</td>
										<td >{{ $usuario->contraseña }}</td>
										<td >{{ $usuario->role }}</td>

                                            <td>
                                                <form action="{{ route('usuarios.destroy', $usuario->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('usuarios.show', $usuario->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('usuarios.edit', $usuario->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
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
                {!! $usuarios->withQueryString()->links() !!}
            </div>
        </div>
    </div>
@endsection
