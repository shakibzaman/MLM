@extends('layouts/layoutMaster')

@section('title', 'Payeer Payment Instructions')

@section('content')
<div class="card mt-5 shadow-sm border-0">
    <div class="card-header text-center bg-light border-bottom-0">
        <h3 class="mb-0">Instructions for Payeer Payment</h3>
    </div>
    <div class="card-body">
        <ul class="list-unstyled">
            <li class="mb-3">
                <span class="fw-bold">1. Log in to Payeer:</span> Go to Payeer and sign in.
            </li>

            <li class="mb-3">
                <span class="fw-bold">2. Go to Transfer:</span> Select the Transfer option in the menu.
            </li>

            <li class="mb-3">
                <span class="fw-bold">3. Enter Payment Details:</span>
                <ul class="ps-4">
                    <li><span class="fw-bold">- Recipient:</span> Enter the Payeer account number P1124156692</li>
                    <li><span class="fw-bold">- Currency:</span> Select ‘USDT’ and enter the amount.</li>
                </ul>
            </li>

            <li class="mb-3">
                <span class="fw-bold">4. Confirm and Send:</span> Review the details, then click Send to complete the
                USDT payment.
            </li>

            <li>
                <span class="fw-bold">5. Confirm Payment:</span> Review details and confirm.
            </li>
        </ul>
    </div>
</div>

<div class="card mt-4 shadow-sm border-0">
    <div class="card-body text-center">
        <p class="mb-0 fw-bold">
            Please select USDT as the currency for this transaction. The transfer will be processed immediately, and you
            will receive a confirmation within 24 hours.
        </p>
    </div>
</div>
@endsection