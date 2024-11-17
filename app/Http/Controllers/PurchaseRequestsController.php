<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\PurchaseRequest;
use App\Models\User;
use App\Services\EnrollmentService;
use Illuminate\Http\Request;
use Exception;

class PurchaseRequestsController extends Controller
{

    /**
     * Display a listing of the purchase requests.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $purchaseRequests = PurchaseRequest::with('user','purchasable')->orderBy('id','desc')->paginate(25);

        return view('purchase_requests.index', compact('purchaseRequests'));
    }

    /**
     * Show the form for creating a new purchase request.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $users = User::pluck('username','id')->all();

        return view('purchase_requests.create', compact('users'));
    }

    /**
     * Store a new purchase request in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {

        $data = $this->getData($request);

        PurchaseRequest::create($data);

        return redirect()->route('purchase_requests.purchase_request.index')
            ->with('success_message', 'Purchase Request was successfully added.');
    }

    /**
     * Display the specified purchase request.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $purchaseRequest = PurchaseRequest::with('user')->findOrFail($id);

        return view('purchase_requests.show', compact('purchaseRequest'));
    }

    /**
     * Show the form for editing the specified purchase request.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $purchaseRequest = PurchaseRequest::findOrFail($id);
        $users = User::pluck('username','id')->all();

        return view('purchase_requests.edit', compact('purchaseRequest','users'));
    }

    /**
     * Update the specified purchase request in the storage.
     *
     * @param int $id
     * @param Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function update($id, Request $request)
    {

        $data = $this->getData($request);

        $purchaseRequest = PurchaseRequest::findOrFail($id);
        $purchaseRequest->update($data);

        return redirect()->route('purchase_requests.purchase_request.index')
            ->with('success_message', 'Purchase Request was successfully updated.');
    }

    /**
     * Remove the specified purchase request from the storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $purchaseRequest = PurchaseRequest::findOrFail($id);
            $purchaseRequest->delete();

            return redirect()->route('purchase_requests.purchase_request.index')
                ->with('success_message', 'Purchase Request was successfully deleted.');
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
                'request_type' => 'string|min:1|nullable',
            'user_id' => 'nullable',
            'status' => 'string|min:1|nullable',
        ];


        $data = $request->validate($rules);




        return $data;
    }


    public function approve($id)
    {
       $purchaseRequest = PurchaseRequest::findOrFail($id);
       $customer = Customer::find($purchaseRequest->user_id);
       $enroll = new EnrollmentService();

       if ($purchaseRequest->request_type == 1)
       {
         $customer->update([
           'lifetime_package' => $purchaseRequest->purchasable_id,
           'monthly_package' => null,
           'monthly_package_enrolled_at' => null,
           'monthly_package_status' => 'inactive',
           'enroll_date' => date('Y-m-d')
          ]);

         $enroll->commissionCalculator($customer, $purchaseRequest->purchasable_id);
       }
       else{
         $customer->update([
           'monthly_package' => $purchaseRequest->purchasable_id,
           'monthly_package_enrolled_at' => date('Y-m-d'),
           'monthly_package_status' => 'active'
          ]);

         $enroll->monthlyCommissionCalculator($customer, $purchaseRequest->purchasable_id);
       }
       $purchaseRequest->status = 'approved';
       $purchaseRequest->save();

       $purchaseRequest->transactions()->update([
         'status' => 'completed'
       ]);

       return redirect()->route('purchase_requests.purchase_request.index')
           ->with('success', 'Purchase Request was successfully approved.');
    }

  public function reject($id)
  {
    $purchaseRequest = PurchaseRequest::findOrFail($id);
    $purchaseRequest->status = 'rejected';
    $purchaseRequest->save();

    return redirect()->route('purchase_requests.purchase_request.index')
      ->with('success_message', 'Purchase Request was successfully approved.');
  }

}
