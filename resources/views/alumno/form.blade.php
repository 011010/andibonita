<div class="row padding-1 p-1">
    <div class="col-md-12">
        
        <div class="form-group mb-2 mb20">
            <label for="semestre" class="form-label">{{ __('Semestre') }}</label>
            <input type="text" name="semestre" class="form-control @error('semestre') is-invalid @enderror" value="{{ old('semestre', $alumno?->semestre) }}" id="semestre" placeholder="Semestre">
            {!! $errors->first('semestre', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="grupo" class="form-label">{{ __('Grupo') }}</label>
            <input type="text" name="grupo" class="form-control @error('grupo') is-invalid @enderror" value="{{ old('grupo', $alumno?->grupo) }}" id="grupo" placeholder="Grupo">
            {!! $errors->first('grupo', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="numerodecontrol" class="form-label">{{ __('Numerodecontrol') }}</label>
            <input type="text" name="numerodecontrol" class="form-control @error('numerodecontrol') is-invalid @enderror" value="{{ old('numerodecontrol', $alumno?->numerodecontrol) }}" id="numerodecontrol" placeholder="Numerodecontrol">
            {!! $errors->first('numerodecontrol', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="nombre" class="form-label">{{ __('Nombre') }}</label>
            <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @enderror" value="{{ old('nombre', $alumno?->nombre) }}" id="nombre" placeholder="Nombre">
            {!! $errors->first('nombre', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="a_paterno" class="form-label">{{ __('A Paterno') }}</label>
            <input type="text" name="a_paterno" class="form-control @error('a_paterno') is-invalid @enderror" value="{{ old('a_paterno', $alumno?->a_paterno) }}" id="a_paterno" placeholder="A Paterno">
            {!! $errors->first('a_paterno', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="a_materno" class="form-label">{{ __('A Materno') }}</label>
            <input type="text" name="a_materno" class="form-control @error('a_materno') is-invalid @enderror" value="{{ old('a_materno', $alumno?->a_materno) }}" id="a_materno" placeholder="A Materno">
            {!! $errors->first('a_materno', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>