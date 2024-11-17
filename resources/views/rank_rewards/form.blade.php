
<div class="mb-3 row">
    <label for="name" class="col-form-label text-lg-end col-lg-2 col-xl-3">Name</label>
    <div class="col-lg-10 col-xl-9">
        <input class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" type="text" id="name" value="{{ old('name', optional($rankReward)->name) }}" minlength="1" maxlength="255" placeholder="Enter name here...">
        {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="mb-3 row">
    <label for="bonus" class="col-form-label text-lg-end col-lg-2 col-xl-3">Bonus</label>
    <div class="col-lg-10 col-xl-9">
        <input class="form-control{{ $errors->has('bonus') ? ' is-invalid' : '' }}" name="bonus" type="number" id="bonus" value="{{ old('bonus', optional($rankReward)->bonus) }}" min="1" max="9" placeholder="Enter bonus here...">
        {!! $errors->first('bonus', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="mb-3 row">
    <label for="minimum_referrals" class="col-form-label text-lg-end col-lg-2 col-xl-3">Minimum Referrals</label>
    <div class="col-lg-10 col-xl-9">
        <input class="form-control{{ $errors->has('minimum_referrals') ? ' is-invalid' : '' }}" name="minimum_referrals" type="number" id="minimum_referrals" value="{{ old('minimum_referrals', optional($rankReward)->minimum_referrals) }}" min="1" placeholder="Enter minimum referrals here...">
        {!! $errors->first('minimum_referrals', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="mb-3 row">
    <label for="direct_referrals" class="col-form-label text-lg-end col-lg-2 col-xl-3">Direct Referrals</label>
    <div class="col-lg-10 col-xl-9">
        <input class="form-control{{ $errors->has('direct_referrals') ? ' is-invalid' : '' }}" name="direct_referrals" type="number" id="direct_referrals" value="{{ old('direct_referrals', optional($rankReward)->direct_referrals) }}" min="1" placeholder="Enter direct referrals here...">
        {!! $errors->first('direct_referrals', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="mb-3 row">
    <label for="active_subscribers" class="col-form-label text-lg-end col-lg-2 col-xl-3">Active Subscribers</label>
    <div class="col-lg-10 col-xl-9">
        <input class="form-control{{ $errors->has('active_subscribers') ? ' is-invalid' : '' }}" name="active_subscribers" type="number" id="active_subscribers" value="{{ old('active_subscribers', optional($rankReward)->active_subscribers) }}" min="1" placeholder="Enter active subscribers here...">
        {!! $errors->first('active_subscribers', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="mb-3 row">
    <label for="earnings" class="col-form-label text-lg-end col-lg-2 col-xl-3">Earnings</label>
    <div class="col-lg-10 col-xl-9">
        <input class="form-control{{ $errors->has('earnings') ? ' is-invalid' : '' }}" name="earnings" type="number" id="earnings" value="{{ old('earnings', optional($rankReward)->earnings) }}" min="1" max="9" placeholder="Enter earnings here...">
        {!! $errors->first('earnings', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="mb-3 row">
    <label for="days" class="col-form-label text-lg-end col-lg-2 col-xl-3">Days</label>
    <div class="col-lg-10 col-xl-9">
        <input class="form-control{{ $errors->has('days') ? ' is-invalid' : '' }}" name="days" type="number" id="days" value="{{ old('days', optional($rankReward)->days) }}" min="1" placeholder="Enter days here...">
        {!! $errors->first('days', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="mb-3 row">
    <label for="badge" class="col-form-label text-lg-end col-lg-2 col-xl-3">Badge</label>
    <div class="col-lg-10 col-xl-9">
        <div class="mb-3">
            <input class="form-control{{ $errors->has('badge') ? ' is-invalid' : '' }}" type="file" name="badge" id="badge" class="">
        </div>

        @if (isset($rankReward->badge) && !empty($rankReward->badge))

        <div class="input-group mb-3">
          <div class="form-check">
            <input type="checkbox" name="custom_delete_badge" id="custom_delete_badge" class="form-check-input custom-delete-file" value="1" {{ old('custom_delete_badge', '0') == '1' ? 'checked' : '' }}> 
          </div>
          <label class="form-check-label" for="custom_delete_badge"> Delete {{ $rankReward->badge }}</label>
        </div>

        @endif

        {!! $errors->first('badge', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

