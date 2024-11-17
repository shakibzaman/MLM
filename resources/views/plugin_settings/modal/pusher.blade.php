<div class="modal-body">
    <h3>Update Pusher</h3>
    <form method="POST" class="needs-validation" novalidate
        action="{{ route('plugin_settings.plugin_setting.update', $pluginSetting->id) }}" id="edit_plugin_setting_form"
        name="edit_plugin_setting_form" accept-charset="UTF-8">
        @csrf
        <input name="_method" type="hidden" value="PUT">
        <div class="mb-3 row">
            <label for="pusher_app_id" class="col-form-label text-lg-end col-lg-2 col-xl-3">Pusher App Id</label>
            <div class="col-lg-10 col-xl-9">
                <input class="form-control{{ $errors->has('pusher_app_id') ? ' is-invalid' : '' }}" name="pusher_app_id"
                    type="text" id="pusher_app_id"
                    value="{{ old('pusher_app_id', optional($pluginSetting)->pusher_app_id) }}" minlength="1"
                    placeholder="Enter pusher_app_id here...">
                {!! $errors->first('pusher_app_id', '<div class="invalid-feedback">:message</div>') !!}
            </div>
        </div>
        <div class="mb-3 row">
            <label for="pusher_app_key" class="col-form-label text-lg-end col-lg-2 col-xl-3">Pusher App Key</label>
            <div class="col-lg-10 col-xl-9">
                <input class="form-control{{ $errors->has('pusher_app_key') ? ' is-invalid' : '' }}"
                    name="pusher_app_key" type="text" id="pusher_app_key"
                    value="{{ old('pusher_app_key', optional($pluginSetting)->pusher_app_key) }}" minlength="1"
                    placeholder="Enter pusher app key here...">
                {!! $errors->first('pusher_app_key', '<div class="invalid-feedback">:message</div>') !!}
            </div>
        </div>

        <div class="mb-3 row">
            <label for="pusher_secret" class="col-form-label text-lg-end col-lg-2 col-xl-3">Pusher Secret</label>
            <div class="col-lg-10 col-xl-9">
                <input class="form-control{{ $errors->has('pusher_secret') ? ' is-invalid' : '' }}" name="pusher_secret"
                    type="text" id="pusher_secret"
                    value="{{ old('pusher_secret', optional($pluginSetting)->pusher_secret) }}" minlength="1"
                    placeholder="Enter pusher secret here...">
                {!! $errors->first('pusher_secret', '<div class="invalid-feedback">:message</div>') !!}
            </div>
        </div>

        <div class="mb-3 row">
            <label for="pusher_cluster" class="col-form-label text-lg-end col-lg-2 col-xl-3">Pusher Cluster</label>
            <div class="col-lg-10 col-xl-9">
                <input class="form-control{{ $errors->has('pusher_cluster') ? ' is-invalid' : '' }}"
                    name="pusher_cluster" type="text" id="pusher_cluster"
                    value="{{ old('pusher_cluster', optional($pluginSetting)->pusher_cluster) }}" minlength="1"
                    placeholder="Enter pusher cluster here...">
                {!! $errors->first('pusher_cluster', '<div class="invalid-feedback">:message</div>') !!}
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