<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\CompanySetting;
use Illuminate\Http\Request;
use Exception;

class CompanySettingsController extends Controller
{

    /**
     * Display a listing of the company settings.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $companySetting = CompanySetting::where('id', 1)->first();
        if ($companySetting) {
            return view('company_settings.show', compact('companySetting'));
        } else {
            return view('company_settings.create');
        }
    }

    /**
     * Show the form for creating a new company setting.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {


        return view('company_settings.create');
    }

    /**
     * Store a new company setting in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {

        $data = $this->getData($request);

        CompanySetting::create($data);

        return redirect()->route('company_settings.company_setting.index')
            ->with('success_message', 'Company Setting was successfully added.');
    }

    /**
     * Display the specified company setting.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $companySetting = CompanySetting::findOrFail($id);

        return view('company_settings.show', compact('companySetting'));
    }

    /**
     * Show the form for editing the specified company setting.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $companySetting = CompanySetting::findOrFail($id);


        return view('company_settings.edit', compact('companySetting'));
    }

    /**
     * Update the specified company setting in the storage.
     *
     * @param int $id
     * @param Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function update($id, Request $request)
    {

        $data = $this->getData($request);

        $companySetting = CompanySetting::findOrFail($id);
        $companySetting->update($data);

        return redirect()->route('company_settings.company_setting.index')
            ->with('success_message', 'Company Setting was successfully updated.');
    }

    /**
     * Remove the specified company setting from the storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $companySetting = CompanySetting::findOrFail($id);
            $companySetting->delete();

            return redirect()->route('company_settings.company_setting.index')
                ->with('success_message', 'Company Setting was successfully deleted.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }


    /**
     * Get the request's data from the request.
     *
     * @param Illuminate\Http\Request\Request $request 
     * @return array
     */
    protected function getData(Request $request)
    {
        $rules = [
            'name' => 'string|min:1|max:255|nullable',
            'contact_person' => 'string|min:1|nullable',
            'referral_link_identifier' => 'string|min:1|nullable',
            'seo_title' => 'string|min:1|nullable',
            'legal_name' => 'string|min:1|nullable',
            'google_secret_key' => 'string|min:1|nullable',
            'captcha_at_register' => 'nullable',
            'address' => 'string|min:1|nullable',
            'zip_code' => 'string|min:1|nullable',
            'company_start_on' => 'string|min:1|nullable',
            'country' => 'numeric|nullable',
            'city' => 'string|min:1|nullable',
            'phone' => 'string|min:1|nullable',
            'email' => 'nullable',
            'website' => 'nullable|string|min:0',
            'meta_description' => 'nullable|string|min:0',
            'google_analytic_key' => 'nullable|string|min:0',
            'captcha_at_client_registration' => 'nullable',
            'tagline' => 'nullable|string|min:0',
            'google_site_key' => 'nullable|string|min:0',
            'google_webmaster_tool_code' => 'nullable|string|min:0',
            'captcha_at_admin_login' => 'nullable',
            'we_accept_logo' => ['nullable', 'file'],
        ];


        $data = $request->validate($rules);
        $data['captcha_at_register'] = $request->has('captcha_at_register') ? 1 : 0;
        $data['captcha_at_client_registration'] = $request->has('captcha_at_client_registration') ? 1 : 0;
        $data['captcha_at_admin_login'] = $request->has('captcha_at_admin_login') ? 1 : 0;

        if ($request->has('custom_delete_we_accept_logo')) {
            $data['we_accept_logo'] = null;
        }
        if ($request->hasFile('we_accept_logo')) {
            $data['we_accept_logo'] = $this->moveFile($request->file('we_accept_logo'));
        }



        return $data;
    }

    /**
     * Moves the attached file to the server.
     *
     * @param \Symfony\Component\HttpFoundation\File\UploadedFile $file
     *
     * @return string
     */
    protected function moveFile($file)
    {
        if (!$file->isValid()) {
            return '';
        }

        $path = config('laravel-code-generator.files_upload_path', 'uploads');
        $saved = $file->store('public/' . $path, config('filesystems.default'));

        return substr($saved, 7);
    }
}
