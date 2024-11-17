<div class="row">
    <div class="col-md-4">
        <div class="card p-2">
            <div class="mb-3 row">
                <label for="name" class="col-form-label text-lg-end col-lg-2 col-xl-3">Name</label>
                <div class="col-lg-10 col-xl-9">
                    <input class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" type="text"
                        id="name" value="{{ old('name', optional($companySetting)->name) }}" minlength="1"
                        maxlength="255" placeholder="Enter name here...">
                    {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>

            <div class="mb-3 row">
                <label for="contact_person" class="col-form-label text-lg-end col-lg-2 col-xl-3">Contact Person</label>
                <div class="col-lg-10 col-xl-9">
                    <input class="form-control{{ $errors->has('contact_person') ? ' is-invalid' : '' }}"
                        name="contact_person" type="text" id="contact_person"
                        value="{{ old('contact_person', optional($companySetting)->contact_person) }}" minlength="1"
                        placeholder="Enter contact person here...">
                    {!! $errors->first('contact_person', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>

            <div class="mb-3 row">
                <label for="referral_link_identifier" class="col-form-label text-lg-end col-lg-2 col-xl-3">Referral
                    Link</label>
                <div class="col-lg-10 col-xl-9">
                    <input class="form-control{{ $errors->has('referral_link_identifier') ? ' is-invalid' : '' }}"
                        name="referral_link_identifier" type="text" id="referral_link_identifier"
                        value="{{ old('referral_link_identifier', optional($companySetting)->referral_link_identifier) }}"
                        minlength="1" placeholder="Enter referral link here...">
                    {!! $errors->first('referral_link_identifier', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>

            <div class="mb-3 row">
                <label for="seo_title" class="col-form-label text-lg-end col-lg-2 col-xl-3">Seo Title</label>
                <div class="col-lg-10 col-xl-9">
                    <input class="form-control{{ $errors->has('seo_title') ? ' is-invalid' : '' }}" name="seo_title"
                        type="text" id="seo_title" value="{{ old('seo_title', optional($companySetting)->seo_title) }}"
                        minlength="1" placeholder="Enter seo title here...">
                    {!! $errors->first('seo_title', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>

            <div class="mb-3 row">
                <label for="legal_name" class="col-form-label text-lg-end col-lg-2 col-xl-3">Legal Name</label>
                <div class="col-lg-10 col-xl-9">
                    <input class="form-control{{ $errors->has('legal_name') ? ' is-invalid' : '' }}" name="legal_name"
                        type="text" id="legal_name"
                        value="{{ old('legal_name', optional($companySetting)->legal_name) }}" minlength="1"
                        placeholder="Enter legal name here...">
                    {!! $errors->first('legal_name', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>

            <div class="mb-3 row">
                <label for="google_secret_key" class="col-form-label text-lg-end col-lg-2 col-xl-3">Google Secret
                    Key</label>
                <div class="col-lg-10 col-xl-9">
                    <input class="form-control{{ $errors->has('google_secret_key') ? ' is-invalid' : '' }}"
                        name="google_secret_key" type="text" id="google_secret_key"
                        value="{{ old('google_secret_key', optional($companySetting)->google_secret_key) }}"
                        minlength="1" placeholder="Enter google secret key here...">
                    {!! $errors->first('google_secret_key', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="mb-3 row">
                <label for="address" class="col-form-label text-lg-end col-lg-2 col-xl-3">Address</label>
                <div class="col-lg-10 col-xl-9">
                    <input class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" name="address"
                        type="text" id="address" value="{{ old('address', optional($companySetting)->address) }}"
                        minlength="1" placeholder="Enter address here...">
                    {!! $errors->first('address', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>

            {{-- <div class="mb-3 row">
                <label for="captcha_at_register" class="col-form-label text-lg-end col-lg-2 col-xl-3">Captcha At
                    Register</label>
                <div class="col-lg-10 col-xl-9">
                    <div class="form-check checkbox">
                        <input id="captcha_at_register_1" class="form-check-inputrequired" name="captcha_at_register[]"
                            type="checkbox" value="1" {{ in_array('1', old('captcha_at_register',
                            optional($companySetting)->captcha_at_register) ?: []) ? 'checked' : '' }}>
                        <label class="form-check-label" for="captcha_at_register_1">
                            Enable Captcha
                        </label>
                    </div>

                    <div class="form-check checkbox">
                        <input id="captcha_at_register_0" class="form-check-inputrequired" name="captcha_at_register[]"
                            type="checkbox" value="0" {{ in_array('0', old('captcha_at_register',
                            optional($companySetting)->captcha_at_register) ?: []) ? 'checked' : '' }}>
                        <label class="form-check-label" for="captcha_at_register_0">
                            Disable Captcha
                        </label>
                    </div>


                    {!! $errors->first('captcha_at_register', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div> --}}

            <div class="mb-3 row">
                <label for="captcha_at_register" class="col-form-label text-lg-end col-lg-2 col-xl-3">Captcha At
                    Register</label>
                <div class="col-lg-10 col-xl-9">
                    <div class="form-check checkbox">
                        <input id="captcha_at_register" class="form-check-input" name="captcha_at_register"
                            type="checkbox" value="1" {{ old('captcha_at_register',
                            optional($companySetting)->captcha_at_register) == '1' ? 'checked' : '' }}>
                        <label class="form-check-label" for="captcha_at_register">
                            Enable Captcha
                        </label>
                    </div>

                    {!! $errors->first('captcha_at_register', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>

        </div>
    </div>
    <div class="col-md-4">
        <div class="card p-2">

            <div class="mb-3 row">
                <label for="zip_code" class="col-form-label text-lg-end col-lg-2 col-xl-3">Zip Code</label>
                <div class="col-lg-10 col-xl-9">
                    <input class="form-control{{ $errors->has('zip_code') ? ' is-invalid' : '' }}" name="zip_code"
                        type="text" id="zip_code" value="{{ old('zip_code', optional($companySetting)->zip_code) }}"
                        minlength="1" placeholder="Enter zip code here...">
                    {!! $errors->first('zip_code', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>

            <div class="mb-3 row">
                <label for="company_start_on" class="col-form-label text-lg-end col-lg-2 col-xl-3">Company Start
                    On</label>
                <div class="col-lg-10 col-xl-9">
                    <input class="form-control{{ $errors->has('company_start_on') ? ' is-invalid' : '' }}"
                        name="company_start_on" type="text" id="company_start_on"
                        value="{{ old('company_start_on', optional($companySetting)->company_start_on) }}" minlength="1"
                        placeholder="Enter company start on here...">
                    {!! $errors->first('company_start_on', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>

            <div class="mb-3 row">
                <label for="country" class="col-form-label text-lg-end col-lg-2 col-xl-3">Country</label>
                <div class="col-lg-10 col-xl-9">
                    <input class="form-control{{ $errors->has('country') ? ' is-invalid' : '' }}" name="country"
                        type="number" id="country" value="{{ old('country', optional($companySetting)->country) }}"
                        placeholder="Enter country here...">
                    {!! $errors->first('country', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>

            <div class="mb-3 row">
                <label for="city" class="col-form-label text-lg-end col-lg-2 col-xl-3">City</label>
                <div class="col-lg-10 col-xl-9">
                    <input class="form-control{{ $errors->has('city') ? ' is-invalid' : '' }}" name="city" type="text"
                        id="city" value="{{ old('city', optional($companySetting)->city) }}" minlength="1"
                        placeholder="Enter city here...">
                    {!! $errors->first('city', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>

            <div class="mb-3 row">
                <label for="phone" class="col-form-label text-lg-end col-lg-2 col-xl-3">Phone</label>
                <div class="col-lg-10 col-xl-9">
                    <input class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" type="text"
                        id="phone" value="{{ old('phone', optional($companySetting)->phone) }}" minlength="1"
                        placeholder="Enter phone here...">
                    {!! $errors->first('phone', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>

            <div class="mb-3 row">
                <label for="email" class="col-form-label text-lg-end col-lg-2 col-xl-3">Email</label>
                <div class="col-lg-10 col-xl-9">
                    <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email"
                        type="email" id="email" value="{{ old('email', optional($companySetting)->email) }}"
                        placeholder="Enter email here...">
                    {!! $errors->first('email', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>

            <div class="mb-3 row">
                <label for="website" class="col-form-label text-lg-end col-lg-2 col-xl-3">Website</label>
                <div class="col-lg-10 col-xl-9">
                    <input class="form-control{{ $errors->has('website') ? ' is-invalid' : '' }}" name="website"
                        type="text" id="website" value="{{ old('website', optional($companySetting)->website) }}"
                        placeholder="Enter Website here...">
                    {!! $errors->first('website', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="mb-3 row">
                <label for="captcha_at_client_registration" class="col-form-label text-lg-end col-lg-2 col-xl-3">Captcha
                    At Client Registration</label>
                <div class="col-lg-10 col-xl-9">
                    <div class="form-check checkbox">
                        <input id="captcha_at_client_registration" class="form-check-input"
                            name="captcha_at_client_registration" type="checkbox" value="1" {{
                            old('captcha_at_client_registration',
                            optional($companySetting)->captcha_at_client_registration) == '1' ? 'checked' : '' }}>
                        <label class="form-check-label" for="captcha_at_client_registration">
                            Enable Captcha
                        </label>
                    </div>

                    {!! $errors->first('captcha_at_client_registration', '<div class="invalid-feedback">:message</div>')
                    !!}
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card p-2">

            <div class="mb-3 row">
                <label for="meta_description" class="col-form-label text-lg-end col-lg-2 col-xl-3">Meta
                    Description</label>
                <div class="col-lg-10 col-xl-9">
                    <input class="form-control{{ $errors->has('meta_description') ? ' is-invalid' : '' }}"
                        name="meta_description" type="text" id="meta_description"
                        value="{{ old('meta_description', optional($companySetting)->meta_description) }}"
                        placeholder="Enter Meta Description here...">
                    {!! $errors->first('meta_description', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>

            <div class="mb-3 row">
                <label for="google_analytic_key" class="col-form-label text-lg-end col-lg-2 col-xl-3">Google Analytics
                    Key</label>
                <div class="col-lg-10 col-xl-9">
                    <input class="form-control{{ $errors->has('google_analytic_key') ? ' is-invalid' : '' }}"
                        name="google_analytic_key" type="text" id="google_analytic_key"
                        value="{{ old('google_analytic_key', optional($companySetting)->google_analytic_key) }}"
                        placeholder="Enter Google Analytics Key here...">
                    {!! $errors->first('google_analytic_key', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="mb-3 row">
                <label for="tagline" class="col-form-label text-lg-end col-lg-2 col-xl-3">Company tagline</label>
                <div class="col-lg-10 col-xl-9">
                    <input class="form-control{{ $errors->has('tagline') ? ' is-invalid' : '' }}" name="tagline"
                        type="text" id="tagline" value="{{ old('tagline', optional($companySetting)->tagline) }}"
                        placeholder="Enter Company tagline here...">
                    {!! $errors->first('tagline', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>

            <div class="mb-3 row">
                <label for="google_site_key" class="col-form-label text-lg-end col-lg-2 col-xl-3">Google Site
                    Key</label>
                <div class="col-lg-10 col-xl-9">
                    <input class="form-control{{ $errors->has('google_site_key') ? ' is-invalid' : '' }}"
                        name="google_site_key" type="text" id="google_site_key"
                        value="{{ old('google_site_key', optional($companySetting)->google_site_key) }}"
                        placeholder="Enter Google Site Key here...">
                    {!! $errors->first('google_site_key', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>

            <div class="mb-3 row">
                <label for="google_webmaster_tool_code" class="col-form-label text-lg-end col-lg-2 col-xl-3">Google
                    webmaster tool
                    code</label>
                <div class="col-lg-10 col-xl-9">
                    <input class="form-control{{ $errors->has('google_webmaster_tool_code') ? ' is-invalid' : '' }}"
                        name="google_webmaster_tool_code" type="text" id="google_webmaster_tool_code"
                        value="{{ old('google_webmaster_tool_code', optional($companySetting)->google_webmaster_tool_code) }}"
                        placeholder="Google webmaster tool code">
                    {!! $errors->first('google_webmaster_tool_code', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>

            {{-- <div class="mb-3 row">
                <label for="captcha_at_admin_login" class="col-form-label text-lg-end col-lg-2 col-xl-3">Captcha at
                    admin
                    login</label>
                <div class="col-lg-10 col-xl-9">
                    <div class="form-check checkbox">
                        <input id="captcha_at_admin_login_1" class="form-check-inputrequired"
                            name="captcha_at_admin_login[]" type="checkbox" value="1" {{ in_array('1',
                            old('captcha_at_admin_login', optional($companySetting)->captcha_at_admin_login) ?: []) ?
                        'checked' : '' }}>
                        <label class="form-check-label" for="captcha_at_admin_login_1">
                            Enable Captcha
                        </label>
                    </div>

                    <div class="form-check checkbox">
                        <input id="captcha_at_admin_login_0" class="form-check-inputrequired"
                            name="captcha_at_admin_login[]" type="checkbox" value="0" {{ in_array('0',
                            old('captcha_at_admin_login', optional($companySetting)->captcha_at_admin_login) ?: []) ?
                        'checked' : '' }}>
                        <label class="form-check-label" for="captcha_at_admin_login_0">
                            Disable Captcha
                        </label>
                    </div>


                    {!! $errors->first('captcha_at_admin_login', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div> --}}

            <div class="mb-3 row">
                <label for="captcha_at_admin_login" class="col-form-label text-lg-end col-lg-2 col-xl-3">Captcha at
                    Admin Login</label>
                <div class="col-lg-10 col-xl-9">
                    <div class="form-check checkbox">
                        <input id="captcha_at_admin_login" class="form-check-input" name="captcha_at_admin_login"
                            type="checkbox" value="1" {{ old('captcha_at_admin_login',
                            optional($companySetting)->captcha_at_admin_login) == '1' ? 'checked' : '' }}>
                        <label class="form-check-label" for="captcha_at_admin_login">
                            Enable Captcha
                        </label>
                    </div>

                    {!! $errors->first('captcha_at_admin_login', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>


            <div class="mb-3 row">
                <label for="we_accept_logo" class="col-form-label text-lg-end col-lg-2 col-xl-3">We Accept Logo</label>
                <div class="col-lg-10 col-xl-9">
                    <div class="mb-3">
                        <input class="form-control{{ $errors->has('we_accept_logo') ? ' is-invalid' : '' }}" type="file"
                            name="we_accept_logo" id="we_accept_logo" class="">
                    </div>

                    @if (isset($companySetting->we_accept_logo) && !empty($companySetting->we_accept_logo))

                    <div class="input-group mb-3">
                        <div class="form-check">
                            <input type="checkbox" name="custom_delete_we_accept_logo" id="custom_delete_we_accept_logo"
                                class="form-check-input custom-delete-file" value="1" {{
                                old('custom_delete_we_accept_logo', '0' )=='1' ? 'checked' : '' }}>
                        </div>
                        <label class="form-check-label" for="custom_delete_we_accept_logo"> Delete {{
                            $companySetting->we_accept_logo }}</label>
                    </div>

                    @endif

                    {!! $errors->first('we_accept_logo', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
        </div>
    </div>
</div>