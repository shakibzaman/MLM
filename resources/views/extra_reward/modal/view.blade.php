<div class="card p-2">
    <h4>Sent Money Review</h4>
    @php
    $statusLabels = array_flip(config('app.statuses'));
    @endphp
    <table class="table">
        <tbody>
            <tr>
                <th>ID</th>
                <td>{{ $reward->id }}</td>
            </tr>
            <tr>
                <th>Customer Name</th>
                <td>{{ $reward->customer->name }}</td>
            </tr>
            <tr>
                <th>Reward Site</th>
                <td>{{ $reward->reward_mapping->rewardSite->name }}</td>
            </tr>
            <tr>
                <th>Reward Submit Type</th>
                <td>{{ $reward->reward_mapping->rewardSubmitType->name }}</td>

            </tr>
            <tr>
                <th>Submited at</th>
                <td>{{ $reward->created_at }}</td>
            </tr>
            <tr>
                <th>Status</th>
                <td>
                    <span
                        class="{{ $reward->status==1 ? 'bg-info' : ($reward->status==2 ? 'bg-success' : 'bg-danger') }} p-2 text-white badge">
                        {{ strtoupper($statusLabels[$reward->status] ?? 'N/A') }}
                    </span>
                </td>
            </tr>
            <tr>
                <th>Screenshoot</th>
                <td>
                    <img src="{{ asset('storage/' . $reward->image) }}" alt="Screenshoot" class="img-fluid"
                        style="max-width: auto;">
                </td>
            </tr>
            <tr>
                <th>Url</th>
                <td>{{ $reward->url }}</td>
            </tr>

            @if($reward->status_change_date !=null)
            <tr>
                <th>Status Change By</th>
                <td>{{ $reward->changeby->username }}</td>
            </tr>
            <tr>
                <th>Status Change Date</th>
                <td>{{ $reward->status_change_date }}</td>
            </tr>
            @endif
        </tbody>
    </table>
    @if($reward->status=='1')
    <form action="{{ route('extraReward_update', $reward->id) }}" method="POST" class="mt-2">
        @csrf
        @method('PUT')
        <button class="btn btn-success" type="submit" name="status" value="2">Approved</button>
        <button class="btn btn-danger" type="submit" name="status" value="3">Reject</button>

    </form>
    @endif

</div>