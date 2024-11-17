@extends('layouts/layoutMaster')

@section('title', 'Company Setting')
@section('content')

<div class="card text-bg-theme mb-2">

    <div class="card-header d-flex justify-content-between align-items-center p-3 mb-2">
        <h4 class="m-0">Company Setting</h4>
        <div>
            <form method="POST" action="{!! route('company_settings.company_setting.destroy', $companySetting->id) !!}"
                accept-charset="UTF-8">
                <input name="_method" value="DELETE" type="hidden">
                {{ csrf_field() }}

                <a href="{{ route('company_settings.company_setting.edit', $companySetting->id ) }}"
                    class="btn btn-primary" title="Edit Company Setting">
                    <span class="fa-regular fa-pen-to-square" aria-hidden="true"></span> Edit
                </a>

                {{-- <button type="submit" class="btn btn-danger" title="Delete Company Setting"
                    onclick="return confirm(&quot;Click Ok to delete Company Setting.?&quot;)">
                    <span class="fa-regular fa-trash-can" aria-hidden="true"></span>
                </button> --}}

                <a href="{{ route('company_settings.company_setting.index') }}" class="btn btn-primary"
                    title="Show All Company Setting">
                    <span class="fa-solid fa-table-list" aria-hidden="true"></span>
                </a>

                {{-- <a href="{{ route('company_settings.company_setting.create') }}" class="btn btn-secondary"
                    title="Create New Company Setting">
                    <span class="fa-solid fa-plus" aria-hidden="true"></span>
                </a> --}}

            </form>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                <table class="table">
                    <tbody>
                        <tr>
                            <th>Name</th>
                            <td>{{ $companySetting->name }}</td>
                        </tr>
                        <tr>
                            <th>Contact Person</th>
                            <td>{{ $companySetting->contact_person }}</td>
                        </tr>
                        <tr>
                            <th>Referral Link</th>
                            <td>{{ $companySetting->referral_link_identifier }}</td>
                        </tr>
                        <tr>
                            <th>Seo Title</th>
                            <td>{{ $companySetting->seo_title }}</td>
                        </tr>
                        <tr>
                            <th>Legal Name</th>
                            <td>{{ $companySetting->legal_name }}</td>
                        </tr>
                        <tr>
                            <th>Google Secret Key</th>
                            <td>{{ $companySetting->google_secret_key }}</td>
                        </tr>
                        <tr>
                            <th>Captcha At Register</th>
                            <td>
                                <span class="badge {{ $companySetting->captcha_at_register==1? " bg-success":"bg-danger"
                                    }}">
                                    {{ $companySetting->captcha_at_register==1? "Enable":"Disable" }}</span>
                            </td>
                        </tr>
                        <tr>
                            <th>Address</th>
                            <td>{{ $companySetting->address }}</td>
                        </tr>
                        <tr>
                            <th>Zip Code</th>
                            <td>{{ $companySetting->zip_code }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-md-4">
                <table class="table">
                    <tbody>
                        <tr>
                            <th>Country</th>
                            <td>{{ $companySetting->country }}</td>
                        </tr>
                        <tr>
                            <th>City</th>
                            <td>{{ $companySetting->city }}</td>
                        </tr>
                        <tr>
                            <th>Phone</th>
                            <td>{{ $companySetting->phone }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{ $companySetting->email }}</td>
                        </tr>
                        <tr>
                            <th>Website</th>
                            <td>{{ $companySetting->website }}</td>
                        </tr>
                        <tr>
                            <th>Meta Description</th>
                            <td>{{ $companySetting->meta_description }}</td>
                        </tr>
                        <tr>
                            <th>Google Analytics Key</th>
                            <td>{{ $companySetting->google_analytic_key }}</td>
                        </tr>
                        <tr>
                            <th>Captcha At Client Registration</th>
                            <td>
                                <span class="badge {{ $companySetting->captcha_at_client_registration==1? "
                                    bg-success":"bg-danger" }}">
                                    {{ $companySetting->captcha_at_client_registration ==1? "Enable":"Disable"}}
                                </span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-md-4">
                <table class="table">
                    <tbody>
                        <tr>
                            <th>Company Start On</th>
                            <td>{{ $companySetting->company_start_on }}</td>
                        </tr>
                        <tr>
                            <th>Company Tagline</th>
                            <td>{{ $companySetting->tagline }}</td>
                        </tr>
                        <tr>
                            <th>Google Site Key</th>
                            <td>{{ $companySetting->google_site_key }}</td>
                        </tr>
                        <tr>
                            <th>Google Webmaster Tool Code</th>
                            <td>{{ $companySetting->google_webmaster_tool_code }}</td>
                        </tr>
                        <tr>
                            <th>Captcha at Admin Login</th>
                            <td>
                                <span class="badge {{ $companySetting->captcha_at_admin_login==1? "
                                    bg-success":"bg-danger" }}">
                                    {{ $companySetting->captcha_at_admin_login==1? "Enable":"Disable" }}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <th>We Accept Logo</th>
                            <td><img src="{{ asset('storage/' . $companySetting->we_accept_logo) }}"
                                    alt="We Accept Logo" width="200"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>

</div>

@endsection