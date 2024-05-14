<div class="row padding-1 p-1">
    <div class="col-md-12">
        
        <div class="form-group mb-2 mb20">
            <label for="semestre" class="form-label">{{ __('Semestre') }}</label>
            <input type="text" name="semestre" class="form-control @error('semestre') is-invalid @enderror" value="{{ old('semestre', $tutorado?->semestre) }}" id="semestre" placeholder="Semestre">
            {!! $errors->first('semestre', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="grupo" class="form-label">{{ __('Grupo') }}</label>
            <input type="text" name="grupo" class="form-control @error('grupo') is-invalid @enderror" value="{{ old('grupo', $tutorado?->grupo) }}" id="grupo" placeholder="Grupo">
            {!! $errors->first('grupo', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="carrera" class="form-label">{{ __('Carrera') }}</label>
            <input type="text" name="carrera" class="form-control @error('carrera') is-invalid @enderror" value="{{ old('carrera', $tutorado?->carrera) }}" id="carrera" placeholder="Carrera">
            {!! $errors->first('carrera', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="numerocontrol" class="form-label">{{ __('Numerocontrol') }}</label>
            <input type="text" name="numerocontrol" class="form-control @error('numerocontrol') is-invalid @enderror" value="{{ old('numerocontrol', $tutorado?->numerocontrol) }}" id="numerocontrol" placeholder="Numerocontrol">
            {!! $errors->first('numerocontrol', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="nombre" class="form-label">{{ __('Nombre') }}</label>
            <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @enderror" value="{{ old('nombre', $tutorado?->nombre) }}" id="nombre" placeholder="Nombre">
            {!! $errors->first('nombre', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="a_paterno" class="form-label">{{ __('A Paterno') }}</label>
            <input type="text" name="a_paterno" class="form-control @error('a_paterno') is-invalid @enderror" value="{{ old('a_paterno', $tutorado?->a_paterno) }}" id="a_paterno" placeholder="A Paterno">
            {!! $errors->first('a_paterno', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="a_materno" class="form-label">{{ __('A Materno') }}</label>
            <input type="text" name="a_materno" class="form-control @error('a_materno') is-invalid @enderror" value="{{ old('a_materno', $tutorado?->a_materno) }}" id="a_materno" placeholder="A Materno">
            {!! $errors->first('a_materno', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="correoelectronico" class="form-label">{{ __('Correoelectronico') }}</label>
            <input type="text" name="correoelectronico" class="form-control @error('correoelectronico') is-invalid @enderror" value="{{ old('correoelectronico', $tutorado?->correoelectronico) }}" id="correoelectronico" placeholder="Correoelectronico">
            {!! $errors->first('correoelectronico', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="contraseña" class="form-label">{{ __('Contraseña') }}</label>
            <input type="text" name="contraseña" class="form-control @error('contraseña') is-invalid @enderror" value="{{ old('contraseña', $tutorado?->contraseña) }}" id="contraseña" placeholder="Contraseña">
            {!! $errors->first('contraseña', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="role" class="form-label">{{ __('Role') }}</label>
            <input type="text" name="role" class="form-control @error('role') is-invalid @enderror" value="{{ old('role', $tutorado?->role) }}" id="role" placeholder="Role">
            {!! $errors->first('role', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="tutor_id" class="form-label">{{ __('Tutor') }}</label>
            <select name="tutor_id" class="form-control @error('tutor_id') is-invalid @enderror" id="tutor_id">
                <option value="">Selecciona un tutor</option>
                @foreach($tutores as $tutor)
                    <option value="{{ $tutor->id }}" {{ old('tutor_id', $tutorado->tutor_id) == $tutor->id ? 'selected' : '' }}>
                        {{ $tutor->nombres }} {{ $tutor->a_paterno }} {{ $tutor->a_materno }} {{ $tutor->division }}
                    </option>
                @endforeach
            </select>
            {!! $errors->first('tutor_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        
        

    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>