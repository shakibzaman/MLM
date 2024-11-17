<div class="row mb-4">
    <div class="col-md-4">
        <p>Mail Settings</p>
    </div>
    <div class="col-md-4">
        <div class="mb-3">
            <label for="email_from_name" class="">Email From Name</label>
            <input class="form-control{{ $errors->has('email_from_name') ? ' is-invalid' : '' }}" name="email_from_name"
                type="text" id="email_from_name"
                value="{{ old('email_from_name', optional($mailSetting)->email_from_name) }}"
                placeholder="Enter email from name here...">
            {!! $errors->first('email_from_name', '<div class="invalid-feedback">:message</div>') !!}
        </div>
    </div>
    <div class="col-md-4">
        <div class="mb-3">
            <label for="email_from_address" class="">Email From
                Address</label>
            <input class="form-control{{ $errors->has('email_from_address') ? ' is-invalid' : '' }}"
                name="email_from_address" type="email" id="email_from_address"
                value="{{ old('email_from_address', optional($mailSetting)->email_from_address) }}"
                placeholder="Enter email from address here...">
            {!! $errors->first('email_from_address', '<div class="invalid-feedback">:message</div>') !!}
        </div>
    </div>
</div>

<div class="row mb-4">
    <div class="col-md-4">
        <p>Mailing Driver</p>
    </div>
    {{-- <div class="mb-3">
        <label for="mailing_driver" class="">Mailing Driver</label>

        <input class="form-control{{ $errors->has('mailing_driver') ? ' is-invalid' : '' }}" name="mailing_driver"
            type="text" id="mailing_driver" value="{{ old('mailing_driver', optional($mailSetting)->mailing_driver) }}"
            minlength="1" placeholder="Enter mailing driver here...">
        {!! $errors->first('mailing_driver', '<div class="invalid-feedback">:message</div>') !!}

    </div> --}}

    <div class="mb-3">
        <div class="form-check">
            <input class="form-check-input{{ $errors->has('mailing_driver') ? ' is-invalid' : '' }}" type="radio"
                name="mailing_driver" id="mailing_driver_smtp" value="smtp" {{ old('mailing_driver',
                optional($mailSetting)->mailing_driver ?? 'smtp') == 'smtp' ? 'checked' : '' }}>
            <label class="form-check-label" for="mailing_driver_smtp">SMTP</label>
        </div>
        {!! $errors->first('mailing_driver', '<div class="invalid-feedback">:message</div>') !!}
    </div>


</div>


<div class="row">
    <div class="col-md-4">
        <p>Configuration</p>
    </div>
    <div class="col-md-4">
        <div class="mb-3">
            <label for="mail_user_name" class="">Mail User Name</label>

            <input class="form-control{{ $errors->has('mail_user_name') ? ' is-invalid' : '' }}" name="mail_user_name"
                type="text" id="mail_user_name"
                value="{{ old('mail_user_name', optional($mailSetting)->mail_user_name) }}" minlength="1"
                placeholder="Enter mail user name here...">
            {!! $errors->first('mail_user_name', '<div class="invalid-feedback">:message</div>') !!}

        </div>
        <div class="mb-3">
            <label for="smpt_host" class="">Smpt Host</label>

            <input class="form-control{{ $errors->has('smpt_host') ? ' is-invalid' : '' }}" name="smpt_host" type="text"
                id="smpt_host" value="{{ old('smpt_host', optional($mailSetting)->smpt_host) }}" minlength="1"
                placeholder="Enter smpt host here...">
            {!! $errors->first('smpt_host', '<div class="invalid-feedback">:message</div>') !!}

        </div>
    </div>
    <div class="col-md-4">
        <div class="mb-3">
            <label for="mail_password" class="">Mail password</label>

            <input class="form-control{{ $errors->has('mail_password') ? ' is-invalid' : '' }}" name="mail_password"
                type="password" id="mail_password"
                value="{{ old('mail_password', optional($mailSetting)->mail_password) }}" minlength="1"
                placeholder="Enter Password here...">
            {!! $errors->first('smpt_host', '<div class="invalid-feedback">:message</div>') !!}

        </div>

        <div class="mb-3">
            <label for="smpt_port" class="">Smpt Port</label>

            <input class="form-control{{ $errors->has('smpt_port') ? ' is-invalid' : '' }}" name="smpt_port" type="text"
                id="smpt_port" value="{{ old('smpt_port', optional($mailSetting)->smpt_port) }}" minlength="1"
                placeholder="Enter smpt port here...">
            {!! $errors->first('smpt_port', '<div class="invalid-feedback">:message</div>') !!}

        </div>

        <div class="mb-3">
            <label for="smtp_secure" class="">Smtp Secure</label>

            <input class="form-control{{ $errors->has('smtp_secure') ? ' is-invalid' : '' }}" name="smtp_secure"
                type="text" id="smtp_secure" value="{{ old('smtp_secure', optional($mailSetting)->smtp_secure) }}"
                minlength="1" placeholder="Enter smtp secure here...">
            {!! $errors->first('smtp_secure', '<div class="invalid-feedback">:message</div>') !!}

        </div>
    </div>
</div>