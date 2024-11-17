<div class="mb-3 row">
    <label for="name" class="col-form-label text-lg-end col-lg-2 col-xl-3">Name</label>
    <div class="col-lg-10 col-xl-9">
        <input class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" type="text" id="name"
            value="{{ old('name', optional($coupon)->name) }}" minlength="1" maxlength="255"
            placeholder="Enter name here..." required>
        {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="mb-3 row">
    <label for="code" class="col-form-label text-lg-end col-lg-2 col-xl-3">Code</label>
    <div class="col-lg-10 col-xl-9">
        <input class="form-control{{ $errors->has('code') ? ' is-invalid' : '' }}" name="code" type="text" id="code"
            value="{{ old('code', optional($coupon)->code) }}" placeholder="Enter code here..." pattern="[A-Z0-9]{8,12}"
            title="Code must be 8 to 12 characters long and consist only of uppercase letters and numbers" required>
        {!! $errors->first('code', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="mb-3 row">
    <label for="validate_date" class="col-form-label text-lg-end col-lg-2 col-xl-3">Validate Date</label>
    <div class="col-lg-10 col-xl-9">
        <input class="form-control{{ $errors->has('validate_date') ? ' is-invalid' : '' }}" name="validate_date"
            type="date" id="validate_date" value="{{ old('validate_date', optional($coupon)->validate_date) }}"
            placeholder="Enter validate date here..." required>
        {!! $errors->first('validate_date', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="mb-3 row">
    <label for="validate_user_limit" class="col-form-label text-lg-end col-lg-2 col-xl-3">Validate User Limit</label>
    <div class="col-lg-10 col-xl-9">
        <input class="form-control{{ $errors->has('validate_user_limit') ? ' is-invalid' : '' }}"
            name="validate_user_limit" type="text" id="validate_user_limit"
            value="{{ old('validate_user_limit', optional($coupon)->validate_user_limit) }}" minlength="1"
            placeholder="Enter validate user limit here...">
        {!! $errors->first('validate_user_limit', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="mb-3 row">
    <label for="point_amount" class="col-form-label text-lg-end col-lg-2 col-xl-3">Point Amount</label>
    <div class="col-lg-10 col-xl-9">
        <input class="form-control{{ $errors->has('point_amount') ? ' is-invalid' : '' }}" name="point_amount"
            type="text" id="point_amount" value="{{ old('point_amount', optional($coupon)->point_amount) }}"
            minlength="1" placeholder="Enter point amount here..." required>
        {!! $errors->first('point_amount', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="mb-3 row">
    <label for="is_active" class="col-form-label text-lg-end col-lg-2 col-xl-3">Is Active</label>
    <div class="col-lg-10 col-xl-9">
        <div class="form-check checkbox">
            <input id="is_active_1" class="form-check-input" name="is_active" type="checkbox" value="1" {{
                old('is_active', optional($coupon)->is_active) == '1' ? 'checked' : '' }} required>
            <label class="form-check-label" for="is_active_1">
                Yes
            </label>
        </div>


        {!! $errors->first('is_active', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>