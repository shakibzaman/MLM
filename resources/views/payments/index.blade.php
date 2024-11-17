@extends('layouts/layoutMaster')

@section('title', 'Payeer Payment')

@section('content')
<div class="card mt-5 border-0">
    <div class="card-header text-center border-bottom-0">
        <h3>Select a Payment Gateway for Payment</h3>
    </div>
    @php
    $paymentType = config('payment.type');
    $paymentType = array_flip($paymentType);
    @endphp
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <table class="table">
                    <tr>
                        <th>Payment Type</th>
                        <td>{{strtoupper($paymentType[$payment->payment_type]) }} </td>
                    </tr>
                    <tr>
                        <th>Payment Amount</th>
                        <td>{{ $payment->amount }}</td>
                    </tr>
                </table>
            </div>
            <div class="col-md-6">
                <form method="POST" action="{{ route('payment.process') }}">
                    @csrf
                    <div class="mb-4 row align-items-center">
                        <label for="gateway" class="col-form-label col-lg-4 col-xl-3 text-lg-end">{{ __('Payment
                            Gateway')
                            }}</label>
                        <input type="hidden" name="payment_id" value="{{ $payment->id }}">
                        <div class="col-lg-8 col-xl-9">
                            <select class="form-select{{ $errors->has('gateway') ? ' is-invalid' : '' }}" id="gateway"
                                name="gateway">
                                <option value="" selected disabled>-- Select Gateway --</option>
                                @foreach ($gateways as $key => $gateway)
                                <option value="{{ $key }}">{{ $gateway }}</option>
                                @endforeach
                            </select>
                            {!! $errors->first('gateway', '<div class="invalid-feedback">:message</div>') !!}
                        </div>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary mt-3">Proceed to Pay</button>
                    </div>
                </form>
            </div>
        </div>


    </div>
</div>
@endsection