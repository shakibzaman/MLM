@extends('layouts/layoutMaster')

@section('title', 'Fund Transfer')

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

<!-- Vendor Scripts -->
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    function updateConversion(points) {
        // Convert points to dollars (adjust conversion logic dynamically)
        const dollar = points / 10000;

        // Update the displayed values dynamically
        document.getElementById('pointsValue').innerText = points;
        document.getElementById('dollarValue').innerText = dollar.toFixed(2);
    }

    function submitConversion() {
        const points = document.getElementById('pointsValue').innerText;
        const dollar = document.getElementById('dollarValue').innerText;

        // Get the CSRF token for Laravel
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        // Perform an AJAX request to submit the conversion
        $.ajax({
            url: '{{ route("user.convert.points") }}', // Laravel route for handling the conversion
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken // Include the CSRF token
            },
            data: {
                points: points,
                dollar: dollar
            },
            success: function(response) {
                // Handle success response
                Swal.fire({
                    icon: 'success',
                    title: 'Point Converted to Dollar',
                    text: 'Please Hold on for Confirmation from Admin',
                    confirmButtonColor: '#d33',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = '/user/point/wallet'; // Replace with the desired URL
                    }
                });
                // alert(`Success: ${response.message}`);
                console.log(response.data); // Optionally, log response data

                // Optionally, redirect or update the UI with the response
            },
            error: function(xhr, status, error) {
                // Handle error response
                alert(`Error: ${xhr.responseJSON.message}`);
                console.log(xhr.responseJSON);
            }
        });
    }
</script>
@endsection

@section('content')

@if(Session::has('error'))
<div class="alert alert-danger alert-dismissible" role="alert">
    {!! session('error') !!}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<div class="card text-bg-theme">
    <!-- Add content if necessary -->
</div>

<div class="row">
    <div class="col-md-12">
        <h4 class="text-center card text-success">
            Total Points: {{ $customer->reward_point ?? 0 }}
        </h4>
    </div>

    <div class="col-md-12">
        <div class="container mt-5">
            <div class="card">
                <div class="card-header">
                    <h4>Points to Dollar Converter</h4>
                </div>
                <div class="card-body">
                    <meta name="csrf-token" content="{{ csrf_token() }}">
                    <label for="pointsRange" class="form-label">Select Points</label>

                    <!-- Dynamically set max value based on the customer's total points -->
                    <input type="range" class="form-range" id="pointsRange" min="0"
                        max="{{ $customer->reward_point ?? 10000 }}" step="100" value="0"
                        oninput="updateConversion(this.value)">

                    <div class="range-output">
                        Points: <span id="pointsValue">0</span><br>
                        Equivalent Dollar: $<span id="dollarValue">0.00</span>
                    </div>

                    <div class="mt-4">
                        <button class="btn btn-primary" onclick="submitConversion()">Convert</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="container mt-5">
            <div class="card">
                <h4 class="p-2">Point Wallet Conversion List</h4>

            </div>
            @if($point_convert_list->count()>0)
            <div class="card">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Customer</th>
                            <th>Status</th>
                            <th>Point</th>
                            <th>Dollar</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $statusLabels = array_flip(config('app.statuses'));
                        @endphp
                        @foreach($point_convert_list as $list)
                        <tr>
                            <td>{{ $list->id }}</td>
                            <td>{{ $list->customer->name }}</td>
                            <td>
                                <span
                                    class="{{ $list->status==1 ? 'bg-info' : ($list->status==2 ? 'bg-success' : 'bg-danger') }} p-2 text-white badge">
                                    {{ strtoupper($statusLabels[$list->status] ?? 'N/A') }}
                                </span>
                            </td>
                            <td>{{ $list->point }}</td>
                            <td>{{ $list->doller }}</td>
                            <td>{{ $list->created_at }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endif
        </div>
    </div>
</div>

@endsection