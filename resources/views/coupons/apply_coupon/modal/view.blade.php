<div class="card p-2">
    <h4>Sent Money Review</h4>
    @php
    $statusLabels = array_flip(config('app.statuses'));
    @endphp
    <table class="table">
        <tbody>
            <tr>
                <th>ID</th>
                <td>{{ $coupon->id }}</td>
            </tr>
            <tr>
                <th>Customer Name</th>
                <td>{{ $coupon->customer->name }}</td>
            </tr>
            <tr>
                <th>Coupon Code</th>
                <td>{{ $coupon->coupon->code }}</td>

            </tr>
            <tr>
                <th>Coupon Point</th>
                <td>{{ $coupon->coupon_point }}</td>

            </tr>
            <tr>
                <th>Submited at</th>
                <td>{{ $coupon->created_at }}</td>
            </tr>
            <tr>
                <th>Status</th>
                <td>
                    <span
                        class="{{ $coupon->status==1 ? 'bg-info' : ($coupon->status==2 ? 'bg-success' : 'bg-danger') }} p-2 text-white badge">
                        {{ strtoupper($statusLabels[$coupon->status] ?? 'N/A') }}
                    </span>
                </td>
            </tr>
            @if($coupon->status_change_date !=null)
            <tr>
                <th>Status Change By</th>
                <td>{{ $coupon->changeby->username }}</td>
            </tr>
            <tr>
                <th>Status Change Date</th>
                <td>{{ $coupon->status_change_date }}</td>
            </tr>
            @endif
        </tbody>
    </table>
    @if($coupon->status=='1')
    <form action="{{ route('appliedCoupon_update', $coupon->id) }}" method="POST" class="mt-2">
        @csrf
        @method('PUT')
        <button class="btn btn-success" type="submit" name="status" value="2">Approved</button>
        <button class="btn btn-danger" type="submit" name="status" value="3">Reject</button>

    </form>
    @endif

</div>