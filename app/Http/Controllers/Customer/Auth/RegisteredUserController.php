<?php

namespace App\Http\Controllers\Customer\Auth;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Customer;
use App\Models\GlobalSetting;
use App\Models\User;
use App\Models\UserSetting;
use App\Rules\UniqueEmailAcrossTables;
use Exception;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;

class RegisteredUserController extends Controller
{
    use ValidatesRequests;
    /**
     * Display the registration view.
     */
    public function create()
    {
        $userSettings = UserSetting::where('id', 1)->first();
        $minLength = $userSettings->min_password_length ?? 8;
        $maxLength = $userSettings->max_password_length ?? 15;
        $pageConfigs = ['myLayout' => 'blank'];
        $countries = Country::where('is_active', 1)->get();
        $globalSettings = GlobalSetting::where('id', 1)->first();


        return view('customer.auth.register', compact('pageConfigs', 'countries', 'globalSettings', 'minLength', 'maxLength'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        // Decrypt part


        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'ref' => ['required'],
            'phone' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', new UniqueEmailAcrossTables],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
        //        $decryptedString = Crypt::decrypt($request->ref);
        //        $originalData = substr($decryptedString, 4); // Extract the original data
        DB::beginTransaction();
        try {
            $user = User::create([
                'name' => $request->name,
                'phone' => $request->phone,
                'email' => $request->email,
                'password' => Hash::make(':Gkmo@Hl9FJmo@Hl9FJu(G'),
                'status' => 1,
                'type' => 2, // Type 2 is for customer
                'avatar' => 'https://avatar.iran.liara.run/public'
            ]);
            info('User reguster is ', [$user]);

            do {
              $uniqueId = str_pad(random_int(0, 99999999), 8, '0', STR_PAD_LEFT);
            } while (Customer::where('unique_id', $uniqueId)->exists());


            $customer = Customer::create([
                'name' => $request->name,
                'phone' => $request->phone,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'user_id' => $user->id,
                'status' => 1,
                'reference_user' => 1,
                'unique_id' => $uniqueId
            ]);

            info('User ', [$customer]);
            event(new Registered($customer));
            // New Email is send to Customer
            Auth::guard('customer')->login($customer); // Login with user table data
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            info('Exception: ' . $e->getMessage());
            return redirect()->back();
        }


        return redirect(route('customer.dashboard', absolute: false));
    }
    public function checkEmail(Request $request)
    {
        $exists = User::where('email', $request->email)->exists();

        return response()->json([
            'valid' => !$exists,
        ]);
    }
    public function memberStore(Request $request)
    {
        $request->validate([
            'multiStepsUsername' => ['required', 'string', 'max:255', 'unique:users,username'],
            'phone' => ['required', 'string', 'max:255'],
            'multiStepsEmail' => ['required', 'string', 'lowercase', 'email', 'unique:users,email', 'max:255', new UniqueEmailAcrossTables],
            // 'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
        //        $decryptedString = Crypt::decrypt($request->ref);
        //        $originalData = substr($decryptedString, 4); // Extract the original data
        $req_ref  = $request->ref;
        if ($req_ref == null) {
            $reference_user = 1;
        } else {
            $customer = Customer::where('name', $req_ref)->first();
            if ($customer) {
                $reference_user = $customer->id;
            } else {
                $reference_user = 1;
            }
        }
        DB::beginTransaction();
        try {
            $user = User::create([
                'username' => $request->multiStepsUsername,
                'phone' => $request->phone,
                'email' => $request->multiStepsEmail,
                'password' => Hash::make(':Gkmo@Hl9FJmo@Hl9FJu(G'),
                'status' => 1,
                'type' => 2, // Type 2 is for customer
                'avatar' => 'https://avatar.iran.liara.run/public'
            ]);
            info('User reguster is ', [$user]);
            $customer = Customer::create([
                'name' => $request->multiStepsUsername,
                'first_name' => $request->multiStepsFirstName,
                'last_name' => $request->last_name,
                'country_id' => $request->country_id,
                'init_lifetime_package' => $request->lifetime_package,
                'phone' => $request->phone,
                'email' => $request->multiStepsEmail,
                'password' => Hash::make($request->multiStepsConfirmPass),
                'user_id' => $user->id,
                'state' => $request->state,
                'city' => $request->city,
                'zip' => $request->zip,
                'address' => $request->multiStepsAddress,
                'status' => 1,
                'reference_user' => $reference_user,
                'ip_address' => $request->ip(),
            ]);

            info('User ', [$customer]);
            event(new Registered($customer));
            // New Email is send to Customer
            Auth::guard('customer')->login($customer); // Login with user table data
            DB::commit();
            return ['status' => 200, 'message' => 'Member Login Success'];
        } catch (Exception $e) {
            DB::rollBack();
            info('Exception: ' . $e->getMessage());
            return redirect()->back();
        }


        return redirect(route('customer.dashboard', absolute: false));
    }
}
