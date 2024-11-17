<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\FbPage;
use App\Models\GoogleAnalytic;
use App\Models\PluginSetting;
use App\Models\PusherApp;
use App\Models\TawkProperty;
use App\Models\TawkWidget;
use Illuminate\Http\Request;
use Exception;

class PluginSettingsController extends Controller
{

    /**
     * Display a listing of the plugin settings.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $pluginSettings = PluginSetting::where('id', '!=', 5)->get();

        return view('plugin_settings.index', compact('pluginSettings'));
    }
    public function notificationSetting()
    {
        $pluginSettings = PluginSetting::where('id', 5)->get();

        return view('plugin_settings.notification_setting', compact('pluginSettings'));
    }

    /**
     * Show the form for creating a new plugin setting.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $tawkProperties = TawkProperty::pluck('id', 'id')->all();
        $tawkWidgets = TawkWidget::pluck('id', 'id')->all();
        $googleAnalytics = GoogleAnalytic::pluck('id', 'id')->all();
        $fbPages = FbPage::pluck('id', 'id')->all();
        $pusherApps = PusherApp::pluck('id', 'id')->all();

        return view('plugin_settings.create', compact('tawkProperties', 'tawkWidgets', 'googleAnalytics', 'fbPages', 'pusherApps'));
    }

    /**
     * Store a new plugin setting in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {

        $data = $this->getData($request);

        PluginSetting::create($data);

        return redirect()->route('plugin_settings.plugin_setting.index')
            ->with('success_message', 'Plugin Setting was successfully added.');
    }

    /**
     * Display the specified plugin setting.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $pluginSetting = PluginSetting::with('tawkproperty', 'tawkwidget', 'googleanalytic', 'fbpage', 'pusherapp')->findOrFail($id);

        return view('plugin_settings.show', compact('pluginSetting'));
    }

    /**
     * Show the form for editing the specified plugin setting.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $pluginSetting = PluginSetting::where('id', $id)->first();
        if ($id == 1) {
            return view('plugin_settings.modal.tawk', compact('pluginSetting'));
        }
        if ($id == 2) {
            return view('plugin_settings.modal.google_recaptcha', compact('pluginSetting'));
        }
        if ($id == 3) {
            return view('plugin_settings.modal.google_analytics', compact('pluginSetting'));
        }
        if ($id == 4) {
            return view('plugin_settings.modal.messanger', compact('pluginSetting'));
        }
        if ($id == 5) {
            return view('plugin_settings.modal.pusher', compact('pluginSetting'));
        }

        return view('plugin_settings.edit', compact('pluginSetting', 'tawkProperties', 'tawkWidgets', 'googleAnalytics', 'fbPages', 'pusherApps'));
    }

    /**
     * Update the specified plugin setting in the storage.
     *
     * @param int $id
     * @param Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function update($id, Request $request)
    {

        $data = $this->getData($request);

        $pluginSetting = PluginSetting::findOrFail($id);
        $pluginSetting->update($data);

        return redirect()->route('plugin_settings.plugin_setting.index')
            ->with('success_message', 'Plugin Setting was successfully updated.');
    }

    /**
     * Remove the specified plugin setting from the storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $pluginSetting = PluginSetting::findOrFail($id);
            $pluginSetting->delete();

            return redirect()->route('plugin_settings.plugin_setting.index')
                ->with('success_message', 'Plugin Setting was successfully deleted.');
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
            'status' => 'string|min:1|nullable',
            'tawk_property_id' => 'nullable',
            'tawk_widget_id' => 'nullable',
            'google_recaptcha_key' => 'nullable',
            'google_recaptcha_secret' => 'nullable',
            'google_analytics_id' => 'nullable',
            'fb_page_id' => 'nullable',
            'pusher_app_id' => 'nullable',
            'pusher_app_key' => 'nullable',
            'pusher_secret' => 'nullable',
            'pusher_cluster' => 'nullable',
        ];


        $data = $request->validate($rules);




        return $data;
    }
}
