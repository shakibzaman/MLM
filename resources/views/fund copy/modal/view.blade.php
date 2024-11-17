<div class="card p-2">
    <h4>Sent Money Review</h4>
    @php
    $statusLabels = array_flip(config('app.statuses'));
    @endphp
    <table class="table">
        <tbody>
            <tr>
                <th>ID</th>
                <td>{{ $transfer->id }}</td>
            </tr>
            <tr>
                <th>From</th>
                <td>{{ $transfer->sender->name }}</td>
            </tr>
            <tr>
                <th>To</th>
                <td>{{ $transfer->receiver->name }}</td>

            </tr>
            <tr>
                <th>Amount</th>
                <td>{{ $transfer->amount }}</td>
            </tr>
            <tr>
                <th>Status</th>
                <td>
                    <span
                        class="{{ $transfer->status==1 ? 'bg-info' : ($transfer->status==2 ? 'bg-success' : 'bg-danger') }} p-2 text-white badge">
                        {{ strtoupper($statusLabels[$transfer->status] ?? 'N/A') }}
                    </span>
                </td>
            </tr>
            <tr>
                <th>Note</th>
                <td>{{ $transfer->note }}</td>
            </tr>
            @if($transfer->status_change_date !=null)
            <tr>
                <th>Status Change By</th>
                <td>{{ $transfer->changeby->name }}</td>
            </tr>
            <tr>
                <th>Status Change Date</th>
                <td>{{ $transfer->status_change_date }}</td>
            </tr>
            @endif
        </tbody>
    </table>
    @if($transfer->status=='1')
    <form action="{{ route('balance_transfer_update', $transfer->id) }}" method="POST" class="mt-2">
        @csrf
        @method('PUT')
        <button class="btn btn-success" type="submit" name="status" value="2">Approved</button>
        <button class="btn btn-danger" type="submit" name="status" value="3">Reject</button>

    </form>
    @endif

</div>