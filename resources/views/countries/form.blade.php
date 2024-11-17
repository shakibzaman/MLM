
<div class="mb-3 row">
    <label for="name" class="col-form-label text-lg-end col-lg-2 col-xl-3">Name</label>
    <div class="col-lg-10 col-xl-9">
        <input class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" type="text" id="name" value="{{ old('name', optional($country)->name) }}" minlength="1" maxlength="255" placeholder="Enter name here...">
        {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="mb-3 row">
    <label for="short_code" class="col-form-label text-lg-end col-lg-2 col-xl-3">Short Code</label>
    <div class="col-lg-10 col-xl-9">
        <input class="form-control{{ $errors->has('short_code') ? ' is-invalid' : '' }}" name="short_code" type="text" id="short_code" value="{{ old('short_code', optional($country)->short_code) }}" minlength="1" placeholder="Enter short code here...">
        {!! $errors->first('short_code', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="mb-3 row">
    <label for="flag" class="col-form-label text-lg-end col-lg-2 col-xl-3">Flag</label>
    <div class="col-lg-10 col-xl-9">
        <div class="mb-3">
            <input class="form-control{{ $errors->has('flag') ? ' is-invalid' : '' }}" type="file" name="flag" id="flag" class="">
        </div>

        @if (isset($country->flag) && !empty($country->flag))

        <div class="input-group mb-3">
          <div class="form-check">
            <input type="checkbox" name="custom_delete_flag" id="custom_delete_flag" class="form-check-input custom-delete-file" value="1" {{ old('custom_delete_flag', '0') == '1' ? 'checked' : '' }}> 
          </div>
          <label class="form-check-label" for="custom_delete_flag"> Delete {{ $country->flag }}</label>
        </div>

        @endif

        {!! $errors->first('flag', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="mb-3 row">
    <label for="is_active" class="col-form-label text-lg-end col-lg-2 col-xl-3">Is Active</label>
    <div class="col-lg-10 col-xl-9">
        <div class="form-check checkbox">
            <input id="is_active_1" class="form-check-input" name="is_active" type="checkbox" value="1" {{ old('is_active', optional($country)->is_active) == '1' ? 'checked' : '' }}>
            <label class="form-check-label" for="is_active_1">
                Yes
            </label>
        </div>


        {!! $errors->first('is_active', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

