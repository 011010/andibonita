<div class="row padding-1 p-1">
    <div class="col-md-12">
        
        <div class="form-group mb-2 mb20">
            <label for="imagendeperfil" class="form-label">{{ __('Imagendeperfil') }}</label>
            <input type="text" name="imagendeperfil" class="form-control @error('imagendeperfil') is-invalid @enderror" value="{{ old('imagendeperfil', $tutore?->imagendeperfil) }}" id="imagendeperfil" placeholder="Imagendeperfil">
            {!! $errors->first('imagendeperfil', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="nombres" class="form-label">{{ __('Nombres') }}</label>
            <input type="text" name="nombres" class="form-control @error('nombres') is-invalid @enderror" value="{{ old('nombres', $tutore?->nombres) }}" id="nombres" placeholder="Nombres">
            {!! $errors->first('nombres', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="a_paterno" class="form-label">{{ __('A Paterno') }}</label>
            <input type="text" name="a_paterno" class="form-control @error('a_paterno') is-invalid @enderror" value="{{ old('a_paterno', $tutore?->a_paterno) }}" id="a_paterno" placeholder="A Paterno">
            {!! $errors->first('a_paterno', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="a_materno" class="form-label">{{ __('A Materno') }}</label>
            <input type="text" name="a_materno" class="form-control @error('a_materno') is-invalid @enderror" value="{{ old('a_materno', $tutore?->a_materno) }}" id="a_materno" placeholder="A Materno">
            {!! $errors->first('a_materno', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="division" class="form-label">{{ __('Division') }}</label>
            <input type="text" name="division" class="form-control @error('division') is-invalid @enderror" value="{{ old('division', $tutore?->division) }}" id="division" placeholder="Division">
            {!! $errors->first('division', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="teléfono" class="form-label">{{ __('Teléfono') }}</label>
            <input type="text" name="teléfono" class="form-control @error('teléfono') is-invalid @enderror" value="{{ old('teléfono', $tutore?->teléfono) }}" id="teléfono" placeholder="Teléfono">
            {!! $errors->first('teléfono', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="perfil" class="form-label">{{ __('Perfil') }}</label>
            <input type="text" name="perfil" class="form-control @error('perfil') is-invalid @enderror" value="{{ old('perfil', $tutore?->perfil) }}" id="perfil" placeholder="Perfil">
            {!! $errors->first('perfil', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="correoelectronico" class="form-label">{{ __('Correoelectronico') }}</label>
            <input type="text" name="correoelectronico" class="form-control @error('correoelectronico') is-invalid @enderror" value="{{ old('correoelectronico', $tutore?->correoelectronico) }}" id="correoelectronico" placeholder="Correoelectronico">
            {!! $errors->first('correoelectronico', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="contraseña" class="form-label">{{ __('Contraseña') }}</label>
            <input type="text" name="contraseña" class="form-control @error('contraseña') is-invalid @enderror" value="{{ old('contraseña', $tutore?->contraseña) }}" id="contraseña" placeholder="Contraseña">
            {!! $errors->first('contraseña', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="role" class="form-label">{{ __('Role') }}</label>
            <input type="text" name="role" class="form-control @error('role') is-invalid @enderror" value="{{ old('role', $tutore?->role) }}" id="role" placeholder="Role">
            {!! $errors->first('role', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>