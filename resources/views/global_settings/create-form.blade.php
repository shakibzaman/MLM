<div class="mb-3 row">
    <label for="site_fevicon" class="col-form-label text-lg-end col-lg-2 col-xl-3">Site Logo</label>
    <div class="col-lg-10 col-xl-9">
        <div class="mb-3">
            <input class="form-control{{ $errors->has('site_logo') ? ' is-invalid' : '' }}" type="file" name="site_logo"
                id="site_logo" class="">
        </div>

        @if (isset($globalSetting->site_logo) && !empty($globalSetting->site_logo))
        <div class="input-group mb-3">
            <div class="form-check">
                <input type="checkbox" name="custom_delete_site_logo" id="custom_delete_site_logo"
                    class="form-check-input custom-delete-file" value="1" {{ old('custom_delete_site_logo', '0' )=='1'
                    ? 'checked' : '' }}>
            </div>
            <label class="form-check-label" for="custom_delete_site_logo"> Delete {{ $globalSetting->site_logo
                }}</label>
        </div>

        @endif

        {!! $errors->first('site_logo', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>
<div class="mb-3 row">
    <label for="site_fevicon" class="col-form-label text-lg-end col-lg-2 col-xl-3">Site Fevicon</label>
    <div class="col-lg-10 col-xl-9">
        <div class="mb-3">
            <input class="form-control{{ $errors->has('site_fevicon') ? ' is-invalid' : '' }}" type="file"
                name="site_fevicon" id="site_fevicon" class="">
        </div>

        @if (isset($globalSetting->site_fevicon) && !empty($globalSetting->site_fevicon))
        <div class="input-group mb-3">
            <div class="form-check">
                <input type="checkbox" name="custom_delete_site_fevicon" id="custom_delete_site_fevicon"
                    class="form-check-input custom-delete-file" value="1" {{ old('custom_delete_site_fevicon', '0'
                    )=='1' ? 'checked' : '' }}>
            </div>
            <label class="form-check-label" for="custom_delete_site_fevicon"> Delete {{ $globalSetting->site_fevicon
                }}</label>
        </div>

        @endif

        {!! $errors->first('site_fevicon', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>
<div class="mb-3 row">
    <label for="admin_login_cover" class="col-form-label text-lg-end col-lg-2 col-xl-3">Admin Login Cover</label>
    <div class="col-lg-10 col-xl-9">
        <div class="mb-3">
            <input class="form-control{{ $errors->has('admin_login_cover') ? ' is-invalid' : '' }}" type="file"
                name="admin_login_cover" id="admin_login_cover" class="">
        </div>

        @if (isset($globalSetting->admin_login_cover) && !empty($globalSetting->admin_login_cover))
        <div class="input-group mb-3">
            <div class="form-check">
                <input type="checkbox" name="custom_delete_admin_login_cover" id="custom_delete_admin_login_cover"
                    class="form-check-input custom-delete-file" value="1" {{ old('custom_delete_admin_login_cover', '0'
                    )=='1' ? 'checked' : '' }}>
            </div>
            <label class="form-check-label" for="custom_delete_admin_login_cover"> Delete {{
                $globalSetting->admin_login_cover
                }}</label>
        </div>

        @endif

        {!! $errors->first('admin_login_cover', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>


<div class="mb-3 row">
    <label for="site_admin_prefix" class="col-form-label text-lg-end col-lg-2 col-xl-3">Site Admin Prefix</label>
    <div class="col-lg-10 col-xl-9">
        <input class="form-control{{ $errors->has('site_admin_prefix') ? ' is-invalid' : '' }}" name="site_admin_prefix"
            type="text" id="site_admin_prefix"
            value="{{ old('site_admin_prefix', optional($globalSetting)->site_admin_prefix) }}" minlength="1"
            placeholder="Enter site admin prefix here...">
        {!! $errors->first('site_admin_prefix', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="mb-3 row">
    <label for="site_currency_type" class="col-form-label text-lg-end col-lg-2 col-xl-3">Site Currency Type</label>
    <div class="col-lg-10 col-xl-9">
        <select class="form-control form-select{{ $errors->has('site_currency_type') ? ' is-invalid' : '' }}"
            id="site_currency_type" name="site_currency_type">
            <option value="" style="display: none;" {{ old('site_currency_type', optional($globalSetting)->
                site_currency_type ?: '') == '' ? 'selected' : '' }} disabled selected>Select site currency</option>
            @foreach ($site_currency_types as $key => $text)
            <option value="{{ $key }}" {{ old('site_currency_type', optional($globalSetting)->site_currency_type) ==
                $key ? 'selected' : '' }}>
                {{ $text }}
            </option>
            @endforeach
        </select>

        {!! $errors->first('site_currency_type', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>
<div class="mb-3 row">
    <label for="site_currency" class="col-form-label text-lg-end col-lg-2 col-xl-3">Site Currency</label>
    <div class="col-lg-10 col-xl-9">
        <select class="form-control form-select{{ $errors->has('site_currency') ? ' is-invalid' : '' }}"
            id="site_currency" name="site_currency">
            <option value="" disabled selected>Select site currency</option>
            @foreach ($currencies as $currency)
            <option value="{{ $currency['currency'] }}" {{ old('site_currency', optional($globalSetting)->site_currency)
                == $currency['currency'] ? 'selected' : '' }}>
                {{ $currency['currency_name'] }} ({{ $currency['currency'] }})
            </option>
            @endforeach
        </select>
        {!! $errors->first('site_currency', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>
<div class="mb-4 col-md-6">
    <label for="language" class="form-label">Language</label>
    <select id="language" class="select2 form-select">
        <option value="">Select Language</option>
        <option value="en">English</option>
        <option value="fr">French</option>
        <option value="de">German</option>
        <option value="pt">Portuguese</option>
    </select>
</div>
<div class="mb-3 row form-group">
    <label for="timezon" class="col-form-label text-lg-end col-lg-2 col-xl-3">Timezon</label>
    <div class="col-lg-10 col-xl-9">
        <select class="select2 form-control form-select{{ $errors->has('timezon') ? ' is-invalid' : '' }}" id="timezon"
            name="timezon">
            <option value="" style="display: none;" {{ old('timezon', optional($globalSetting)->timezon ?: '') == '' ?
                'selected' : '' }} disabled selected>Select timezone</option>
            @foreach ($timezones as $timezone)
            <option value="{{ $timezone['utc'][0] }}" {{ old('timezon', optional($globalSetting)->timezon) ==
                $timezone['utc'][0]
                ? 'selected' : ''
                }}>
                {{ $timezone['value'] }} ({{ $timezone['utc'][0] }})
            </option>
            @endforeach
        </select>

        {!! $errors->first('timezon', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="mb-3 row">
    <label for="referral_type" class="col-form-label text-lg-end col-lg-2 col-xl-3">Referral type</label>
    <div class="col-lg-10 col-xl-9">
        <select class="form-control form-select{{ $errors->has('referral_type') ? ' is-invalid' : '' }}"
            id="referral_type" name="referral_type">
            <option value="" style="display: none;" {{ old('referral_type', optional($globalSetting)->referral_type ?:
                '') == '' ? 'selected' : '' }} disabled selected>Referral type</option>
            @foreach ($referral_types as $key => $text)
            <option value="{{ $key }}" {{ old('referral_type', optional($globalSetting)->referral_type) == $key ?
                'selected' : '' }}>
                {{ $text }}
            </option>
            @endforeach
        </select>

        {!! $errors->first('referral_type', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="mb-3 row">
    <label for="currency_symbol" class="col-form-label text-lg-end col-lg-2 col-xl-3">Currency Symbol</label>
    <div class="col-lg-10 col-xl-9">
        <input class="form-control{{ $errors->has('currency_symbol') ? ' is-invalid' : '' }}" name="currency_symbol"
            type="text" id="currency_symbol"
            value="{{ old('currency_symbol', optional($globalSetting)->currency_symbol) }}"
            placeholder="Currency Symbol">
        {!! $errors->first('currency_symbol', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="mb-3 row">
    <label for="referral_code_Limit" class="col-form-label text-lg-end col-lg-2 col-xl-3">Referral Code Limit</label>
    <div class="col-lg-10 col-xl-9">
        <input class="form-control{{ $errors->has('referral_code_Limit') ? ' is-invalid' : '' }}"
            name="referral_code_Limit" type="text" id="referral_code_Limit"
            value="{{ old('referral_code_Limit', optional($globalSetting)->referral_code_Limit) }}"
            placeholder="Referral Code Limit">
        {!! $errors->first('referral_code_Limit', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="mb-3 row">
    <label for="home_redirect" class="col-form-label text-lg-end col-lg-2 col-xl-3">Home Redirect</label>
    <div class="col-lg-10 col-xl-9">
        <select class="form-control form-select{{ $errors->has('home_redirect') ? ' is-invalid' : '' }}"
            id="home_redirect" name="home_redirect">
            <option value="" style="display: none;" {{ old('home_redirect', optional($globalSetting)->home_redirect ?:
                '') == '' ? 'selected' : '' }} disabled selected>Home Redirect</option>
            @foreach ($home_redirects as $key => $text)
            <option value="{{ $key }}" {{ old('home_redirect', optional($globalSetting)->home_redirect) == $key ?
                'selected' : '' }}>
                {{ $text }}
            </option>
            @endforeach
        </select>

        {!! $errors->first('home_redirect', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="mb-3 row">
    <label for="site_title" class="col-form-label text-lg-end col-lg-2 col-xl-3">Site Title</label>
    <div class="col-lg-10 col-xl-9">
        <input class="form-control{{ $errors->has('site_title') ? ' is-invalid' : '' }}" name="site_title" type="text"
            id="site_title" value="{{ old('site_title', optional($globalSetting)->site_title) }}"
            placeholder="Site Title">
        {!! $errors->first('site_title', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="mb-3 row">
    <label for="site_email" class="col-form-label text-lg-end col-lg-2 col-xl-3">Site Email</label>
    <div class="col-lg-10 col-xl-9">
        <input class="form-control{{ $errors->has('site_email') ? ' is-invalid' : '' }}" name="site_email" type="text"
            id="site_email" value="{{ old('site_email', optional($globalSetting)->site_email) }}"
            placeholder="Site Email">
        {!! $errors->first('site_email', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="mb-3 row">
    <label for="support_email" class="col-form-label text-lg-end col-lg-2 col-xl-3">Support Email</label>
    <div class="col-lg-10 col-xl-9">
        <input class="form-control{{ $errors->has('support_email') ? ' is-invalid' : '' }}" name="support_email"
            type="text" id="support_email" value="{{ old('support_email', optional($globalSetting)->support_email) }}"
            placeholder="Support Email">
        {!! $errors->first('support_email', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>