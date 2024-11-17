@if(!$monthlyReward)
<div class="mb-3 row">
    <label for="month" class="col-form-label text-lg-end col-lg-2 col-xl-3">Month</label>
    <div class="col-lg-10 col-xl-9">
        <select name="month" class="form-select {{ $errors->has('month') ? ' is-invalid' : '' }}">
          <option value="">Select month</option>
          <option value="1">January</option>
          <option value="2">February</option>
          <option value="3">March</option>
          <option value="4">April</option>
          <option value="5">May</option>
          <option value="6">June</option>
          <option value="7">July</option>
          <option value="8">August</option>
          <option value="9">September</option>
          <option value="10">October</option>
          <option value="11">November</option>
          <option value="12">December </option>
        </select>
        {!! $errors->first('month', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>
@endif
<div class="mb-3 row">
    <label for="reward_amount" class="col-form-label text-lg-end col-lg-2 col-xl-3">Reward Amount</label>
    <div class="col-lg-10 col-xl-9">
        <input class="form-control{{ $errors->has('reward_amount') ? ' is-invalid' : '' }}" name="reward_amount" type="number" id="reward_amount" value="{{ old('reward_amount', optional($monthlyReward)->reward_amount) }}" minlength="1" placeholder="Enter reward amount here...">
        {!! $errors->first('reward_amount', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

