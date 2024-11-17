<div class="mb-3 row">
    <label for="google_analytics" class="col-form-label text-lg-end col-lg-2 col-xl-3">Google Analytics Code</label>
    <div class="col-lg-10 col-xl-9">
        <textarea class="form-control{{ $errors->has('google_analytics') ? ' is-invalid' : '' }}"
            name="google_analytics" id="google_analytics"
            placeholder="Enter google analytics here...">{{ old('google_analytics', optional($seoTool)->google_analytics) }}</textarea>
        {!! $errors->first('google_analytics', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="mb-3 row">
    <label for="meta_tags" class="col-form-label text-lg-end col-lg-2 col-xl-3">Meta Tags</label>
    <div class="col-lg-10 col-xl-9">
        <textarea class="form-control{{ $errors->has('meta_tags') ? ' is-invalid' : '' }}" name="meta_tags"
            id="meta_tags" minlength="1"
            placeholder="Enter meta tags here...">{{ old('meta_tags', optional($seoTool)->meta_tags) }}</textarea>
        {!! $errors->first('meta_tags', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>