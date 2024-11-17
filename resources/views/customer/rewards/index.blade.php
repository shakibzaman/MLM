@extends('layouts/layoutMaster')

@section('title', 'Fund Transfer')
<!-- Vendor Styles -->

<!-- Vendor Styles -->
@section('vendor-style')
@vite([
'resources/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.scss',
'resources/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.scss',
'resources/assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.scss',
'resources/assets/vendor/libs/@form-validation/form-validation.scss',
'resources/assets/vendor/libs/select2/select2.scss'
])
@endsection

@section('vendor-script')
@vite([
'resources/assets/vendor/libs/moment/moment.js',
'resources/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js',
'resources/assets/vendor/libs/select2/select2.js',
'resources/assets/vendor/libs/@form-validation/popular.js',
'resources/assets/vendor/libs/@form-validation/bootstrap5.js',
'resources/assets/vendor/libs/@form-validation/auto-focus.js',
'resources/assets/vendor/libs/cleavejs/cleave.js',
'resources/assets/vendor/libs/cleavejs/cleave-phone.js'
])
@endsection

<script>
    document.getElementById('review_from').addEventListener('change', function() {
        var selectedValue = this.value;
        var dropArea = document.getElementById('drop_area');

        // Show/hide the image upload area based on the dropdown value
        if (selectedValue === 'none' || selectedValue === '') {
            dropArea.style.display = 'none'; // Hide the drop area
        } else {
            dropArea.style.display = 'block'; // Show the drop area
        }
    });

    var dropArea = document.getElementById('drop_area');
    var fileInput = document.getElementById('image_upload');
    var preview = document.getElementById('preview');

    // Drag and Drop Events
    dropArea.addEventListener('dragover', function(e) {
        e.preventDefault();
        dropArea.style.border = '2px solid #000'; // Highlight border on drag
    });

    dropArea.addEventListener('dragleave', function(e) {
        e.preventDefault();
        dropArea.style.border = '2px dashed #ccc'; // Revert border after drag leaves
    });

    dropArea.addEventListener('drop', function(e) {
        e.preventDefault();
        dropArea.style.border = '2px dashed #ccc'; // Reset border after drop

        var files = e.dataTransfer.files;
        handleFiles(files); // Handle dropped files
    });

    // Click to open file input
    dropArea.addEventListener('click', function() {
        fileInput.click(); // Open file dialog when clicking drop area
    });

    // Handle file input change
    fileInput.addEventListener('change', function() {
        handleFiles(this.files); // Handle selected files
    });

    // Function to handle file display and preview
    function handleFiles(files) {
        if (files.length > 0) {
            var file = files[0];
            if (file.type.startsWith('image/')) {
                previewFile(file);
            } else {
                alert('Please upload an image file.');
            }
        }
    }

    // Function to preview the image
    function previewFile(file) {
        var reader = new FileReader();
        reader.onload = function(e) {
            var img = document.createElement('img');
            img.src = e.target.result;
            img.style.maxWidth = '100%';
            img.style.height = 'auto';
            preview.innerHTML = ''; // Clear previous preview
            preview.appendChild(img); // Append new image
        }
        reader.readAsDataURL(file); // Read the file as a data URL for preview
    }
</script>
@section('content')

@if(Session::has('error'))
<div class="alert alert-danger alert-dismissible" role="alert">
    {!! session('error') !!}

    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<div class="card text-bg-theme">

</div>
<div class="row">
    <div class="col-md-12">
        <h4 class="text-center card text-success">Total Point: {{ $customer->reward_point }}</h4>
    </div>
    <div class="col-md-6">
        <div class="card-title">
            <h4 class="m-0">Earn credits by reviewing</h4>
        </div>
        <div class="card mt-2 p-2">

            <h3>How it works</h3>
            <ul>
                <li>Write a positive review about your experience with FeelingSurf on one of the following sites.</li>
                <li>Take a screenshot of your review and upload it below.</li>
                <li>For each review, we will add 2,000 credits to your account.</li>
            </ul>
            <h4>Available sites</h4>
            <ul>
                @foreach($sites as $site)
                <li>
                    <a href="{{ $site->url }}">{{ $site->name }} <i class="fas fa-external-link-alt"></i></a>
                </li>
                @endforeach
            </ul>

        </div>
        <div class="card mt-2 p-2">
            <h4>
                Upload a screenshot
            </h4>
            <form action="{{ route('user.extra.rewards.store') }}" enctype="multipart/form-data" method="POST">
                @csrf
                <div class="form-group">
                    <label for="review_from">Review from:</label>
                    <select id="review_from" name="review_from" class="form-control">
                        <option value="">Select a Review From</option>
                        @foreach($rewardMappingsites as $reward)
                        <option value="{{ $reward->id }}"> {{ $reward->rewardSite->name }}- {{
                            $reward->rewardSubmitType->name }}</option>
                        @endforeach
                    </select>
                </div>
                <!-- Image Uploader (Drag & Drop + File Input) -->
                <div id="drop_area" class="form-group mt-3 p-3"
                    style="border: 2px dashed #ccc; text-align: center; display:none;">
                    <label for="image_upload" id="image_label">Drag & Drop your image here or click to upload</label>
                    <input type="file" id="image_upload" name="image_upload" class="form-control" style="display:none;"
                        accept="image/*" required>
                    <div id="preview" class="mt-3"></div>
                </div>

                <!-- Store URL Input Field -->
                <div id="store_url_field" class="form-group mt-3" style="display:none;">
                    <label for="store_url">Paste URL:</label>
                    <input type="text" id="store_url" name="url" class="form-control" placeholder="Enter store URL"
                        required>
                </div>
                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary mt-3" id="submitBtn" disabled>Submit</button>
            </form>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card-title">
            <h4 class="m-0">Your reviews</h4>
        </div>
        <div class="card">
            @php
            $statusLabels = array_flip(config('app.statuses'));
            @endphp
            <table class="table">
                <thead>
                    <tr>
                        <th>Review From</th>
                        <th>Status</th>
                        <th>Reward Point</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($extraRewards as $reward )
                    <tr>
                        <td>{{ $reward->reward_mapping->rewardSite->name }} - {{
                            $reward->reward_mapping->rewardSubmitType->name }}</td>
                        <td>
                            <span
                                class="{{ $reward->status==1 ? 'bg-info' : ($reward->status==2 ? 'bg-success' : 'bg-danger') }} p-2 text-white badge">
                                {{ strtoupper($statusLabels[$reward->status] ?? 'N/A') }}
                            </span>
                        </td>
                        <td>{{ $reward->reward_mapping->reward_amount }}</td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>

<script>
    document.getElementById('review_from').addEventListener('change', function() {
        var selectedValue = this.value;
        var dropArea = document.getElementById('drop_area');
        var storeUrlField = document.getElementById('store_url_field');

        // Show/hide the image upload area and store URL field based on the dropdown value
        if (selectedValue === 'none' || selectedValue === '') {
            dropArea.style.display = 'none';  // Hide the drop area
            storeUrlField.style.display = 'none';  // Hide the store URL input
        } else {
            dropArea.style.display = 'block'; // Show the drop area
            storeUrlField.style.display = 'block'; // Show the store URL input
        }

        checkFormValidity();
    });

    var dropArea = document.getElementById('drop_area');
    var fileInput = document.getElementById('image_upload');
    var preview = document.getElementById('preview');
    var submitBtn = document.getElementById('submitBtn');
    var storeUrlInput = document.getElementById('store_url');

    // Drag and Drop Events
    dropArea.addEventListener('dragover', function(e) {
        e.preventDefault();
        dropArea.style.border = '2px solid #000'; // Highlight border on drag
    });

    dropArea.addEventListener('dragleave', function(e) {
        e.preventDefault();
        dropArea.style.border = '2px dashed #ccc'; // Revert border after drag leaves
    });

    dropArea.addEventListener('drop', function(e) {
        e.preventDefault();
        dropArea.style.border = '2px dashed #ccc'; // Reset border after drop

        var files = e.dataTransfer.files;
        handleFiles(files); // Handle dropped files
    });

    // Click to open file input
    dropArea.addEventListener('click', function() {
        fileInput.click(); // Open file dialog when clicking drop area
    });

    // Handle file input change
    fileInput.addEventListener('change', function() {
        handleFiles(this.files); // Handle selected files
    });

    // Function to handle file display and preview
    function handleFiles(files) {
        if (files.length > 0) {
            var file = files[0];
            if (file.type.startsWith('image/')) {
                previewFile(file);
            } else {
                alert('Please upload an image file.');
            }
        }
        checkFormValidity(); // Check if the form is valid after file upload
    }

    // Function to preview the image
    function previewFile(file) {
        var reader = new FileReader();
        reader.onload = function(e) {
            var img = document.createElement('img');
            img.src = e.target.result;
            img.style.maxWidth = '100%';
            img.style.height = 'auto';
            preview.innerHTML = ''; // Clear previous preview
            preview.appendChild(img); // Append new image
        }
        reader.readAsDataURL(file); // Read the file as a data URL for preview
    }

    // Function to check if both the image and store URL are filled
    function checkFormValidity() {
        var imageUploaded = fileInput.files.length > 0;
        var storeUrlFilled = storeUrlInput.value.trim() !== '';

        if (imageUploaded && storeUrlFilled) {
            submitBtn.disabled = false; // Enable the submit button
        } else {
            submitBtn.disabled = true; // Disable the submit button
        }
    }

    // Event listener to check the form validity on URL input change
    storeUrlInput.addEventListener('input', checkFormValidity);
</script>

@endsection