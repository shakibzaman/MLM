
<div class="mb-3 row">
    <label for="request_type" class="col-form-label text-lg-end col-lg-2 col-xl-3">Request Type</label>
    <div class="col-lg-10 col-xl-9">
        <input class="form-control{{ $errors->has('request_type') ? ' is-invalid' : '' }}" name="request_type" type="text" id="request_type" value="{{ old('request_type', optional($purchaseRequest)->request_type) }}" minlength="1" placeholder="Enter request type here...">
        {!! $errors->first('request_type', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="mb-3 row">
    <label for="user_id" class="col-form-label text-lg-end col-lg-2 col-xl-3">User</label>
    <div class="col-lg-10 col-xl-9">
        <select class="form-select{{ $errors->has('user_id') ? ' is-invalid' : '' }}" id="user_id" name="user_id">
        	    <option value="" style="display: none;" {{ old('user_id', optional($purchaseRequest)->user_id ?: '') == '' ? 'selected' : '' }} disabled selected>Select user</option>
        	@foreach ($users as $key => $user)
			    <option value="{{ $key }}" {{ old('user_id', optional($purchaseRequest)->user_id) == $key ? 'selected' : '' }}>
			    	{{ $user }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('user_id', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="mb-3 row">
    <label for="status" class="col-form-label text-lg-end col-lg-2 col-xl-3">Status</label>
    <div class="col-lg-10 col-xl-9">
        <input class="form-control{{ $errors->has('status') ? ' is-invalid' : '' }}" name="status" type="text" id="status" value="{{ old('status', optional($purchaseRequest)->status) }}" minlength="1" placeholder="Enter status here...">
        {!! $errors->first('status', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

