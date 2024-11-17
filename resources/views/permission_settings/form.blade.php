<div class="mb-3 row">
    <label for="email_verification" class="col-form-label text-lg-end col-lg-2 col-xl-3">Email Verification</label>
    <div class="col-lg-10 col-xl-9">
        <div class="form-check form-switch">
            <input name="email_verification" type="checkbox" id="email_verification" value="1" {{
                old('email_verification', optional($permissionSetting)->email_verification) ? 'checked' : '' }}>
        </div>
        {!! $errors->first('email_verification', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>
<div class="mb-3 row">
    <label for="kyc_verification" class="col-form-label text-lg-end col-lg-2 col-xl-3">Kyc Verification</label>
    <div class="col-lg-10 col-xl-9">
        <div class="form-check form-switch">
            <input name="kyc_verification" type="checkbox" id="kyc_verification" value="1" {{ old('kyc_verification',
                optional($permissionSetting)->kyc_verification) ? 'checked' : '' }}>
        </div>
        {!! $errors->first('kyc_verification', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>
<div class="mb-3 row">
    <label for="two_fa_verification" class="col-form-label text-lg-end col-lg-2 col-xl-3">2-Fa-Verification</label>
    <div class="col-lg-10 col-xl-9">
        <div class="form-check form-switch">
            <input name="two_fa_verification" type="checkbox" id="two_fa_verification" value="1" {{
                old('two_fa_verification', optional($permissionSetting)->two_fa_verification) ? 'checked' : '' }}>
        </div>
        {!! $errors->first('two_fa_verification', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="mb-3 row">
    <label for="account_creation" class="col-form-label text-lg-end col-lg-2 col-xl-3">Account Creation</label>
    <div class="col-lg-10 col-xl-9">
        <div class="form-check form-switch">
            <input name="account_creation" type="checkbox" id="account_creation" value="1" {{ old('account_creation',
                optional($permissionSetting)->account_creation) ? 'checked' : '' }}>
        </div>
        {!! $errors->first('account_creation', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="mb-3 row">
    <label for="user_deposit" class="col-form-label text-lg-end col-lg-2 col-xl-3">User Deposit</label>
    <div class="col-lg-10 col-xl-9">
        <div class="form-check form-switch">
            <input name="user_deposit" type="checkbox" id="user_deposit" value="1" {{ old('user_deposit',
                optional($permissionSetting)->user_deposit) ? 'checked' : '' }}>
        </div>
        {!! $errors->first('user_deposit', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>
<div class="mb-3 row">
    <label for="user_withdraw" class="col-form-label text-lg-end col-lg-2 col-xl-3">User Withdraw</label>
    <div class="col-lg-10 col-xl-9">
        <div class="form-check form-switch">
            <input name="user_withdraw" type="checkbox" id="user_withdraw" value="1" {{ old('user_withdraw',
                optional($permissionSetting)->user_withdraw) ? 'checked' : '' }}>
        </div>
        {!! $errors->first('user_withdraw', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="mb-3 row">
    <label for="user_send_money" class="col-form-label text-lg-end col-lg-2 col-xl-3">User Send Money</label>
    <div class="col-lg-10 col-xl-9">
        <div class="form-check form-switch">
            <input name="user_send_money" type="checkbox" id="user_send_money" value="1" {{ old('user_send_money',
                optional($permissionSetting)->user_send_money) ? 'checked' : '' }}>

        </div>
        {!! $errors->first('user_send_money', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>
<div class="mb-3 row">
    <label for="user_referral" class="col-form-label text-lg-end col-lg-2 col-xl-3">User Referral</label>
    <div class="col-lg-10 col-xl-9">
        <div class="form-check form-switch">
            <input name="user_referral" type="checkbox" id="user_referral" value="1" {{ old('user_referral',
                optional($permissionSetting)->user_referral) ? 'checked' : '' }}>

        </div>
        {!! $errors->first('user_referral', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="mb-3 row">
    <label for="signup_bonus" class="col-form-label text-lg-end col-lg-2 col-xl-3">Signup Bonus</label>
    <div class="col-lg-10 col-xl-9">
        <div class="form-check form-switch">
            <input name="signup_bonus" type="checkbox" id="signup_bonus" value="1" {{ old('signup_bonus',
                optional($permissionSetting)->signup_bonus) ? 'checked' : '' }}>

        </div>
        {!! $errors->first('signup_bonus', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="mb-3 row">
    <label for="investment_referral_bounty" class="col-form-label text-lg-end col-lg-2 col-xl-3">Investment Referral
        Bounty</label>
    <div class="col-lg-10 col-xl-9">
        <div class="form-check form-switch">
            <input name="investment_referral_bounty" type="checkbox" id="investment_referral_bounty" value="1" {{
                old('investment_referral_bounty', optional($permissionSetting)->investment_referral_bounty) ? 'checked'
            : '' }}>

        </div>
        {!! $errors->first('investment_referral_bounty', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="mb-3 row">
    <label for="deposit_referral_bounty" class="col-form-label text-lg-end col-lg-2 col-xl-3">Deposit Referral
        Bounty</label>
    <div class="col-lg-10 col-xl-9">
        <div class="form-check form-switch">
            <input name="deposit_referral_bounty" type="checkbox" id="deposit_referral_bounty" value="1" {{
                old('deposit_referral_bounty', optional($permissionSetting)->deposit_referral_bounty) ? 'checked' : ''
            }}>

        </div>
        {!! $errors->first('deposit_referral_bounty', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="mb-3 row">
    <label for="site_animation" class="col-form-label text-lg-end col-lg-2 col-xl-3">Site Animation</label>
    <div class="col-lg-10 col-xl-9">
        <div class="form-check form-switch">
            <input name="site_animation" type="checkbox" id="site_animation" value="1" {{ old('site_animation',
                optional($permissionSetting)->site_animation) ? 'checked' : '' }}>

        </div>
        {!! $errors->first('site_animation', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>


<div class="mb-3 row">
    <label for="site_back_to_top" class="col-form-label text-lg-end col-lg-2 col-xl-3">Back Site to Top</label>
    <div class="col-lg-10 col-xl-9">
        <div class="form-check form-switch">
            <input name="site_back_to_top" type="checkbox" id="site_back_to_top" value="1" {{ old('site_back_to_top',
                optional($permissionSetting)->site_back_to_top) ? 'checked' : '' }}>

        </div>
        {!! $errors->first('site_back_to_top', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="mb-3 row">
    <label for="development_mode" class="col-form-label text-lg-end col-lg-2 col-xl-3">Development Mode</label>
    <div class="col-lg-10 col-xl-9">
        <div class="form-check form-switch">
            <input name="development_mode" type="checkbox" id="development_mode" value="1" {{ old('development_mode',
                optional($permissionSetting)->development_mode) ? 'checked' : '' }}>

        </div>
        {!! $errors->first('development_mode', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>


<style>
    .form-check.form-switch input {
        width: 100%;
        height: 150%;
    }
</style>