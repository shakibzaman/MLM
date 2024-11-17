<div class="mb-3 row">
    <label for="amount" class="col-form-label text-lg-end col-lg-2 col-xl-3">{{ __('amount') }}</label>
    <div class="col-lg-10 col-xl-9">
        <input class="form-control{{ $errors->has('amount') ? ' is-invalid' : '' }}" name="amount" type="text"
            id="amount" value="{{ old('amount', optional($deposit)->amount) }}" minlength="1"
            placeholder="Enter amount here...">
        {!! $errors->first('amount', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

