<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Coopon;
use Illuminate\Http\Request;
use Exception;

class CooponsController extends Controller
{

    /**
     * Display a listing of the coopons.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $coopons = Coopon::paginate(25);

        return view('coopons.index', compact('coopons'));
    }

    /**
     * Show the form for creating a new coopon.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {


        return view('coopons.create');
    }

    /**
     * Store a new coopon in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {

        $data = $this->getData($request);
//        dd($data);
        Coopon::create($data);

        return redirect()->route('coopons.coopon.index')
            ->with('success_message', 'Coopon was successfully added.');
    }

    /**
     * Display the specified coopon.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $coopon = Coopon::findOrFail($id);

        return view('coopons.show', compact('coopon'));
    }

    /**
     * Show the form for editing the specified coopon.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $coopon = Coopon::findOrFail($id);


        return view('coopons.edit', compact('coopon'));
    }

    /**
     * Update the specified coopon in the storage.
     *
     * @param int $id
     * @param Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function update($id, Request $request)
    {

        $data = $this->getData($request);

        $coopon = Coopon::findOrFail($id);
        $coopon->update($data);

        return redirect()->route('coopons.coopon.index')
            ->with('success_message', 'Coopon was successfully updated.');
    }

    /**
     * Remove the specified coopon from the storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $coopon = Coopon::findOrFail($id);
            $coopon->delete();

            return redirect()->route('coopons.coopon.index')
                ->with('success_message', 'Coopon was successfully deleted.');
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
                'coopon' => 'string|min:1|nullable',
            'expire_date' => 'required|date',
            'is_active' => 'boolean|nullable',
        ];


        $data = $request->validate($rules);


        $data['is_active'] = $request->has('is_active');


        return $data;
    }

}
