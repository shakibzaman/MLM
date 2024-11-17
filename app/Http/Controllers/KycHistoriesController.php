<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Kyc;
use App\Models\KycHistory;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;

class KycHistoriesController extends Controller
{

    /**
     * Display a listing of the kyc histories.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $kycHistories = KycHistory::with('customer', 'kyc', 'creator')->paginate(25);

        return view('kyc_histories.index', compact('kycHistories'));
    }

    /**
     * Show the form for creating a new kyc history.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $customers = Customer::pluck('name', 'id')->all();
        $kycs = Kyc::pluck('created_at', 'id')->all();
        $creators = User::pluck('name', 'id')->all();

        return view('kyc_histories.create', compact('customers', 'kycs', 'creators'));
    }

    /**
     * Store a new kyc history in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {

        $data = $this->getData($request);
        $data['created_by'] = Auth::Id();
        KycHistory::create($data);

        return redirect()->route('kyc_histories.kyc_history.index')
            ->with('success_message', 'Kyc History was successfully added.');
    }

    /**
     * Display the specified kyc history.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $kycHistory = KycHistory::with('customer', 'kyc', 'creator')->findOrFail($id);

        return view('kyc_histories.show', compact('kycHistory'));
    }

    /**
     * Show the form for editing the specified kyc history.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $kycHistory = KycHistory::findOrFail($id);
        $customers = Customer::pluck('name', 'id')->all();
        $kycs = Kyc::pluck('created_at', 'id')->all();
        $creators = User::pluck('name', 'id')->all();

        return view('kyc_histories.edit', compact('kycHistory', 'customers', 'kycs', 'creators'));
    }

    /**
     * Update the specified kyc history in the storage.
     *
     * @param int $id
     * @param Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function update($id, Request $request)
    {

        $data = $this->getData($request);

        $kycHistory = KycHistory::findOrFail($id);
        $kycHistory->update($data);

        return redirect()->route('kyc_histories.kyc_history.index')
            ->with('success_message', 'Kyc History was successfully updated.');
    }

    /**
     * Remove the specified kyc history from the storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $kycHistory = KycHistory::findOrFail($id);
            $kycHistory->delete();

            return redirect()->route('kyc_histories.kyc_history.index')
                ->with('success_message', 'Kyc History was successfully deleted.');
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
            'customer_id' => 'nullable',
            'kyc_id' => 'nullable',
            'status' => 'string|min:1|nullable',
            'created_by' => 'nullable',
        ];


        $data = $request->validate($rules);




        return $data;
    }
}
