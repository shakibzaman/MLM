<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\SeoTool;
use Illuminate\Http\Request;
use Exception;

class SeoToolsController extends Controller
{

    /**
     * Display a listing of the seo tools.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $seoTool = SeoTool::where('id', 1)->first();
        if ($seoTool) {
            return view('seo_tools.edit', compact('seoTool'));
        } else {
            return view('seo_tools.create');
        }
    }

    /**
     * Show the form for creating a new seo tool.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {


        return view('seo_tools.create');
    }

    /**
     * Store a new seo tool in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {

        $data = $this->getData($request);

        SeoTool::create($data);

        return redirect()->route('seo_tools.seo_tool.index')
            ->with('success_message', 'Seo Tool was successfully added.');
    }

    /**
     * Display the specified seo tool.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $seoTool = SeoTool::findOrFail($id);

        return view('seo_tools.show', compact('seoTool'));
    }

    /**
     * Show the form for editing the specified seo tool.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $seoTool = SeoTool::findOrFail($id);


        return view('seo_tools.edit', compact('seoTool'));
    }

    /**
     * Update the specified seo tool in the storage.
     *
     * @param int $id
     * @param Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function update($id, Request $request)
    {

        $data = $this->getData($request);

        $seoTool = SeoTool::findOrFail($id);
        $seoTool->update($data);

        return redirect()->route('seo_tools.seo_tool.index')
            ->with('success_message', 'Seo Tool was successfully updated.');
    }

    /**
     * Remove the specified seo tool from the storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $seoTool = SeoTool::findOrFail($id);
            $seoTool->delete();

            return redirect()->route('seo_tools.seo_tool.index')
                ->with('success_message', 'Seo Tool was successfully deleted.');
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
            'google_analytics' => 'string|min:1|nullable',
            'meta_tags' => 'string|min:1|nullable',
        ];


        $data = $request->validate($rules);




        return $data;
    }
}
