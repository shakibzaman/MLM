@extends('layouts/layoutMaster')

@section('title', 'Show User')


@section('content')
  <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit customer</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('manage-member-customers.update', $customer->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                      <div class="mb-3">
                        <label for="name" class="form-label">First Name:</label>
                        <input type="text" name="first_name" class="form-control" value="{{ $customer->first_name }}" required>
                      </div>
                      <div class="mb-3">
                        <label for="name" class="form-label">Last Name:</label>
                        <input type="text" name="last_name" class="form-control" value="{{ $customer->last_name }}" required>
                      </div>
                        <div class="mb-3">
                            <label for="name">Email address:</label>
                            <input type="email" name="email" class="form-control" value="{{ $customer->email }}"
                                   required>
                        </div>
                      <div class="mb-3">
                        <label for="phone" class="form-label">Phone:</label>
                        <input type="text" name="phone" class="form-control" value="{{ $customer->phone }}" required>
                      </div>
                        <div class="mb-3">
                            <label for="country">Country:</label>
                            <select name="country_id" class="form-control">
                                <option value="">Select a country</option>
                                @foreach($countries as $country)
                                    <option @if($customer->country_id == $country->id) selected @endif value="{{$country->id }}">{{ $country->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="city">City:</label>
                            <input type="text" name="city" class="form-control" value="{{ $customer->city }}"
                                   required>
                        </div>
                        <div class="mb-3">
                            <label for="zip">Zip code:</label>
                            <input type="text" name="zip" class="form-control" value="{{ $customer->zip }}"
                                   required>
                        </div>
                        <div class="mb-3">
                            <label for="address">Address:</label>
                            <input type="text" name="address" class="form-control" value="{{ $customer->address }}"
                                   required>
                        </div>
                        <div class="mb-3">
                            <label for="password">New password:</label>
                            <input type="password" name="password" class="form-control" >
                        </div>
                        <div class="mb-3">
                            <label for="name">Status:</label>
                            <select name="status" class="form-select">
                                <option value="">Select status</option>
                                <option @if($customer->status == '1') selected @endif value="1">Active</option>
                                <option @if($customer->status == '2') selected @endif value="2">Inactive</option>
                                <option @if($customer->status == '3') selected @endif value="3">Banned</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="email_verified_at">Email verified:</label>
                            <input type="checkbox" name="email_verified_at" class="form-check-input" @if(!is_null($customer->email_verified_at)) checked @endif value="{{ date('Y-m-d') }}">
                        </div>

                        <div class="mb-3">
                            <label for="document_verified">Document verified:</label>
                            <input type="checkbox" name="document_verified" @if(($customer->document_verified == 1)) checked @endif class="form-check-input" value="1">
                        </div>
                        <div class="mb-3">
                            <label for="2fa _auth">2FA Auth:</label>
                            <input type="checkbox" name="auth_2fa" @if(($customer->auth_2fa == 1)) checked @endif class="form-check-input" value="1">
                        </div>
                        <div class="mb-3">
                          <label for="image" class="form-label">Profile picture:</label>
                          <input class="form-control" type="file" name="image" id="image">
                        </div>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </form>
                </div>
            </div>
@endsection
