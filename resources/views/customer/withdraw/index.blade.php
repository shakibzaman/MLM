@extends('layouts/layoutMaster')

@section('title', 'Show Permission')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
        
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Customers</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>No</th>
                            <th>Amount</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th width="280px">Action</th>
                        </tr>
                        @foreach ($withdraws as $withdraw)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $withdraw->amount }}</td>
                            <td>{{ $withdraw->created_at->format('d/m/Y') }}</td>
                            <td>{{ $withdraw->status }}</td>
                            <td>
{{--                                <a class="btn btn-info" href="{{ route('customers.show', $customer->id) }}">Show</a>--}}
{{--                                <a class="btn btn-primary"--}}
{{--                                    href="{{ route('customers.edit', $customer->id) }}">Edit</a>--}}
{{--                                <form action="{{ route('customers.destroy', $customer->id) }}" method="POST"--}}
{{--                                    style="display:inline;">--}}
{{--                                    @csrf--}}
{{--                                    @method('DELETE')--}}
{{--                                    <button type="submit" class="btn btn-danger">Delete</button>--}}
{{--                                </form>--}}
                            </td>
                        </tr>
                        @endforeach
                    </table>
                    <div>
                        {{ $withdraws->appends(request()->query())->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
