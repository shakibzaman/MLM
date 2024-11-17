<div class="card p-2">
    <h4>Point Wallet Review</h4>
    @php
    $statusLabels = array_flip(config('app.statuses'));
    @endphp
    <table class="table">
        <tbody>
            <tr>
                <th>ID</th>
                <td>{{ $wallet->id }}</td>
            </tr>
            <tr>
                <th>Customer Name</th>
                <td>{{ $wallet->customer->name }}</td>
            </tr>
            <tr>
                <th>Points</th>
                <td>{{ $wallet->point }}</td>
            </tr>
            <tr>
                <th>Dollers</th>
                <td>{{ $wallet->doller }}</td>

            </tr>
            <tr>
                <th>Submited at</th>
                <td>{{ $wallet->created_at }}</td>
            </tr>
            <tr>
                <th>Status</th>
                <td>
                    <span
                        class="{{ $wallet->status==1 ? 'bg-info' : ($wallet->status==2 ? 'bg-success' : 'bg-danger') }} p-2 text-white badge">
                        {{ strtoupper($statusLabels[$wallet->status] ?? 'N/A') }}
                    </span>
                </td>
            </tr>


            @if($wallet->status_change_date !=null)
            <tr>
                <th>Status Change By</th>
                <td>{{ $wallet->changeby->username }}</td>
            </tr>
            <tr>
                <th>Status Change Date</th>
                <td>{{ $wallet->status_change_date }}</td>
            </tr>
            @endif
        </tbody>
    </table>
    @if($wallet->status=='1')
    <form action="{{ route('pointWallet_update', $wallet->id) }}" method="POST" class="mt-2">
        @csrf
        @method('PUT')
        <button class="btn btn-success" type="submit" name="status" value="2">Approved</button>
        <button class="btn btn-danger" type="submit" name="status" value="3">Reject</button>

    </form>
    @endif

</div>