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
        <h4 class="m-0">Fund Transfer</h4>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <!-- About User -->
        <div class="card mb-6 mt-2">
            <div class="border">
                <div class="row text-center p-2">
                    <div class="col-md-6 d-flex justify-content-between align-items-center p-4">
                        <div>
                            <p class="mb-0">E-Wallet Balance</p>
                            <h4 class="mb-0">{{ $customer->balance }}</h4>
                        </div>
                        <i class="fas fa-3x fa-book-open me-4"></i>
                    </div>
                    <div class="border-left col-md-6 d-flex justify-content-between align-items-center p-4">
                        <div>
                            <p class="mb-0">Deposit Wallet Balance</p>
                            <h4 class="mb-0">0</h4>
                        </div>
                        <i class="fas fa-3x fa-book-open me-4"></i>
                    </div>
                </div>
            </div>
            <div class="form-box p-4 mt-2">
                <form action="{{ route('user.fund.transfer.store') }}" method="POST">
                    <!-- CSRF Token for Laravel -->
                    @csrf
                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="to_user">Search User</label>
                                <select id="sent_to" name="sent_to" class="form-control select2" required>
                                    @foreach($customer->subscribers as $subscriber)
                                    <option value={{ $subscriber->id }}>{{ $subscriber->name }}</option>
                                    <!-- Populate with user data dynamically -->
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <!-- Amount Input -->
                            <div class="form-group">
                                <label for="amount">Amount</label>
                                <input type="number" id="amount" name="amount" class="form-control"
                                    placeholder="Enter amount" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <!-- Notes Input -->
                            <div class="form-group">
                                <label for="notes">Notes</label>
                                <textarea id="note" name="note" class="form-control" rows="3"
                                    placeholder="Enter any notes" required></textarea>
                            </div>
                        </div>
                    </div>
                    @if($permissionSetting->user_send_money == 1)
                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary mt-2">Send Money</button>
                    @else
                    <p class="text-danger"><strong>Currently Send Money is disabled. Please Contact with
                            Support</strong></p>
                    @endif
                </form>

            </div>
        </div>
        @if($sent_money_list->count()>0)

        <div class="card">
            <h4 class="p-2">Sent History</h4>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Status</th>
                        <th>To User</th>
                        <th>Amount</th>
                        <th>Note</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $statusLabels = array_flip(config('app.statuses'));
                    @endphp
                    @foreach($sent_money_list as $list)
                    <tr>
                        <td>{{ $list->id }}</td>
                        <td>
                            <span
                                class="{{ $list->status==1 ? 'bg-info' : ($list->status==2 ? 'bg-success' : 'bg-danger') }} p-2 text-white badge">
                                {{ strtoupper($statusLabels[$list->status] ?? 'N/A') }}
                            </span>
                        </td>

                        <td>{{ $list->receiver->name }}</td>
                        <td>{{ $list->amount }}</td>
                        <td>{{ $list->note }}</td>
                        <td>{{ $list->created_at }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
        @if($received_money_list->count()>0)
        <div class="card mt-2">
            <h4 class="p-2">Received History</h4>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Status</th>
                        <th>User</th>
                        <th>Amount</th>
                        <th>Note</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $statusLabels = array_flip(config('app.statuses'));
                    @endphp
                    @foreach($received_money_list as $list)
                    <tr>
                        <td>{{ $list->id }}</td>
                        <td>
                            <span
                                class="{{ $list->status==1 ? 'bg-info' : ($list->status==2 ? 'bg-success' : 'bg-danger') }} p-2 text-white badge">
                                {{ strtoupper($statusLabels[$list->status] ?? 'N/A') }}
                            </span>
                        </td>
                        <td>{{ $list->sender->name }}</td>
                        <td>{{ $list->amount }}</td>
                        <td>{{ $list->note }}</td>
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