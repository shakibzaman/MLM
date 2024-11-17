<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\GlobalSetting;
use App\Models\PermissionSetting;
use Illuminate\Http\Request;
use Exception;

class GlobalSettingsController extends Controller
{

    /**
     * Display a listing of the global settings.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $default_id = 1;
        $globalSetting = GlobalSetting::where('id', $default_id)->first();
        $site_currency_types = ['1' => 'Fiat', '2' => 'Crypto'];
        $currencies = config('currency');
        $referral_types = ['1' => 'Level Base', '2' => 'Target Base'];
        $timezones = config('timezones');
        $home_redirects = [
            'home' => 'Home Page',
            'about' => 'About Us'
        ];

        if (!$globalSetting) {
            return view('global_settings.create', compact('globalSetting', 'currencies', 'site_currency_types', 'referral_types', 'timezones', 'home_redirects'));
        } else {
            $permissionSetting = PermissionSetting::findOrFail($default_id);

            return view('global_settings.edit', compact('globalSetting', 'currencies', 'site_currency_types', 'referral_types', 'timezones', 'home_redirects', 'permissionSetting'));
        }
    }

    /**
     * Show the form for creating a new global setting.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {

        return view('global_settings.create');
    }

    /**
     * Store a new global setting in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {

        $data = $this->getData($request);

        GlobalSetting::create($data);

        return redirect()->route('site_settings-global_settings-index')
            ->with('success_message', 'Global Setting was successfully added.');
    }

    /**
     * Display the specified global setting.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $globalSetting = GlobalSetting::findOrFail($id);

        return view('global_settings.show', compact('globalSetting'));
    }

    /**
     * Show the form for editing the specified global setting.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $globalSetting = GlobalSetting::findOrFail($id);
        $site_currency_types = ['1' => 'Fiat', '2' => 'Crypto'];
        $currencies = config('currency');
        $referral_types = ['1' => 'Level Base', '2' => 'Target Base'];
        $timezones = config('timezones');
        $home_redirects = [
            'home' => 'Home Page',
            'about' => 'About Us'
        ];


        return view('global_settings.edit', compact('globalSetting', 'currencies', 'site_currency_types', 'referral_types', 'timezones', 'home_redirects'));
    }

    /**
     * Update the specified global setting in the storage.
     *
     * @param int $id
     * @param Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function update($id, Request $request)
    {

        $data = $this->getData($request);

        $globalSetting = GlobalSetting::findOrFail($id);
        $globalSetting->update($data);

        return redirect()->back()
            ->with('success_message', 'Global Setting was successfully updated.');
    }

    /**
     * Remove the specified global setting from the storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $globalSetting = GlobalSetting::findOrFail($id);
            $globalSetting->delete();

            return redirect()->route('site_settings-global_settings-index')
                ->with('success_message', 'Global Setting was successfully deleted.');
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
            'site_logo' => ['image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048', 'nullable', 'file'],
            'site_fevicon' => ['image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048', 'nullable', 'file'],
            'admin_login_cover' => ['image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048', 'nullable', 'file'],
            'site_admin_prefix' => 'string|min:1|nullable',
            'site_currency_type' => 'nullable',
            'site_currency' => 'nullable',
            'timezon' => 'nullable',
            'referral_type' => 'nullable',
            'currency_symbol' => 'nullable|string|min:0',
            'referral_code_Limit' => 'nullable|string|min:0',
            'home_redirect' => 'nullable',
            'site_title' => 'nullable|string|min:0',
            'site_email' => 'nullable|string|min:0',
            'support_email' => 'nullable|string|min:0',
        ];

        if ($request->route()->getAction()['as'] == 'site_settings-global_settings-store' || $request->has('custom_delete_site_logo')) {
            array_push($rules['site_logo'], 'required');
        }
        if ($request->route()->getAction()['as'] == 'site_settings-global_settings-store' || $request->has('custom_delete_site_fevicon')) {
            array_push($rules['site_fevicon'], 'required');
        }
        if ($request->route()->getAction()['as'] == 'site_settings-global_settings-store' || $request->has('custom_delete_admin_login_cover')) {
            array_push($rules['admin_login_cover'], 'required');
        }
        $data = $request->validate($rules);

        if ($request->has('custom_delete_site_logo')) {
            $data['site_logo'] = null;
        }
        if ($request->hasFile('site_logo')) {
            $data['site_logo'] = $this->moveFile($request->file('site_logo'));
        }
        if ($request->has('custom_delete_site_fevicon')) {
            $data['site_fevicon'] = null;
        }
        if ($request->hasFile('site_fevicon')) {
            $data['site_fevicon'] = $this->moveFile($request->file('site_fevicon'));
        }
        if ($request->has('custom_delete_admin_login_cover')) {
            $data['admin_login_cover'] = null;
        }
        if ($request->hasFile('admin_login_cover')) {
            $data['admin_login_cover'] = $this->moveFile($request->file('admin_login_cover'));
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
