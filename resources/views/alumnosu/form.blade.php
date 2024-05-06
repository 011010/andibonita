<div class="row padding-1 p-1">
    <div class="col-md-12">
        
        <div class="form-group mb-2 mb20">
            <label for="alumno_id" class="form-label">{{ __('Alumno Id') }}</label>
            <input type="text" name="alumno_id" class="form-control @error('alumno_id') is-invalid @enderror" value="{{ old('alumno_id', $alumnosu?->alumno_id) }}" id="alumno_id" placeholder="Alumno Id">
            {!! $errors->first('alumno_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="tutor_id" class="form-label">{{ __('Tutor Id') }}</label>
            <input type="text" name="tutor_id" class="form-control @error('tutor_id') is-invalid @enderror" value="{{ old('tutor_id', $alumnosu?->tutor_id) }}" id="tutor_id" placeholder="Tutor Id">
            {!! $errors->first('tutor_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>