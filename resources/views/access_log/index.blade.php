@extends('layouts/layoutMaster')

@section('title', 'Access Log')
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
@section('content')

<div class="card p-2 mb-3">

    <h4>Access Logs</h4>

</div>

<div class="card">
    <div class="card-header">
        <form action="{{ route('rollPermission-access-logs') }}" method="GET">
            <div class="row mb-4">
                <!-- User Dropdown -->
                <div class="col-md-4">
                    <label for="user_id">Select User:</label>
                    <select name="user_id" id="user_id" class="form-control select2">
                        <option value="">-- Select User --</option>
                        @foreach ($users as $user)
                        <option value="{{ $user->id }}" {{ request('user_id')==$user->id ? 'selected' : '' }}>
                            {{ $user->name }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <!-- Time Period Dropdown -->
                <div class="col-md-3">
                    <label for="filter">Select Time Period:</label>
                    <select name="filter" id="filter" onchange="toggleDateInputs(this.value)" class="form-control">
                        <option value="">-- Select Time Period --</option>
                        <option value="today" {{ request('filter')=='today' ? 'selected' : '' }}>Today</option>
                        <option value="yesterday" {{ request('filter')=='yesterday' ? 'selected' : '' }}>Yesterday
                        </option>
                        <option value="this_week" {{ request('filter')=='this_week' ? 'selected' : '' }}>This Week
                        </option>
                        <option value="last_week" {{ request('filter')=='last_week' ? 'selected' : '' }}>Last Week
                        </option>
                        <option value="this_month" {{ request('filter')=='this_month' ? 'selected' : '' }}>This Month
                        </option>
                        <option value="last_month" {{ request('filter')=='last_month' ? 'selected' : '' }}>Last Month
                        </option>
                        <option value="custom" {{ request('filter')=='custom' ? 'selected' : '' }}>Custom Range</option>
                    </select>
                </div>

                <!-- Custom Date Range Inputs -->
                <div class="col-md-3" id="customDateRange" style="display: none;">
                    <label for="start_date">Start Date:</label>
                    <input type="date" name="start_date" id="start_date" class="form-control"
                        value="{{ request('start_date') }}">
                </div>

                <div class="col-md-3" id="customDateRangeEnd" style="display: none;">
                    <label for="end_date">End Date:</label>
                    <input type="date" name="end_date" id="end_date" class="form-control"
                        value="{{ request('end_date') }}">
                </div>

                <!-- Filter Button -->
                <div class="col-md-2 mt-7">
                    <button type="submit" class="btn btn-primary">Filter</button>
                </div>
                <div class="col-md-2 mt-7">
                    <a href="{{ route('rollPermission-access-logs') }}" class="btn btn-danger">Reset</a>
                </div>
            </div>
        </form>
    </div>
    <div class="card-body">
        <!-- Display Access Logs -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Date</th>
                    <th>User Name</th>
                    <th>Type</th>
                    <th>Route</th>
                    <th>Referral URL</th>
                    <th>IP Address</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($logs as $log)
                <tr>
                    <td>{{ $log->id }}</td>
                    <td>{{ $log->created_at }}</td>
                    <td>{{ $log->user->name }}</td>
                    <td><span
                            class="badge {{ $log->auth_type=='customer'?'bg-success':'bg-info' }}">{{strtoupper($log->auth_type)
                            }}</span> </td>
                    <td>{{ $log->route }}</td>
                    <td>{{ $log->referral_url }}</td>
                    <td>{{ $log->ip_address }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-between">
            <div>
                Showing {{ $logs->count() }} of {{ $logs->total() }} records
            </div>
            <div>
                {{ $logs->appends(request()->query())->links('pagination::bootstrap-4') }}
            </div>
        </div>

    </div>
</div>
<!-- Search Form -->




<script>
    // Show/hide custom date range inputs based on the selected filter
        function toggleDateInputs(value) {
            const customRangeInputs = document.getElementById('customDateRange');
            const customRangeEndInputs = document.getElementById('customDateRangeEnd');
            
            if (value === 'custom') {
                customRangeInputs.style.display = 'block';
                customRangeEndInputs.style.display = 'block';
            } else {
                customRangeInputs.style.display = 'none';
                customRangeEndInputs.style.display = 'none';
            }
        }

        // On page load, check if the 'custom' option is selected
        document.addEventListener('DOMContentLoaded', function () {
            const filterValue = document.getElementById('filter').value;
            toggleDateInputs(filterValue);
        });
</script>
@endsection