@extends('layouts/layoutMaster')

@section('title', 'Binance Pay Instructions')

@section('content')
<div class="card mt-5 shadow-sm border-0">
    <div class="card-header text-center bg-light border-bottom-0">
        <h3 class="mb-0">Instructions</h3>
    </div>
    <div class="card-body">
        <ul class="list-unstyled">
            <li class="mb-3">
                <span class="fw-bold">1. Open Binance Pay:</span> Log in to Binance and select <em>'Pay'</em>.
            </li>
            <li class="mb-3">
                <span class="fw-bold">2. Choose USDT:</span> Set USDT as the payment currency.
            </li>
            <li class="mb-3">
                <span class="fw-bold">3. Enter Our Pay ID:</span> Type in our Pay ID: <strong>[Your Business Pay
                    ID]</strong>.
            </li>
            <li class="mb-3">
                <span class="fw-bold">4. Enter Amount:</span> Input the amount (minimum $10 USDT).
            </li>
            <li class="mb-3">
                <span class="fw-bold">5. Confirm Payment:</span> Review details and confirm.
            </li>
            <li>
                <span class="fw-bold">6. Wait For Approval:</span> We will check and approve it within 24 hours. If you
                still have any questions, please create a Support Ticket.
            </li>
        </ul>
    </div>
</div>

<div class="card mt-4 shadow-sm border-0">
    <div class="card-header text-center bg-light border-bottom-0">
        <h3 class="mb-0">How to Buy USDT on Binance</h3>
    </div>
    <div class="card-body">
        <div class="mb-3">
            <span class="fw-bold">1. Create a Binance Account:</span> <br>
            <span class="text-muted ps-3">- Sign up on Binance if you haven’t already.</span>
        </div>
        <div class="mb-3">
            <span class="fw-bold">2. Complete Verification:</span> <br>
            <span class="text-muted ps-3">- Enable SMS Authentication.</span> <br>
            <span class="text-muted ps-3">- Complete Identity Verification.</span>
        </div>
        <div>
            <span class="fw-bold">3. Buy USDT:</span> <br>
            <span class="text-muted ps-3">- Use a Credit/Debit Card.</span> <br>
            <span class="text-muted ps-3">- Choose Bank Transfer.</span> <br>
            <span class="text-muted ps-3">- Try P2P Trading or use a local agency.</span>
        </div>
        <p class="mt-4 text-center text-muted">
            If you’re still unsure, check out our <a href="#" class="text-decoration-none">blog</a> for detailed
            step-by-step instructions and a video tutorial.
        </p>
    </div>
</div>
@endsection