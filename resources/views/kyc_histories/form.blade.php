
<div class="mb-3 row">
    <label for="customer_id" class="col-form-label text-lg-end col-lg-2 col-xl-3">Customer</label>
    <div class="col-lg-10 col-xl-9">
        <select class="form-select{{ $errors->has('customer_id') ? ' is-invalid' : '' }}" id="customer_id" name="customer_id">
        	    <option value="" style="display: none;" {{ old('customer_id', optional($kycHistory)->customer_id ?: '') == '' ? 'selected' : '' }} disabled selected>Select customer</option>
        	@foreach ($customers as $key => $customer)
			    <option value="{{ $key }}" {{ old('customer_id', optional($kycHistory)->customer_id) == $key ? 'selected' : '' }}>
			    	{{ $customer }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('customer_id', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="mb-3 row">
    <label for="kyc_id" class="col-form-label text-lg-end col-lg-2 col-xl-3">Kyc</label>
    <div class="col-lg-10 col-xl-9">
        <select class="form-select{{ $errors->has('kyc_id') ? ' is-invalid' : '' }}" id="kyc_id" name="kyc_id">
        	    <option value="" style="display: none;" {{ old('kyc_id', optional($kycHistory)->kyc_id ?: '') == '' ? 'selected' : '' }} disabled selected>Select kyc</option>
        	@foreach ($kycs as $key => $kyc)
			    <option value="{{ $key }}" {{ old('kyc_id', optional($kycHistory)->kyc_id) == $key ? 'selected' : '' }}>
			    	{{ $kyc }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('kyc_id', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="mb-3 row">
    <label for="status" class="col-form-label text-lg-end col-lg-2 col-xl-3">Status</label>
    <div class="col-lg-10 col-xl-9">
        <input class="form-control{{ $errors->has('status') ? ' is-invalid' : '' }}" name="status" type="text" id="status" value="{{ old('status', optional($kycHistory)->status) }}" minlength="1" placeholder="Enter status here...">
        {!! $errors->first('status', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="mb-3 row">
    <label for="created_by" class="col-form-label text-lg-end col-lg-2 col-xl-3">Created By</label>
    <div class="col-lg-10 col-xl-9">
        <select class="form-select{{ $errors->has('created_by') ? ' is-invalid' : '' }}" id="created_by" name="created_by">
        	    <option value="" style="display: none;" {{ old('created_by', optional($kycHistory)->created_by ?: '') == '' ? 'selected' : '' }} disabled selected>Select created by</option>
        	@foreach ($creators as $key => $creator)
			    <option value="{{ $key }}" {{ old('created_by', optional($kycHistory)->created_by) == $key ? 'selected' : '' }}>
			    	{{ $creator }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('created_by', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

