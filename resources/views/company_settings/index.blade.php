@extends('layouts/layoutMaster')

@section('title', 'KYC Dashboard')

@section('content')

@if(Session::has('success_message'))
<div class="alert alert-success alert-dismissible" role="alert">
    {!! session('success_message') !!}

    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<div class="card text-bg-theme">

    <div class="card-header d-flex justify-content-between align-items-center p-3">
        <h4 class="m-0">Company Settings</h4>
        <div>
            <a href="{{ route('company_settings.company_setting.create') }}" class="btn btn-secondary"
                title="Create New Company Setting">
                <span class="fa-solid fa-plus" aria-hidden="true"></span>
            </a>
        </div>
    </div>

    @if(count($companySettings) == 0)
    <div class="card-body text-center">
        <h4>No Company Settings Available.</h4>
    </div>
    @else
    <div class="card-body p-0">
        <div class="table-responsive">

            <table class="table table-striped ">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Contact Person</th>
                        <th>Referral Link</th>
                        <th>Seo Title</th>
                        <th>Legal Name</th>
                        <th>Google Secret Key</th>
                        <th>Captcha At Register</th>
                        <th>Address</th>
                        <th>Zip Code</th>
                        <th>Company Start On</th>
                        <th>Country</th>
                        <th>City</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Website</th>
                        <th>Meta Description</th>
                        <th>Google Analytics Key</th>
                        <th>Captcha At Client Registration</th>
                        <th>Company tagline</th>
                        <th>Google Site Key</th>
                        <th>Google webmaster tool code</th>
                        <th>Captcha at admin login</th>
                        <th>We Accept Logo</th>

                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($companySettings as $companySetting)
                    <tr>
                        <td class="align-middle">{{ $companySetting->name }}</td>
                        <td class="align-middle">{{ $companySetting->contact_person }}</td>
                        <td class="align-middle">{{ $companySetting->referral_link_identifier }}</td>
                        <td class="align-middle">{{ $companySetting->seo_title }}</td>
                        <td class="align-middle">{{ $companySetting->legal_name }}</td>
                        <td class="align-middle">{{ $companySetting->google_secret_key }}</td>
                        <td class="align-middle">{{ $companySetting->captcha_at_register }}</td>
                        <td class="align-middle">{{ $companySetting->address }}</td>
                        <td class="align-middle">{{ $companySetting->zip_code }}</td>
                        <td class="align-middle">{{ $companySetting->company_start_on }}</td>
                        <td class="align-middle">{{ $companySetting->country }}</td>
                        <td class="align-middle">{{ $companySetting->city }}</td>
                        <td class="align-middle">{{ $companySetting->phone }}</td>
                        <td class="align-middle">{{ $companySetting->email }}</td>
                        <td class="align-middle">{{ $companySetting->website }}</td>
                        <td class="align-middle">{{ $companySetting->meta_description }}</td>
                        <td class="align-middle">{{ $companySetting->google_analytic_key }}</td>
                        <td class="align-middle">{{ $companySetting->captcha_at_client_registration }}
                        </td>
                        <td class="align-middle">{{ $companySetting->tagline }}</td>
                        <td class="align-middle">{{ $companySetting->google_site_key }}</td>
                        <td class="align-middle">{{ $companySetting->google_webmaster_tool_code }}</td>
                        <td class="align-middle">{{ $companySetting->captcha_at_admin_login }}</td>
                        <td class="align-middle">{{ $companySetting->we_accept_logo }}</td>

                        <td class="text-end">

                            <form method="POST"
                                action="{!! route('company_settings.company_setting.destroy', $companySetting->id) !!}"
                                accept-charset="UTF-8">
                                <input name="_method" value="DELETE" type="hidden">
                                {{ csrf_field() }}

                                <div class="btn-group btn-group-sm" role="group">
                                    <a href="{{ route('company_settings.company_setting.show', $companySetting->id ) }}"
                                        class="btn btn-info" title="Show Company Setting">
                                        <span class="fa-solid fa-arrow-up-right-from-square" aria-hidden="true"></span>
                                    </a>
                                    <a href="{{ route('company_settings.company_setting.edit', $companySetting->id ) }}"
                                        class="btn btn-primary" title="Edit Company Setting">
                                        <span class="fa-regular fa-pen-to-square" aria-hidden="true"></span>
                                    </a>

                                    <button type="submit" class="btn btn-danger" title="Delete Company Setting"
                                        onclick="return confirm(&quot;Click Ok to delete Company Setting.&quot;)">
                                        <span class="fa-regular fa-trash-can" aria-hidden="true"></span>
                                    </button>
                                </div>

                            </form>

                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>

        {!! $companySettings->links('pagination') !!}
    </div>

    @endif

</div>
@endsection