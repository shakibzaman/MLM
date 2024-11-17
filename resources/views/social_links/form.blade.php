<div class="mb-3 row">
    <label for="name" class="col-form-label text-lg-end col-lg-2 col-xl-3">Name</label>
    <div class="col-lg-10 col-xl-9">
        <input class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" type="text" id="name"
            value="{{ old('name', optional($socialLink)->name) }}" minlength="1" maxlength="255"
            placeholder="Enter name here...">
        {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="mb-3 row">
    <label for="icon" class="col-form-label text-lg-end col-lg-2 col-xl-3">Icon</label>
    <div class="col-lg-10 col-xl-9">
        <div class="input-group">
            <!-- Display the selected icon dynamically -->
            <div class="input-group-text" id="selected-icon">
                <i class="{{ old('icon', optional($socialLink)->icon) ?: 'fab fa-facebook' }}"></i>
            </div>
            <!-- Dropdown for selecting icons -->
            <select class="form-control" name="icon" id="icon">
                <option value="fab fa-facebook" {{ old('icon', optional($socialLink)->icon) == 'fab fa-facebook' ?
                    'selected' : '' }}>
                    Facebook
                </option>
                <option value="fab fa-twitter" {{ old('icon', optional($socialLink)->icon) == 'fab fa-twitter' ?
                    'selected' : '' }}>
                    Twitter
                </option>
                <option value="fab fa-linkedin" {{ old('icon', optional($socialLink)->icon) == 'fab fa-linkedin' ?
                    'selected' : '' }}>
                    LinkedIn
                </option>
                <option value="fab fa-instagram" {{ old('icon', optional($socialLink)->icon) == 'fab fa-instagram' ?
                    'selected' : '' }}>
                    Instagram
                </option>
            </select>
        </div>
        {!! $errors->first('icon', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="mb-3 row">
    <label for="link" class="col-form-label text-lg-end col-lg-2 col-xl-3">Link</label>
    <div class="col-lg-10 col-xl-9">
        <input class="form-control{{ $errors->has('link') ? ' is-invalid' : '' }}" name="link" type="text" id="link"
            value="{{ old('link', optional($socialLink)->link) }}" minlength="1" placeholder="Enter link here...">
        {!! $errors->first('link', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="mb-3 row">
    <label for="status" class="col-form-label text-lg-end col-lg-2 col-xl-3">Status</label>
    <div class="col-lg-10 col-xl-9">
        <select class="form-select{{ $errors->has('status') ? ' is-invalid' : '' }}" id="status" name="status">
            <option value="" style="display: none;" {{ old('status', optional($socialLink)->status ?: '') == '' ?
                'selected' : '' }} disabled selected>Enter status here...</option>
            @foreach (['active' => '1',
            'inactive' => '0'] as $key => $text)
            <option value="{{ $text }}" {{ old('status', optional($socialLink)->status) == $text ? 'selected' : '' }}>
                {{ $key }}
            </option>
            @endforeach
        </select>

        {!! $errors->first('status', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>
<script>
    $(document).ready(function() {
    // Function to update the displayed icon
    function updateIcon() {
        var selectedIcon = $('#icon').val();
        $('#selected-icon i').attr('class', selectedIcon); // Update the class of the <i> tag to change the icon
    }

    // Listen for the change event on the select element
    $('#icon').on('change', function() {
        updateIcon();
    });

    // Trigger the update when the page loads to show the selected icon (in case of edit)
    updateIcon();
});


</script>