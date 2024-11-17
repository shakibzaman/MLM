@extends('layouts/layoutMaster')

@section('title', 'Payeer Payment Instructions')

@section('content')
<div class="card mt-5 shadow-sm border-0">
    <div class="card-header text-center bg-light border-bottom-0">
        <h3 class="mb-0">Instructions for WebMoney WMZ Account</h3>
    </div>
    <div class="card-body">
        <h4 class="mb-4">How to Send Payments to a WebMoney WMZ Account:</h4>
        <ul class="list-unstyled">
            <li class="mb-3">
                <span class="fw-bold">1. Log in to WebMoney:</span> Go to WebMoney and log into your account.
            </li>

            <li class="mb-3">
                <span class="fw-bold">2. Go to "Transfer Funds":</span> Navigate to the Transfer Funds section.
            </li>

            <li class="mb-3">
                <span class="fw-bold">3. Enter Payment Details:</span>
                <ul class="ps-4">
                    <li><span class="fw-bold">- Recipient:</span> Enter the WMZ ID Z858079075932</li>
                    <li><span class="fw-bold">- Amount:</span> Specify the amount you want to send in WMZ (USD).</li>
                </ul>
            </li>

            <li>
                <span class="fw-bold">4. Confirm and Send:</span> Review the details, then click Send to complete the
                payment.
            </li>
        </ul>
    </div>
</div>

<div class="card mt-4 shadow-sm border-0">
    <div class="card-body text-center">
        <p class="mb-3 fw-bold">
            Make sure to use WMZ (USD) as the currency for this transaction. The transfer will be processed, and you’ll
            receive a confirmation.
        </p>
        <small class="text-muted">
            If you’re still unsure, check out our <a href="#" class="text-decoration-none">blog</a> for detailed
            step-by-step instructions and a video tutorial.
        </small>
    </div>
</div>
@endsection