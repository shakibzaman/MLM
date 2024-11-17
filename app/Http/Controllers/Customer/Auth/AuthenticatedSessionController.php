<?php

namespace App\Http\Controllers\Customer\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\CustomerLoginRequest;
use App\Http\Requests\Auth\LoginRequest;
use App\Mail\AuthenticatiinEmail;
use App\Models\GlobalSetting;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Nette\Utils\Random;

class AuthenticatedSessionController extends Controller
{
  /**
   * Display the login view.
   */
  public function create(): View
  {
    $globalSettings = GlobalSetting::where('id', 1)->first();
    $pageConfigs = ['myLayout' => 'blank'];
    return view('customer.auth.login', ['pageConfigs' => $pageConfigs, 'globalSettings' => $globalSettings]);
  }
  public function forgetPassword()
  {
    $pageConfigs = ['myLayout' => 'blank'];
    return view('customer.auth.forgot-password', ['pageConfigs' => $pageConfigs]);
  }

  /**
   * Handle an incoming authentication request.
   * @param CustomerLoginRequest $request
   * @return
   * @throws \Illuminate\Validation\ValidationException
   */
  public function store(CustomerLoginRequest $request)
  {
    info('Login Response', [$request]);
    logger('Customer login started');
    $request->authenticate();
    logger('Customer Login');
    Auth::guard('customer')->login(Auth::guard('customer')->user(), true);
    $request->session()->regenerate();
    logger('Customer Login 2');

    // $request->session()->regenerate();
    $customer = Auth::guard('customer')->user();
    if ($customer->status != 1) {
      Auth::guard('customer')->logout(); // Log out if status is not active
      return redirect()->route('user.login')->withErrors(['status' => 'Your account is no active. Please contact support.']);
    }
    logger('Customer Login 3');

    $user = User::where('id', $customer->user_id)->first();
    logger('Customer Login 4');

    Session::put('locale', $user->locale);
    App::setLocale($user->locale);
    logger('Customer Login 5');

    if (Auth::guard('customer')->user()->auth_2fa) {
      logger('Customer Login 6');

      $code = str()->random(6);
      $currentDateTime = date('Y-m-d H:i:s');
      $expire_at = date('Y-m-d H:i:s', strtotime('+15 minutes', strtotime($currentDateTime)));
      $data = [
        'two_factor_code' => $code,
        'two_factor_code_expire_at' => $expire_at
      ];
      logger('Customer Login 7');

      Mail::to($customer->email)->send(new AuthenticatiinEmail($code));
      logger('Customer Login 8');
    }
    $data['ip_address'] = request()->ip();
    $customer->update($data);
    logger('Customer Login 9');

    return redirect()->intended(route('customer.dashboard', absolute: false));
  }

  public function checkEmail(Request $request)
  {
    $email = $request->email;

    // Check if email already exists in your database
    $exists = User::where('email', $email)->exists();

    // Return appropriate JSON response for validation
    if ($exists) {
      return response()->json(['valid' => false], 200);
    } else {
      return response()->json(['valid' => true], 200);
    }
  }
  public function checkUserName(Request $request)
  {
    $username = $request->username;

    // Check if email already exists in your database
    $exists = User::where('username', $username)->exists();

    // Return appropriate JSON response for validation
    if ($exists) {
      return response()->json(['valid' => false], 200);
    } else {
      return response()->json(['valid' => true], 200);
    }
  }

  /**
   * Destroy an authenticated session.
   */
  public function destroy(Request $request): RedirectResponse
  {
    //        dd($request->all());
    Auth::guard('customer')->logout();
    $request->session()->invalidate();

    $request->session()->regenerateToken();

    return redirect('/login');
  }
}
