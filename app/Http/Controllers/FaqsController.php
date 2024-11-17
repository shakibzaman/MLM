<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;
use Exception;

class FaqsController extends Controller
{

    /**
     * Display a listing of the faqs.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $faqs = Faq::paginate(25);

        return view('faqs.index', compact('faqs'));
    }

    /**
     * Show the form for creating a new faq.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {


        return view('faqs.create');
    }

    /**
     * Store a new faq in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {

        $data = $this->getData($request);

        Faq::create($data);

        return redirect()->route('faqs.faq.index')
            ->with('success_message', 'Faq was successfully added.');
    }

    /**
     * Display the specified faq.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $faq = Faq::findOrFail($id);

        return view('faqs.show', compact('faq'));
    }

    /**
     * Show the form for editing the specified faq.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $faq = Faq::findOrFail($id);


        return view('faqs.edit', compact('faq'));
    }

    /**
     * Update the specified faq in the storage.
     *
     * @param int $id
     * @param Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function update($id, Request $request)
    {

        $data = $this->getData($request);

        $faq = Faq::findOrFail($id);
        $faq->update($data);

        return redirect()->route('faqs.faq.index')
            ->with('success_message', 'Faq was successfully updated.');
    }

    /**
     * Remove the specified faq from the storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $faq = Faq::findOrFail($id);
            $faq->delete();

            return redirect()->route('faqs.faq.index')
                ->with('success_message', 'Faq was successfully deleted.');
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

    public function faqs()
    {
      $faqs = Faq::all();

      return view('faqs.faqs', compact('faqs'));
    }

}
