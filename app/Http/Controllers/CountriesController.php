<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Http\Request;
use Exception;

class CountriesController extends Controller
{

    /**
     * Display a listing of the countries.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $countries = Country::paginate(25);

        return view('countries.index', compact('countries'));
    }

    /**
     * Show the form for creating a new country.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {


        return view('countries.create');
    }

    /**
     * Store a new country in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {

        $data = $this->getData($request);

        Country::create($data);

        return redirect()->route('countries.country.index')
            ->with('success_message', 'Country was successfully added.');
    }

    /**
     * Display the specified country.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $country = Country::findOrFail($id);

        return view('countries.show', compact('country'));
    }

    /**
     * Show the form for editing the specified country.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $country = Country::findOrFail($id);


        return view('countries.edit', compact('country'));
    }

    /**
     * Update the specified country in the storage.
     *
     * @param int $id
     * @param Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function update($id, Request $request)
    {

        $data = $this->getData($request);

        $country = Country::findOrFail($id);
        $country->update($data);

        return redirect()->route('countries.country.index')
            ->with('success_message', 'Country was successfully updated.');
    }

    /**
     * Remove the specified country from the storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $country = Country::findOrFail($id);
            $country->delete();

            return redirect()->route('countries.country.index')
                ->with('success_message', 'Country was successfully deleted.');
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
            'short_code' => 'string|min:1|nullable',
            'flag' => ['min:1','nullable','file'],
            'is_active' => 'boolean|nullable',
        ];


        $data = $request->validate($rules);

        if ($request->has('custom_delete_flag')) {
            $data['flag'] = null;
        }
        if ($request->hasFile('flag')) {
            $data['flag'] = $this->moveFile($request->file('flag'));
        }

        $data['is_active'] = $request->has('is_active');


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
