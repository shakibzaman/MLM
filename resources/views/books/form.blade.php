
<div class="mb-3 row">
    <label for="lang" class="col-form-label text-lg-end col-lg-2 col-xl-3">Language</label>
    <div class="col-lg-10 col-xl-9">
        <select name="lang" id="lang" class="form-control {{ $errors->has('lang') ? ' is-invalid' : '' }}" required>
          <option value="">Select</option>
          @foreach ($languages as $key => $language)
            <option {{ old('lang', optional($book)->lang) == $key ? 'selected' : '' }} value="{{ $language }}">{{ ucfirst($language) }}</option>
          @endforeach
        </select>

        {!! $errors->first('lang', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="mb-3 row">
    <label for="file" class="col-form-label text-lg-end col-lg-2 col-xl-3">File</label>
    <div class="col-lg-10 col-xl-9">
        <div class="mb-3">
            <input class="form-control{{ $errors->has('file') ? ' is-invalid' : '' }}" type="file" name="file" id="file" class="" required>
        </div>

        @if (isset($book->file) && !empty($book->file))

        <div class="input-group mb-3">
          <div class="form-check">
            <input type="checkbox" name="custom_delete_file" id="custom_delete_file" class="form-check-input custom-delete-file" value="1" {{ old('custom_delete_file', '0') == '1' ? 'checked' : '' }}>
          </div>
          <label class="form-check-label" for="custom_delete_file"> Delete {{ $book->file }}</label>
        </div>

        @endif

        {!! $errors->first('file', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

