<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ApplyCoupon;
use App\Models\Coupon;
use App\Models\Customer;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class CouponsController extends Controller
{

    /**
     * Display a listing of the coupons.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $coupons = Coupon::paginate(25);

        return view('coupons.index', compact('coupons'));
    }

    /**
     * Show the form for creating a new coupon.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {


        return view('coupons.create');
    }

    /**
     * Store a new coupon in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {

        $data = $this->getData($request);

        Coupon::create($data);

        return redirect()->route('coupons.coupon.index')
            ->with('success_message', 'Coupon was successfully added.');
    }

    /**
     * Display the specified coupon.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $coupon = Coupon::findOrFail($id);

        return view('coupons.show', compact('coupon'));
    }

    /**
     * Show the form for editing the specified coupon.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $coupon = Coupon::findOrFail($id);


        return view('coupons.edit', compact('coupon'));
    }

    /**
     * Update the specified coupon in the storage.
     *
     * @param int $id
     * @param Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function update($id, Request $request)
    {

        $data = $this->getData($request);

        $coupon = Coupon::findOrFail($id);
        $coupon->update($data);

        return redirect()->route('coupons.coupon.index')
            ->with('success_message', 'Coupon was successfully updated.');
    }

    /**
     * Remove the specified coupon from the storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $coupon = Coupon::findOrFail($id);
            $coupon->delete();

            return redirect()->route('coupons.coupon.index')
                ->with('success_message', 'Coupon was successfully deleted.');
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
            'name' => 'required|string|min:1|max:255',
            'code' => 'required|regex:/^[A-Z0-9]{2,20}$/|unique:coupons,code',
            'validate_date' => 'required',
            'validate_user_limit' => 'string|min:1|nullable',
            'point_amount' => 'required|string|min:1',
            'is_active' => 'required| boolean',
        ];


        $data = $request->validate($rules);


        $data['is_active'] = $request->has('is_active');


        return $data;
    }

    public function userCoupon()
    {
        $customer = Auth::guard('customer')->user();
        $coupons = ApplyCoupon::with('coupon')->where('customer_id', $customer->id)->paginate(20);
        return view('customer.coupons.index', compact('customer', 'coupons'));
    }

    public function applyCoupon(Request $request)
    {
        $customer = Auth::guard('customer')->user();

        $code = strtoupper($request->code);
        info('Today', [Carbon::today()]);
        $checkCoupon = Coupon::where('code', $code)->whereDate('validate_date', '>=', Carbon::today())->first();
        if (!$checkCoupon){
           return redirect()->back()->withErrors('Invalid Coupon Code');
        }
        $applyCouponQuery = ApplyCoupon::where('coupon_id', $checkCoupon->id);
        $checkAlreadyApplied = $applyCouponQuery->where('customer_id', $customer->id)->first();
        if ($checkAlreadyApplied) {
            return redirect()->back()->with('error', 'Aplready Applied Coupon');
        }
        if ($checkCoupon->validate_user_limit != null) {
            $applyCouponCount = $applyCouponQuery->where('status', 2)->get()->count();
            if ($applyCouponCount > $checkCoupon->validate_user_limit) {
                return redirect()->back()->with('error', 'Sorry Invalid Coupon');
            }
        }
        info('checkCoupon', [$checkCoupon]);
        if (!$checkCoupon) {
            return redirect()->back()->with('error', 'Sorry Invalid Coupon');
        }

        ApplyCoupon::create([
            'customer_id' => $customer->id,
            'coupon_id' => $checkCoupon->id,
            'coupon_point' => $checkCoupon->point_amount,
            'status' => 1,
        ]);

        return redirect()->back()->with('success', 'Applied Coupon Successfully');
    }
    public function appliedCouponList($type = null)
    {
        $statusLabels = config('app.statuses');

        $statusType = $statusLabels[strtolower($type)] ?? null;
        $coupon_query = ApplyCoupon::with('coupon');
        if ($statusType != null) {
            $coupon_list = $coupon_query->where('status', $statusType)->paginate(20);
        } else {
            $coupon_list = $coupon_query->paginate(20);
        }
        return view('coupons.apply_coupon.index', compact('coupon_list', 'type'));
    }

    public function applyCouponShow($id)
    {
        $coupon = ApplyCoupon::with('customer', 'coupon')->where('id', $id)->first();
        return view('coupons.apply_coupon.modal.view', compact('coupon'));
    }

    public function appliedCouponUpdate(Request $request, $id)
    {
        try {
            $applyCoupon = ApplyCoupon::with('coupon')->where('id', $id)->first();
            info('Reward ', [$applyCoupon]);

            $applyCoupon->status = $request->status;
            $applyCoupon->status_change_by = Auth::user()->id;
            $applyCoupon->status_change_date = now();
            $update_apply_coupon = $applyCoupon->save();


            if ($update_apply_coupon) {
                if ($request->status == config('app.statuses.approved')) {
                    $customer = Customer::where('id', $applyCoupon->customer_id)->first();
                    if ($customer) {
                        $customer->reward_point += $applyCoupon->coupon->point_amount;
                        $customer->save();
                    }
                }
            }
            return redirect()->back()->with('success', 'Status Changed successful.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Sorry Reward point added failed.');
        }
    }
}
