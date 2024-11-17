
<div class="mb-3 row">
    <label for="name" class="col-form-label text-lg-end col-lg-2 col-xl-3">Name</label>
    <div class="col-lg-10 col-xl-9">
        <input class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" type="text" id="name" value="{{ old('name', optional($pluginSetting)->name) }}" minlength="1" maxlength="255" placeholder="Enter name here...">
        {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="mb-3 row">
    <label for="status" class="col-form-label text-lg-end col-lg-2 col-xl-3">Status</label>
    <div class="col-lg-10 col-xl-9">
        <select class="form-select{{ $errors->has('status') ? ' is-invalid' : '' }}" id="status" name="status">
        	    <option value="" style="display: none;" {{ old('status', optional($pluginSetting)->status ?: '') == '' ? 'selected' : '' }} disabled selected>Enter status here...</option>
        	@foreach (['active' => '1',
'inactive' => '0'] as $key => $text)
			    <option value="{{ $key }}" {{ old('status', optional($pluginSetting)->status) == $key ? 'selected' : '' }}>
			    	{{ $text }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('status', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="mb-3 row">
    <label for="tawk_property_id" class="col-form-label text-lg-end col-lg-2 col-xl-3">Tawk Property</label>
    <div class="col-lg-10 col-xl-9">
        <select class="form-select{{ $errors->has('tawk_property_id') ? ' is-invalid' : '' }}" id="tawk_property_id" name="tawk_property_id">
        	    <option value="" style="display: none;" {{ old('tawk_property_id', optional($pluginSetting)->tawk_property_id ?: '') == '' ? 'selected' : '' }} disabled selected>Select tawk property</option>
        	@foreach ($tawkProperties as $key => $tawkProperty)
			    <option value="{{ $key }}" {{ old('tawk_property_id', optional($pluginSetting)->tawk_property_id) == $key ? 'selected' : '' }}>
			    	{{ $tawkProperty }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('tawk_property_id', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="mb-3 row">
    <label for="tawk_widget_id" class="col-form-label text-lg-end col-lg-2 col-xl-3">Tawk Widget</label>
    <div class="col-lg-10 col-xl-9">
        <select class="form-select{{ $errors->has('tawk_widget_id') ? ' is-invalid' : '' }}" id="tawk_widget_id" name="tawk_widget_id">
        	    <option value="" style="display: none;" {{ old('tawk_widget_id', optional($pluginSetting)->tawk_widget_id ?: '') == '' ? 'selected' : '' }} disabled selected>Select tawk widget</option>
        	@foreach ($tawkWidgets as $key => $tawkWidget)
			    <option value="{{ $key }}" {{ old('tawk_widget_id', optional($pluginSetting)->tawk_widget_id) == $key ? 'selected' : '' }}>
			    	{{ $tawkWidget }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('tawk_widget_id', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="mb-3 row">
    <label for="google_recaptcha_key" class="col-form-label text-lg-end col-lg-2 col-xl-3">Google Recaptcha Key</label>
    <div class="col-lg-10 col-xl-9">
        <input class="form-control{{ $errors->has('google_recaptcha_key') ? ' is-invalid' : '' }}" name="google_recaptcha_key" type="text" id="google_recaptcha_key" value="{{ old('google_recaptcha_key', optional($pluginSetting)->google_recaptcha_key) }}" minlength="1" placeholder="Enter google recaptcha key here...">
        {!! $errors->first('google_recaptcha_key', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="mb-3 row">
    <label for="google_recaptcha_secret" class="col-form-label text-lg-end col-lg-2 col-xl-3">Google Recaptcha Secret</label>
    <div class="col-lg-10 col-xl-9">
        <input class="form-control{{ $errors->has('google_recaptcha_secret') ? ' is-invalid' : '' }}" name="google_recaptcha_secret" type="text" id="google_recaptcha_secret" value="{{ old('google_recaptcha_secret', optional($pluginSetting)->google_recaptcha_secret) }}" minlength="1" placeholder="Enter google recaptcha secret here...">
        {!! $errors->first('google_recaptcha_secret', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="mb-3 row">
    <label for="google_analytics_id" class="col-form-label text-lg-end col-lg-2 col-xl-3">Google Analytics</label>
    <div class="col-lg-10 col-xl-9">
        <select class="form-select{{ $errors->has('google_analytics_id') ? ' is-invalid' : '' }}" id="google_analytics_id" name="google_analytics_id">
        	    <option value="" style="display: none;" {{ old('google_analytics_id', optional($pluginSetting)->google_analytics_id ?: '') == '' ? 'selected' : '' }} disabled selected>Select google analytics</option>
        	@foreach ($googleAnalytics as $key => $googleAnalytic)
			    <option value="{{ $key }}" {{ old('google_analytics_id', optional($pluginSetting)->google_analytics_id) == $key ? 'selected' : '' }}>
			    	{{ $googleAnalytic }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('google_analytics_id', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="mb-3 row">
    <label for="fb_page_id" class="col-form-label text-lg-end col-lg-2 col-xl-3">Fb Page</label>
    <div class="col-lg-10 col-xl-9">
        <select class="form-select{{ $errors->has('fb_page_id') ? ' is-invalid' : '' }}" id="fb_page_id" name="fb_page_id">
        	    <option value="" style="display: none;" {{ old('fb_page_id', optional($pluginSetting)->fb_page_id ?: '') == '' ? 'selected' : '' }} disabled selected>Enter fb page here...</option>
        	@foreach ($fbPages as $key => $fbPage)
			    <option value="{{ $key }}" {{ old('fb_page_id', optional($pluginSetting)->fb_page_id) == $key ? 'selected' : '' }}>
			    	{{ $fbPage }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('fb_page_id', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="mb-3 row">
    <label for="pusher_app_id" class="col-form-label text-lg-end col-lg-2 col-xl-3">Pusher App</label>
    <div class="col-lg-10 col-xl-9">
        <select class="form-select{{ $errors->has('pusher_app_id') ? ' is-invalid' : '' }}" id="pusher_app_id" name="pusher_app_id">
        	    <option value="" style="display: none;" {{ old('pusher_app_id', optional($pluginSetting)->pusher_app_id ?: '') == '' ? 'selected' : '' }} disabled selected>Select pusher app</option>
        	@foreach ($pusherApps as $key => $pusherApp)
			    <option value="{{ $key }}" {{ old('pusher_app_id', optional($pluginSetting)->pusher_app_id) == $key ? 'selected' : '' }}>
			    	{{ $pusherApp }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('pusher_app_id', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="mb-3 row">
    <label for="pusher_app_key" class="col-form-label text-lg-end col-lg-2 col-xl-3">Pusher App Key</label>
    <div class="col-lg-10 col-xl-9">
        <input class="form-control{{ $errors->has('pusher_app_key') ? ' is-invalid' : '' }}" name="pusher_app_key" type="text" id="pusher_app_key" value="{{ old('pusher_app_key', optional($pluginSetting)->pusher_app_key) }}" minlength="1" placeholder="Enter pusher app key here...">
        {!! $errors->first('pusher_app_key', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="mb-3 row">
    <label for="pusher_secret" class="col-form-label text-lg-end col-lg-2 col-xl-3">Pusher Secret</label>
    <div class="col-lg-10 col-xl-9">
        <input class="form-control{{ $errors->has('pusher_secret') ? ' is-invalid' : '' }}" name="pusher_secret" type="text" id="pusher_secret" value="{{ old('pusher_secret', optional($pluginSetting)->pusher_secret) }}" minlength="1" placeholder="Enter pusher secret here...">
        {!! $errors->first('pusher_secret', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="mb-3 row">
    <label for="pusher_cluster" class="col-form-label text-lg-end col-lg-2 col-xl-3">Pusher Cluster</label>
    <div class="col-lg-10 col-xl-9">
        <input class="form-control{{ $errors->has('pusher_cluster') ? ' is-invalid' : '' }}" name="pusher_cluster" type="text" id="pusher_cluster" value="{{ old('pusher_cluster', optional($pluginSetting)->pusher_cluster) }}" minlength="1" placeholder="Enter pusher cluster here...">
        {!! $errors->first('pusher_cluster', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

