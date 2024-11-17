
<div class="mb-3 row">
    <label for="coopon" class="col-form-label text-lg-end col-lg-2 col-xl-3">Coopon</label>
    <div class="col-lg-10 col-xl-9">
        <input class="form-control{{ $errors->has('coopon') ? ' is-invalid' : '' }}" name="coopon" type="text" id="coopon" value="{{ old('coopon', optional($coopon)->coopon) }}" minlength="1" placeholder="Enter coopon here...">
        {!! $errors->first('coopon', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="mb-3 row">
    <label for="expire_date" class="col-form-label text-lg-end col-lg-2 col-xl-3">Expire Date</label>
    <div class="col-lg-10 col-xl-9">
        <input class="form-control{{ $errors->has('expire_date') ? ' is-invalid' : '' }}" name="expire_date" type="date" id="expire_date" value="{{ old('expire_date', optional($coopon)->expire_date) }}" placeholder="Enter expire date here...">
        {!! $errors->first('expire_date', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="mb-3 row">
    <label for="is_active" class="col-form-label text-lg-end col-lg-2 col-xl-3">Is Active</label>
    <div class="col-lg-10 col-xl-9">
        <div class="form-check checkbox">
            <input id="is_active_1" class="form-check-input" name="is_active" type="checkbox" value="1" {{ old('is_active', optional($coopon)->is_active) == '1' ? 'checked' : '' }}>
            <label class="form-check-label" for="is_active_1">
                Yes
            </label>
        </div>


        {!! $errors->first('is_active', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

