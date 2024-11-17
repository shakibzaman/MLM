<div class="modal-body">
    <h3>Update Google Analytics</h3>
    <form method="POST" class="needs-validation" novalidate
        action="{{ route('plugin_settings.plugin_setting.update', $pluginSetting->id) }}" id="edit_plugin_setting_form"
        name="edit_plugin_setting_form" accept-charset="UTF-8">
        @csrf
        <input name="_method" type="hidden" value="PUT">
        <div class="mb-3 row">
            <label for="google_analytics_id" class="col-form-label text-lg-end col-lg-2 col-xl-3">App Id
            </label>
            <div class="col-lg-10 col-xl-9">
                <input class="form-control{{ $errors->has('google_analytics_id') ? ' is-invalid' : '' }}"
                    name="google_analytics_id" type="text" id="google_analytics_id"
                    value="{{ old('google_analytics_id', optional($pluginSetting)->google_analytics_id) }}"
                    minlength="1" placeholder="Enter google_analytics_id here...">
                {!! $errors->first('google_analytics_id', '<div class="invalid-feedback">:message</div>') !!}
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