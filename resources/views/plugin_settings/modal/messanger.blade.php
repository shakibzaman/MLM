<div class="modal-body">
    <h3>Update Facebook Messenger</h3>
    <form method="POST" class="needs-validation" novalidate
        action="{{ route('plugin_settings.plugin_setting.update', $pluginSetting->id) }}" id="edit_plugin_setting_form"
        name="edit_plugin_setting_form" accept-charset="UTF-8">
        @csrf
        <input name="_method" type="hidden" value="PUT">
        <div class="mb-3 row">
            <label for="fb_page_id" class="col-form-label text-lg-end col-lg-2 col-xl-3">Page Id
            </label>
            <div class="col-lg-10 col-xl-9">
                <input class="form-control{{ $errors->has('fb_page_id') ? ' is-invalid' : '' }}"
                    name="fb_page_id" type="text" id="fb_page_id"
                    value="{{ old('fb_page_id', optional($pluginSetting)->fb_page_id) }}"
                    minlength="1" placeholder="Enter fb_page_id here...">
                {!! $errors->first('fb_page_id', '<div class="invalid-feedback">:message</div>') !!}
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