<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Notice;
use Illuminate\Http\Request;
use Exception;

class NoticesController extends Controller
{

    /**
     * Display a listing of the notices.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $notices = Notice::paginate(25);

        return view('notices.index', compact('notices'));
    }

    /**
     * Show the form for creating a new notice.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        
        
        return view('notices.create');
    }

    /**
     * Store a new notice in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        
        $data = $this->getData($request);
        
        Notice::create($data);

        return redirect()->route('notices.notice.index')
            ->with('success_message', 'Notice was successfully added.');
    }

    /**
     * Display the specified notice.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $notice = Notice::findOrFail($id);

        return view('notices.show', compact('notice'));
    }

    /**
     * Show the form for editing the specified notice.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $notice = Notice::findOrFail($id);
        

        return view('notices.edit', compact('notice'));
    }

    /**
     * Update the specified notice in the storage.
     *
     * @param int $id
     * @param Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function update($id, Request $request)
    {
        
        $data = $this->getData($request);
        
        $notice = Notice::findOrFail($id);
        $notice->update($data);

        return redirect()->route('notices.notice.index')
            ->with('success_message', 'Notice was successfully updated.');  
    }

    /**
     * Remove the specified notice from the storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $notice = Notice::findOrFail($id);
            $notice->delete();

            return redirect()->route('notices.notice.index')
                ->with('success_message', 'Notice was successfully deleted.');
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
                'title' => 'string|min:1|max:255|nullable',
            'description' => 'string|min:1|max:1000|nullable',
            'is_active' => 'boolean|nullable', 
        ];

        
        $data = $request->validate($rules);


        $data['is_active'] = $request->has('is_active');


        return $data;
    }

}
