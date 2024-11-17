<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Customer;
use App\Models\Kyc;
use App\Models\UserSetting;
use App\Models\Withdraw;
use App\Services\CustomerDashboardService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

class ProfileController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            if (Auth::guard('customer')->check()) {
                $customer_id = Auth::user()->id;
            }
        } else {
            return redirect('/login');
        }

        // Retrieve the customer with related subscribers and country
        $customer = Customer::with('subscribers', 'country')->where('id', $customer_id)->first();
        $withdraws = Withdraw::where('customer_id', $customer_id)->where('status', 'approved')->get()->sum('amount');

        // Paginate the activities for the customer
        $activities = $customer->activity()->paginate(20); // Adjust the number as needed
        $dashboardservice = new CustomerDashboardService();

        $commission = $dashboardservice->commissionCalculation();
        // Pass the customer and paginated activities to the view
        return view('customer.profile.profile', compact('customer', 'activities', 'withdraws', 'commission'));
    }

    public function edit()
    {
        $userSetting = UserSetting::where('id', 1)->first();

        if (Auth::check()) {
            if (Auth::guard('customer')->check()) {
                $customer_id = Auth::user()->id;
            }
        } else {
            return redirect('/login');
        }
        $countries = Country::all();
        $customer = Customer::with('subscribers', 'country')->where('id', $customer_id)->first();

        return view('customer.profile.edit-profile', compact('customer', 'countries', 'userSetting'));
    }

    public function update(Request $request)
    {
        try {
            info('Response is ', [$request->all()]);
            logger('Profile Update start');
            // Validate the form data
            $request->validate([
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif', // Validation for profile image
                'member_cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif', // Validation for cover image
                'name' => 'required|string|max:255',
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'phone' => 'required|string|max:15',
                'email' => 'required|email|max:255',
                'country_id' => 'required|integer',
                'city' => 'nullable|string|max:255',
                'zip' => 'nullable|string|max:10',
                'state' => 'nullable|string|max:255',
                'address' => 'nullable|string|max:255',
            ]);

            // Find the customer by ID
            $customer = Customer::findOrFail($request->id);
            info('Customer is ', [$customer]);
            // Handle profile image upload
            if ($request->hasFile('image')) {
                // Delete the old image if it exists
                if ($customer->image && Storage::exists('public/' . $customer->image)) {
                    Storage::delete('public/' . $customer->image);
                }

                // Store the new image
                $imagePath = $request->file('image')->store('customer_images', 'public');
                $customer->image = $imagePath;
            }

            // Handle cover image upload
            if ($request->hasFile('member_cover_image')) {
                // Delete the old cover image if it exists
                if ($customer->member_cover_image && Storage::exists('public/' . $customer->member_cover_image)) {
                    Storage::delete('public/' . $customer->member_cover_image);
                }

                // Store the new cover image
                $coverImagePath = $request->file('member_cover_image')->store('customer_cover_images', 'public');
                $customer->member_cover_image = $coverImagePath;
            }

            // Update the other profile details
            $customer->name = $request->input('name');
            $customer->first_name = $request->input('first_name');
            $customer->last_name = $request->input('last_name');
            $customer->phone = $request->input('phone');
            $customer->email = $request->input('email');
            $customer->country_id = $request->input('country_id');
            $customer->city = $request->input('city');
            $customer->zip = $request->input('zip');
            $customer->state = $request->input('state');
            $customer->address = $request->input('address');

            // Save the updated customer details
            $customer->save();
            info('Customer save', [$customer]);
            // Redirect to the profile page with a success message
            return redirect()->route('user.profile.show')
                ->with('success', 'Profile updated successfully.');
        } catch (Exception $e) {
            info('Exception is ', [$e]);
        }
    }
    public function setting()
    {
        if (Auth::check()) {
            if (Auth::guard('customer')->check()) {
                $customer_id = Auth::user()->id;
            }
        } else {
            return redirect('/login');
        }
        $customer = Customer::with('subscribers', 'country')->where('id', $customer_id)->first();
        return view('customer.profile.settings', compact('customer'));
    }

    public function updatePassword(Request $request)
    {
        // Validate the request data
        $request->validate([
            'password' => 'required|confirmed|min:8', // password_confirmation field must match 'password'
        ]);

        // Fetch the currently authenticated customer
        $customer_id = Auth::guard('customer')->user()->id; // Use the 'customer' guard (if defined)
        $customer = Customer::where('id', $customer_id)->first();
        info('Customer is ', [$customer->password]);

        // Generate verification code
        $verificationCode = Str::random(6);

        // Save the code to the user session or a temporary database field
        $customer->password_reset_code = $verificationCode;
        $customer->temp_new_password = Hash::make($request->password); // Temporarily store the hashed password
        $customer->save();

        // Send email with the code
        Mail::send('emails.password-verification', ['code' => $verificationCode], function ($message) use ($customer) {
            $message->to($customer->email)->subject('Password Change Verification Code');
        });
        return redirect()->route('user.verify.email')->with('success', 'A verification code has been sent to your email.');
        // return back()->with('success', 'A verification code has been sent to your email.');

        // // Check if the current password matches
        // if (Hash::check($request->current_password, $customer->password)) {
        //     return back()->withErrors(['current_password' => 'Current password is incorrect']);
        // }

        // // Update the customer's password
        // $customer->password = Hash::make($request->password);
        // $customer->save();

        // // Optionally, return success message or redirect
        // return redirect()->back()
        //     ->with('success', 'Password updated successfully');
    }

    public function showVerify()
    {
        return view('customer.profile.verify-code');
    }

    // Verify the code and update the password
    public function verifyCode(Request $request)
    {
        $request->validate([
            'verification_code' => 'required',
        ]);

        $customer_id = Auth::guard('customer')->user()->id; // Use the 'customer' guard (if defined)
        $customer = Customer::where('id', $customer_id)->first();

        if ($customer->password_reset_code === $request->verification_code) {
            // Update the password
            $customer->password = $customer->temp_new_password;
            $customer->password_reset_code = null; // Clear the code
            $customer->temp_new_password = null;  // Clear the temporary password
            $customer->save();

            return redirect()->route('user.profile.setting')->with('success', 'Your password has been successfully changed.');
        }

        return back()->withErrors(['verification_code' => 'The verification code is invalid.']);
    }

    public function toggle2FA(Request $request)
    {
        $customer_id = Auth::guard('customer')->user()->id; // Use the 'customer' guard (if defined)
        $customer = Customer::where('id', $customer_id)->first();

        if ($request->has('two_fa_enabled')) {
            // Enable 2FA
            $customer->auth_2fa = 1;
            // Logic to generate and display 2FA setup (QR code, secret, etc.)
        } else {
            // Disable 2FA
            $customer->auth_2fa = 0;
        }

        $customer->save();

        return back()->with('status', '2FA has been ' . ($customer->auth_2fa == 1 ? 'enabled' : 'disabled') . ' successfully.');
    }
    public function referrals()
    {
        $customer_id = Auth::guard('customer')->user()->id; // Use the 'customer' guard (if defined)
        $customer = Customer::with('country')->where('id', $customer_id)->first();
        $subscribers = Customer::where('reference_user', $customer_id)->paginate(10);
        return view('customer.profile.referrals', compact('subscribers', 'customer'));
    }
    public function kyc()
    {
        $customer_id = Auth::guard('customer')->user()->id; // Use the 'customer' guard (if defined)
        $customer = Customer::with('country', 'kyc')->where('id', $customer_id)->first();
        $customer_detail = Auth::guard('customer')->user();
        $documentTypes = config('app.document_types');
        $documentStatuses = config('app.document_statuses');
        // if ($customer_detail) {
        //     $customer_detail->load('kyc');
        //     // return view('kycs.view', compact('customer'));
        // }
        return view('customer.profile.kycs', compact('customer_detail', 'customer', 'documentTypes', 'documentStatuses'));
    }
    public function kycStore(Request $request)
    {

        $data = $this->getData($request);
        Kyc::create($data);

        return redirect()->back()->with('status', 'Kyc was successfully added.');
    }
    protected function getData(Request $request)
    {
        $rules = [
            'document_type' => 'required',
            'document_number' => 'numeric|nullable',
            'image' => ['image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048', 'nullable', 'file'],
        ];
        if ($request->has('status')) {
            $rules['status'] = 'required|string|in:pending,approved,rejected|nullable';
        }

        if ($request->route()->getAction()['as'] == 'customer-kyc-store' || $request->has('custom_delete_image')) {
            array_push($rules['image'], 'required');
        }
        $data = $request->validate($rules);

        if ($request->has('custom_delete_image')) {
            $data['image'] = null;
        }
        if ($request->hasFile('image')) {
            $data['image'] = $this->moveFile($request->file('image'));
        }



        return $data;
    }
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
