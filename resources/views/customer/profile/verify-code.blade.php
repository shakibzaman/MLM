@extends('layouts/layoutMaster')

@section('content')
<div class="container card p-4">
    <h4>Verify Code</h4>
    @if($errors->any())
    <div class="alert alert-danger">{{ $errors->first() }}</div>
    @endif

    <form action="{{ route('user.change-password.verify-code') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="verification_code">Verification Code:</label>
            <input type="text" name="verification_code" class="form-control" required>
        </div>
        <div class="form-group mt-4">
            <button type="submit" class="btn btn-primary">Verify and Change Password</button>
        </div>
    </form>
</div>
@endsection