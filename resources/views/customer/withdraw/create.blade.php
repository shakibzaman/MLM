@extends('layouts/layoutMaster')

@section('title', 'Show User')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Create withdraw request</h3>
                </div>
                <div class="card-body">
                    <h4>Your balance: {{ auth()->guard('customer')->user()->balance }}</h4>

                    <form id="withdrawForm" action="{{ route('customer.withdraw.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="amount">Amount:</label>
                            <input type="number" name="amount" class="form-control" required>
                        </div>
                        @if($permissionSetting->user_withdraw == 1)
                        <div class="form-group pt-4">
                            @if($userSetting->password_for_withdraw == 1)
                            <button type="button" class="btn btn-primary" onclick="showPasswordModal()">Submit</button>
                            @else
                            <button type="submit" class="btn btn-primary">Submit</button>
                            @endif
                        </div>
                        @else
                        <p class="text-danger"><strong>Currently withdraw is disabled. Please Contact with Support</strong></p>
                        @endif
                    </form>
                </div>
            </div>
        </div>

        <!-- Password Confirmation Modal -->
        <div class="modal fade" id="passwordModal" tabindex="-1" role="dialog" aria-labelledby="passwordModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="passwordModalLabel">Confirm Password</h5>

                    </div>
                    <div class="modal-body">
                        <form id="passwordForm">
                            <div class="input-group">
                                <input type="password" id="password" name="password" class="form-control" required>
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-outline" onclick="togglePasswordVisibility()">
                                        <i id="password-icon" class="fa fa-eye"></i> <!-- Eye icon -->
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary" onclick="confirmPassword()">Confirm</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    function showPasswordModal() {
    $('#passwordModal').modal('show');
}
function togglePasswordVisibility() {
    const passwordField = document.getElementById('password');
    const passwordIcon = document.getElementById('password-icon');

    if (passwordField.type === 'password') {
        passwordField.type = 'text';
        passwordIcon.classList.remove('fa-eye');
        passwordIcon.classList.add('fa-eye-slash');
    } else {
        passwordField.type = 'password';
        passwordIcon.classList.remove('fa-eye-slash');
        passwordIcon.classList.add('fa-eye');
    }
}
function confirmPassword() {
    const password = document.getElementById('password').value;

    // Send an AJAX request to verify the password
    $.ajax({
        url: '{{ route("customer.password.verify") }}', // Route to verify password
        method: 'POST',
        data: {
            _token: '{{ csrf_token() }}',
            password: password
        },
        success: function(response) {
            if (response.success) {
                // Password is correct, submit the withdrawal form
                $('#passwordModal').modal('hide');
                document.getElementById('withdrawForm').submit();
            } else {
                $('#passwordModal').modal('hide');

                Swal.fire({
                    icon: 'error',
                    title: 'Incorrect Password',
                    text: 'The password you entered is incorrect. Please try again.',
                    confirmButtonColor: '#d33',
                    confirmButtonText: 'OK'
                });
                // Password is incorrect, show an error message
                // alert('Incorrect password. Please try again.');
            }
        },
        error: function() {
            alert('There was an error verifying the password. Please try again later.');
        }
    });
}

</script>
@endsection