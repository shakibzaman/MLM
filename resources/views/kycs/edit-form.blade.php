<div class="mb-3 row" style="display: none;">
    <label for="customer_id" class="col-form-label text-lg-end col-lg-2 col-xl-3">Customer</label>
    <div class="col-lg-10 col-xl-9">
        <select class="form-select{{ $errors->has('customer_id') ? ' is-invalid' : '' }} form-control" id="customer_id"
            name="customer_id">
            <option value="" style="display: none;" {{ old('customer_id', optional($kyc)->customer_id ?: '') == '' ?
                'selected' : '' }} disabled selected>Select customer</option>
            @foreach ($customers as $key => $customer)
            <option value="{{ $key }}" {{ old('customer_id', optional($kyc)->customer_id) == $key ? 'selected' : '' }}>
                {{ $customer }}
            </option>
            @endforeach
        </select>

        {!! $errors->first('customer_id', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="mb-3 row">
    <label for="document_type" class="col-form-label text-lg-end col-lg-2 col-xl-3">Document Type</label>
    <div class="col-lg-10 col-xl-9">
        <select class="form-select{{ $errors->has('document_type') ? ' is-invalid' : '' }} form-control"
            id="document_type" name="document_type">
            <option value="" style="display: none;" {{ old('document_type', optional($kyc)->document_type ?: '') == '' ?
                'selected' : '' }} disabled selected>Select Document Type </option>
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
    <label for="document_number" class="col-form-label text-lg-end col-lg-2 col-xl-3">Document Number</label>
    <div class="col-lg-10 col-xl-9">
        <input class="form-control{{ $errors->has('document_number') ? ' is-invalid' : '' }}" name="document_number"
            type="number" id="document_number" value="{{ old('document_number', optional($kyc)->document_number) }}"
            placeholder="Enter document number here...">
        {!! $errors->first('document_number', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="mb-3 row">
    <label for="image" class="col-form-label text-lg-end col-lg-2 col-xl-3">Image</label>
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
            <label class="form-check-label" for="custom_delete_image"> Delete {{ $kyc->image }}</label>
        </div>

        @endif

        {!! $errors->first('image', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>
<div class="mb-3 row">
    <label for="status" class="col-form-label text-lg-end col-lg-2 col-xl-3">Document Status</label>
    <div class="col-lg-10 col-xl-9">
        <select class="form-select{{ $errors->has('status') ? ' is-invalid' : '' }} form-control" id="status"
            name="status">
            <option value="" style="display: none;" {{ old('status', optional($kyc)->status ?: '') == '' ? 'selected' :
                '' }} disabled selected>Select Document Status</option>
            @foreach ($documentStatuses as $key => $value)
            <option value="{{ $key }}" {{ old('status', optional($kyc)->status) == $key ? 'selected' : '' }}>
                {{ $key }}
            </option>
            @endforeach
        </select>
        {!! $errors->first('status', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>