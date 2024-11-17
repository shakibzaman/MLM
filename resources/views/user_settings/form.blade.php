<div class="row">
    <div class="col-md-6">
        <div class="mb-3 row">
            <label for="min_password_length" class="col-form-label text-lg-end col-lg-2 col-xl-3">Min Password
                Length</label>
            <div class="col-lg-10 col-xl-9">
                <input class="form-control{{ $errors->has('min_password_length') ? ' is-invalid' : '' }}"
                    name="min_password_length" type="text" id="min_password_length"
                    value="{{ old('min_password_length', optional($userSetting)->min_password_length) }}"
                    placeholder="Enter min password length here...">
                {!! $errors->first('min_password_length', '<div class="invalid-feedback">:message</div>') !!}
            </div>
        </div>



        <div class="mb-3 row">
            <label for="password_for_withdraw" class="col-form-label text-lg-end col-lg-2 col-xl-3">Password For
                Withdraw</label>
            <div class="col-lg-10 col-xl-9">
                <div class="form-check checkbox">
                    <input id="password_for_withdraw" class="form-check-input" name="password_for_withdraw"
                        type="checkbox" value="1" {{ old('password_for_withdraw',
                        optional($userSetting)->password_for_withdraw) == 1 ? 'checked' : 0 }}>
                    <label class="form-check-label" for="password_for_withdraw">
                        Enable Password for Withdraw
                    </label>
                </div>
                {!! $errors->first('password_for_withdraw', '<div class="invalid-feedback">:message</div>') !!}
            </div>
        </div>


        <div class="mb-3 row">
            <label for="confirm_code_account_update" class="col-form-label text-lg-end col-lg-2 col-xl-3">Confirm Code
                Account
                Update</label>
            <div class="col-lg-10 col-xl-9">
                <div class="form-check checkbox">
                    <input id="confirm_code_account_update" class="form-check-input" name="confirm_code_account_update"
                        type="checkbox" value="1" {{ old('confirm_code_account_update',
                        optional($userSetting)->confirm_code_account_update) == '1' ? 'checked' : '' }}>
                    <label class="form-check-label" for="confirm_code_account_update">
                        Enable Confirm Code for Account Update
                    </label>
                </div>
                {!! $errors->first('confirm_code_account_update', '<div class="invalid-feedback">:message</div>') !!}
            </div>
        </div>


        <div class="mb-3 row">
            <label for="notify_status" class="col-form-label text-lg-end col-lg-2 col-xl-3">Notify Status</label>
            <div class="col-lg-10 col-xl-9">
                <div class="form-check checkbox">
                    <input id="notify_status" class="form-check-input" name="notify_status" type="checkbox" value="1" {{
                        old('notify_status', optional($userSetting)->notify_status) == '1' ? 'checked' : '' }}>
                    <label class="form-check-label" for="notify_status">
                        Enable Notify Status
                    </label>
                </div>
                {!! $errors->first('notify_status', '<div class="invalid-feedback">:message</div>') !!}
            </div>
        </div>


        <div class="mb-3 row">
            <label for="subscription_type" class="col-form-label text-lg-end col-lg-2 col-xl-3">Subscription
                Type</label>
            <div class="col-lg-10 col-xl-9">
                <select class="form-select{{ $errors->has('subscription_type') ? ' is-invalid' : '' }}"
                    id="subscription_type" name="subscription_type">
                    <option value="" style="display: none;" {{ old('subscription_type', optional($userSetting)->
                        subscription_type ?: '') == '' ? 'selected' : '' }} disabled selected>Select subscription type
                        here...
                    </option>
                    @foreach (['monthly' => 'monthly',
                    'yearly' => 'yearly'] as $key => $text)
                    <option value="{{ $key }}" {{ old('subscription_type', optional($userSetting)->subscription_type) ==
                        $key ?
                        'selected' : '' }}>
                        {{ $text }}
                    </option>
                    @endforeach
                </select>

                {!! $errors->first('subscription_type', '<div class="invalid-feedback">:message</div>') !!}
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3 row">
            <label for="max_password_length" class="col-form-label text-lg-end col-lg-2 col-xl-3">Max Password
                Length</label>
            <div class="col-lg-10 col-xl-9">
                <input class="form-control{{ $errors->has('max_password_length') ? ' is-invalid' : '' }}"
                    name="max_password_length" type="text" id="max_password_length"
                    value="{{ old('max_password_length', optional($userSetting)->max_password_length) }}"
                    placeholder="Enter max password length here..." required>
                {!! $errors->first('max_password_length', '<div class="invalid-feedback">:message</div>') !!}
            </div>
        </div>
        <div class="mb-3 row">
            <label for="password_for_edit_profile" class="col-form-label text-lg-end col-lg-2 col-xl-3">
                Password For Edit Profile
            </label>
            <div class="col-lg-10 col-xl-9">
                <div class="form-check checkbox">
                    <input id="password_for_edit_profile" class="form-check-input" name="password_for_edit_profile"
                        type="checkbox" value="1" {{ old('password_for_edit_profile',
                        optional($userSetting)->password_for_edit_profile) == '1' ? 'checked' : '' }}>
                    <label class="form-check-label" for="password_for_edit_profile">
                        Enable Password for Edit Profile
                    </label>
                </div>
                {!! $errors->first('password_for_edit_profile', '<div class="invalid-feedback">:message</div>') !!}
            </div>
        </div>


        <div class="mb-3 row">
            <label for="email_change_status" class="col-form-label text-lg-end col-lg-2 col-xl-3">
                Email Change Status
            </label>
            <div class="col-lg-10 col-xl-9">
                <div class="form-check checkbox">
                    <input id="email_change_status" class="form-check-input" name="email_change_status" type="checkbox"
                        value="1" {{ old('email_change_status', optional($userSetting)->email_change_status) == '1' ?
                    'checked'
                    : '' }}>
                    <label class="form-check-label" for="email_change_status">
                        Disable Email Change
                    </label>
                </div>
                {!! $errors->first('email_change_status', '<div class="invalid-feedback">:message</div>') !!}
            </div>
        </div>


        <div class="mb-3 row">
            <label for="subscription_status" class="col-form-label text-lg-end col-lg-2 col-xl-3">
                Subscription Status
            </label>
            <div class="col-lg-10 col-xl-9">
                <div class="form-check checkbox">
                    <input id="subscription_status" class="form-check-input" name="subscription_status" type="checkbox"
                        value="1" {{ old('subscription_status', optional($userSetting)->subscription_status) == '1' ?
                    'checked'
                    : '' }}>
                    <label class="form-check-label" for="subscription_status">
                        Enable Subscription
                    </label>
                </div>
                {!! $errors->first('subscription_status', '<div class="invalid-feedback">:message</div>') !!}
            </div>
        </div>


        <div class="mb-3 row">
            <label for="subscription_grace_period" class="col-form-label text-lg-end col-lg-2 col-xl-3">Subscription
                Grace
                Period</label>
            <div class="col-lg-10 col-xl-9">
                <input class="form-control{{ $errors->has('subscription_grace_period') ? ' is-invalid' : '' }}"
                    name="subscription_grace_period" type="text" id="subscription_grace_period"
                    value="{{ old('subscription_grace_period', optional($userSetting)->subscription_grace_period) }}"
                    minlength="1" placeholder="Enter subscription grace period here...">
                {!! $errors->first('subscription_grace_period', '<div class="invalid-feedback">:message</div>') !!}
            </div>
        </div>
    </div>
</div>