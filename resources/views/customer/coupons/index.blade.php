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
<script>
    document.querySelector('form').addEventListener('submit', function(e) {
    let balance = parseFloat({{ $customer->balance }});
    let amount = parseFloat(document.getElementById('amount').value);

    if (amount > balance) {
        e.preventDefault(); // Prevent form submission
        alert('Insufficient balance to make this transfer.');
    }
});

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

    <div class="card-header d-flex justify-content-between align-items-center p-3">
        <h4 class="m-0">Coupons</h4>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <!-- About User -->
        <div class="card mb-6 mt-2">

            <div class="form-box p-4 mt-2">
                <form action="{{ route('user.apply.coupon') }}" method="POST">
                    <!-- CSRF Token for Laravel -->
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <!-- Amount Input -->
                            <div class="form-group">
                                <label for="amount">Coupon Code</label>
                                <input type="text" id="code" name="code" class="form-control" placeholder="Enter Code"
                                    required>
                            </div>
                        </div>
                    </div>
                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary">Claim</button>
                </form>

            </div>
        </div>
        @if($coupons->count()>0)

        <div class="card">
            <h4 class="p-2">Apply Coupons</h4>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Status</th>
                        <th>Code</th>
                        <th>Point Amount</th>
                        <th>Apply Date</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $statusLabels = array_flip(config('app.statuses'));
                    @endphp
                    @foreach($coupons as $list)
                    <tr>
                        <td>{{ $list->id }}</td>
                        <td>
                            <span
                                class="{{ $list->status==1 ? 'bg-info' : ($list->status==2 ? 'bg-success' : 'bg-danger') }} p-2 text-white badge">
                                {{ strtoupper($statusLabels[$list->status] ?? 'N/A') }}
                            </span>
                        </td>

                        <td>{{ $list->coupon->code }}</td>
                        <td>{{ $list->coupon_point }}</td>
                        <td>{{ $list->created_at }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
    </div>

</div>
@endsection