<div class="row padding-1 p-1">
    <div class="col-md-12">
        
        <div class="form-group mb-2 mb20">
            <label for="nombrerol" class="form-label">{{ __('Nombrerol') }}</label>
            <input type="text" name="nombrerol" class="form-control @error('nombrerol') is-invalid @enderror" value="{{ old('nombrerol', $role?->nombrerol) }}" id="nombrerol" placeholder="Nombrerol">
            {!! $errors->first('nombrerol', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>