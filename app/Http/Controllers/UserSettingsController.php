<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\UserSetting;
use Illuminate\Http\Request;
use Exception;

class UserSettingsController extends Controller
{

    /**
     * Display a listing of the user settings.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $userSetting = UserSetting::where('id', 1)->first();
        if ($userSetting) {
            return view('user_settings.edit', compact('userSetting'));
        } else {
            return view('user_settings.create');
        }
    }

    /**
     * Show the form for creating a new user setting.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {


        return view('user_settings.create');
    }

    /**
     * Store a new user setting in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $data = $this->getData($request);

        UserSetting::create($data);

        return redirect()->route('user_settings.user_setting.index')
            ->with('success_message', 'User Setting was successfully added.');
    }

    /**
     * Display the specified user setting.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $userSetting = UserSetting::findOrFail($id);

        return view('user_settings.show', compact('userSetting'));
    }

    /**
     * Show the form for editing the specified user setting.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $userSetting = UserSetting::findOrFail($id);


        return view('user_settings.edit', compact('userSetting'));
    }

    /**
     * Update the specified user setting in the storage.
     *
     * @param int $id
     * @param Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function update($id, Request $request)
    {

        $data = $this->getData($request);
        $data['password_for_withdraw'] = $data['password_for_withdraw'] ?? 0;
        $data['confirm_code_account_update'] = $data['confirm_code_account_update'] ?? 0;
        $data['notify_status'] = $data['notify_status'] ?? 0;
        $data['password_for_edit_profile'] = $data['password_for_edit_profile'] ?? 0;
        $data['email_change_status'] = $data['email_change_status'] ?? 0;

        $userSetting = UserSetting::findOrFail($id);
        $userSetting->update($data);

        return redirect()->route('user_settings.user_setting.index')
            ->with('success_message', 'User Setting was successfully updated.');
    }

    /**
     * Remove the specified user setting from the storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $userSetting = UserSetting::findOrFail($id);
            $userSetting->delete();

            return redirect()->route('user_settings.user_setting.index')
                ->with('success_message', 'User Setting was successfully deleted.');
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
            'min_password_length' => 'nullable|string|min:0',
            'max_password_length' => 'nullable|string|min:0',
            'password_for_withdraw' => 'nullable',
            'confirm_code_account_update' => 'numeric|nullable',
            'notify_status' => 'string|min:1|nullable',
            'subscription_type' => 'string|min:1|nullable',
            'password_for_edit_profile' => 'nullable',
            'email_change_status' => 'nullable',
            'subscription_status' => 'string|min:1|nullable',
            'subscription_grace_period' => 'string|min:1|nullable',
        ];
        // if ($request->has('password_for_withdraw')) {
        //     $data['password_for_withdraw'] = 0;
        // } else {
        //     $data['password_for_withdraw'] = $request->input('password_for_withdraw', 0);

        //     // $data['password_for_withdraw'] = $request->has('password_for_withdraw') ? 1 : 0;
        // }
        $data['password_for_withdraw'] = $request->password_for_withdraw;
        $data['confirm_code_account_update'] = $request->has('confirm_code_account_update') ? 1 : 0;
        $data['notify_status'] = $request->has('notify_status') ? 1 : 0;
        $data['password_for_edit_profile'] = $request->has('password_for_edit_profile') ? 1 : 0;
        $data['email_change_status'] = $request->has('email_change_status') ? 1 : 0;
        $data['subscription_status'] = $request->has('subscription_status') ? 1 : 0;
        $data['subscription_grace_period'] = $request->has('subscription_grace_period') ? 1 : 0;
        $data = $request->validate($rules);




        return $data;
    }
}
