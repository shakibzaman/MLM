<div class="mb-3 row">
    <label for="document_type" class="col-form-label text-lg-end col-lg-2 col-xl-3">{{ __('document_type') }}</label>
    <div class="col-lg-10 col-xl-9">
        <select class="form-select{{ $errors->has('document_type') ? ' is-invalid' : '' }} form-control"
            id="document_type" name="document_type">
            <option value="" style="display: none;" {{ old('document_type', optional($kyc)->document_type ?: '') == '' ?
                'selected' : '' }} disabled selected>{{ __('select_document_type') }} </option>
            @foreach ($documentTypes as $key => $value)
            <option value="{{ $value }}" {{ old('document_type', optional($kyc)->document_type) == $value ? 'selected' :
                ''
                }}>
                {{ $key }}
            </option>
            @endforeach
        </select>
        {!! $errors->first('document_type', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="mb-3 row">
    <label for="document_number" class="col-form-label text-lg-end col-lg-2 col-xl-3">{{ __('document_number')
        }}</label>
    <div class="col-lg-10 col-xl-9">
        <input class="form-control{{ $errors->has('document_number') ? ' is-invalid' : '' }}" name="document_number"
            type="number" id="document_number" value="{{ old('document_number', optional($kyc)->document_number) }}"
            placeholder="{{ __('enter_document_number_here') }}">
        {!! $errors->first('document_number', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="mb-3 row">
    <label for="image" class="col-form-label text-lg-end col-lg-2 col-xl-3">{{ __('image') }}</label>
    <div class="col-lg-10 col-xl-9">
        <div class="mb-3">
            <input class="form-control{{ $errors->has('image') ? ' is-invalid' : '' }}" type="file" name="image"
                id="image" class="">
        </div>

        @if (isset($kyc->image) && !empty($kyc->image))

        <div class="input-group mb-3">
            <div class="form-check">
                <input type="checkbox" name="custom_delete_image" id="custom_delete_image"
                    class="form-check-input custom-delete-file" value="1" {{ old('custom_delete_image', '0' )=='1'
                    ? 'checked' : '' }}>
            </div>
            <label class="form-check-label" for="custom_delete_image"> {{ __('delete') }} {{ $kyc->image }}</label>
        </div>

        @endif

        {!! $errors->first('image', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>