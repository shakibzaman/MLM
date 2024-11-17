@extends('layouts/layoutMaster')

@section('title', 'User List')

@section('content')
<div class="row">
    <div class="col-lg-12 mb-3">
        <div class="d-flex justify-content-between align-items-center">
            <h2>Users Management</h2>
            <a class="btn btn-success" href="{{ route('users.create') }}">Create New User</a>
        </div>
    </div>
</div>

@if ($message = Session::get('success'))
<div class="alert alert-success">
    <label>{{ $message }}</label>
</div>
@endif

<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Roles</th>
                <th scope="col">Status</th>
                <th scope="col" width="280px">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $key => $user)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    @if (!empty($user->getRoleNames()))
                    @foreach ($user->getRoleNames() as $v)
                    <span class="badge bg-success">{{ $v }}</span>
                    @endforeach
                    @endif
                </td>
                <td class="{{ $user->status == config('app.user_status.active') ? 'bg-success' :'bg-danger' }}">
                    @php
                    $statusLabel = array_flip(config('app.user_status'));
                    $status = $statusLabel[$user->status] ?? 'N/A';
                    @endphp
                    {{ Str::ucfirst($status) }}
                </td>

                <td>
                    <div class="d-flex gap-2" role="group" aria-label="User Actions">
                        <a class="btn btn-primary flex-fill" href="{{ route('users.show', $user->id) }}">Show</a>
                        <a class="btn btn-success flex-fill" href="{{ route('users.edit', $user->id) }}">Edit</a>
                        <form method="POST" action="{{ route('users.destroy', $user->id) }}" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger flex-fill">Delete</button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

{!! $data->render() !!}
@endsection