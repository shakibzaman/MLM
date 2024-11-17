<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\SocialLink;
use Illuminate\Http\Request;
use Exception;

class SocialLinksController extends Controller
{

    /**
     * Display a listing of the social links.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $socialLinks = SocialLink::paginate(25);

        return view('social_links.index', compact('socialLinks'));
    }

    /**
     * Show the form for creating a new social link.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        
        
        return view('social_links.create');
    }

    /**
     * Store a new social link in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        
        $data = $this->getData($request);
        
        SocialLink::create($data);

        return redirect()->route('social_links.social_link.index')
            ->with('success_message', 'Social Link was successfully added.');
    }

    /**
     * Display the specified social link.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $socialLink = SocialLink::findOrFail($id);

        return view('social_links.show', compact('socialLink'));
    }

    /**
     * Show the form for editing the specified social link.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $socialLink = SocialLink::findOrFail($id);
        

        return view('social_links.edit', compact('socialLink'));
    }

    /**
     * Update the specified social link in the storage.
     *
     * @param int $id
     * @param Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function update($id, Request $request)
    {
        
        $data = $this->getData($request);
        
        $socialLink = SocialLink::findOrFail($id);
        $socialLink->update($data);

        return redirect()->route('social_links.social_link.index')
            ->with('success_message', 'Social Link was successfully updated.');  
    }

    /**
     * Remove the specified social link from the storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $socialLink = SocialLink::findOrFail($id);
            $socialLink->delete();

            return redirect()->route('social_links.social_link.index')
                ->with('success_message', 'Social Link was successfully deleted.');
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
            'icon' => 'string|min:1|nullable',
            'link' => 'string|min:1|nullable',
            'status' => 'string|min:1|nullable', 
        ];

        
        $data = $request->validate($rules);




        return $data;
    }

}
