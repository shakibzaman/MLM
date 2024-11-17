
<div class="mb-3 row">
    <label for="reward_site_id" class="col-form-label text-lg-end col-lg-2 col-xl-3">Reward Site</label>
    <div class="col-lg-10 col-xl-9">
        <select class="form-select{{ $errors->has('reward_site_id') ? ' is-invalid' : '' }}" id="reward_site_id" name="reward_site_id">
        	    <option value="" style="display: none;" {{ old('reward_site_id', optional($rewardTypeMapping)->reward_site_id ?: '') == '' ? 'selected' : '' }} disabled selected>Select reward site</option>
        	@foreach ($rewardSites as $key => $rewardSite)
			    <option value="{{ $key }}" {{ old('reward_site_id', optional($rewardTypeMapping)->reward_site_id) == $key ? 'selected' : '' }}>
			    	{{ $rewardSite }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('reward_site_id', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="mb-3 row">
    <label for="reward_submit_type_id" class="col-form-label text-lg-end col-lg-2 col-xl-3">Reward Submit Type</label>
    <div class="col-lg-10 col-xl-9">
        <select class="form-select{{ $errors->has('reward_submit_type_id') ? ' is-invalid' : '' }}" id="reward_submit_type_id" name="reward_submit_type_id">
        	    <option value="" style="display: none;" {{ old('reward_submit_type_id', optional($rewardTypeMapping)->reward_submit_type_id ?: '') == '' ? 'selected' : '' }} disabled selected>Select reward submit type</option>
        	@foreach ($rewardSubmitTypes as $key => $rewardSubmitType)
			    <option value="{{ $key }}" {{ old('reward_submit_type_id', optional($rewardTypeMapping)->reward_submit_type_id) == $key ? 'selected' : '' }}>
			    	{{ $rewardSubmitType }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('reward_submit_type_id', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="mb-3 row">
    <label for="reward_amount" class="col-form-label text-lg-end col-lg-2 col-xl-3">Reward Amount</label>
    <div class="col-lg-10 col-xl-9">
        <input class="form-control{{ $errors->has('reward_amount') ? ' is-invalid' : '' }}" name="reward_amount" type="text" id="reward_amount" value="{{ old('reward_amount', optional($rewardTypeMapping)->reward_amount) }}" minlength="1" placeholder="Enter reward amount here...">
        {!! $errors->first('reward_amount', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="mb-3 row">
    <label for="is_active" class="col-form-label text-lg-end col-lg-2 col-xl-3">Is Active</label>
    <div class="col-lg-10 col-xl-9">
        <div class="form-check checkbox">
            <input id="is_active_1" class="form-check-input" name="is_active" type="checkbox" value="1" {{ old('is_active', optional($rewardTypeMapping)->is_active) == '1' ? 'checked' : '' }}>
            <label class="form-check-label" for="is_active_1">
                Yes
            </label>
        </div>


        {!! $errors->first('is_active', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

