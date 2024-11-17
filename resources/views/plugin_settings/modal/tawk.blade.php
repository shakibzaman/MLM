<div class="modal-body">
    <h3>Update Tawk Chat</h3>
    <form method="POST" class="needs-validation" novalidate
        action="{{ route('plugin_settings.plugin_setting.update', $pluginSetting->id) }}" id="edit_plugin_setting_form"
        name="edit_plugin_setting_form" accept-charset="UTF-8">
        @csrf
        <input name="_method" type="hidden" value="PUT">
        <div class="mb-3 row">
            <label for="tawk_property_id" class="col-form-label text-lg-end col-lg-2 col-xl-3">Tawk Property</label>
            <div class="col-lg-10 col-xl-9">
                <input class="form-control{{ $errors->has('tawk_property_id') ? ' is-invalid' : '' }}"
                    name="tawk_property_id" type="text" id="tawk_property_id"
                    value="{{ old('tawk_property_id', optional($pluginSetting)->tawk_property_id) }}" minlength="1"
                    placeholder="Enter tawk_property_id here...">
                {!! $errors->first('tawk_property_id', '<div class="invalid-feedback">:message</div>') !!}
            </div>
        </div>
        <div class="mb-3 row">
            <label for="tawk_widget_id" class="col-form-label text-lg-end col-lg-2 col-xl-3">Google Recaptcha
                Secret</label>
            <div class="col-lg-10 col-xl-9">
                <input class="form-control{{ $errors->has('tawk_widget_id') ? ' is-invalid' : '' }}"
                    name="tawk_widget_id" type="text" id="tawk_widget_id"
                    value="{{ old('tawk_widget_id', optional($pluginSetting)->tawk_widget_id) }}" minlength="1"
                    placeholder="Enter google recaptcha secret here...">
                {!! $errors->first('tawk_widget_id', '<div class="invalid-feedback">:message</div>') !!}
            </div>
        </div>
        <div class="mb-3 row">
            <label for="status" class="col-form-label text-lg-end col-lg-2 col-xl-3">Status</label>
            <div class="col-lg-10 col-xl-9">
                <select class="form-select{{ $errors->has('status') ? ' is-invalid' : '' }}" id="status" name="status">
                    <option value="" style="display: none;" {{ old('status', optional($pluginSetting)->status ?: '') ==
                        '' ? 'selected' : '' }} disabled selected>Enter status here...</option>
                    @foreach (['active' => '1',
                    'inactive' => '0'] as $key => $text)
                    <option value="{{ $text }}" {{ old('status', optional($pluginSetting)->status) == $text ? 'selected'
                        :
                        '' }}>
                        {{ $key }}
                    </option>
                    @endforeach
                </select>

                {!! $errors->first('status', '<div class="invalid-feedback">:message</div>') !!}
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
    </form>
</div>