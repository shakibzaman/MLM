<?php

namespace App\Http\Controllers\Customer\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EmailVerificationPromptController extends Controller
{
    /**
     * Display the email verification prompt.
     */
//    public function __invoke(Request $request): RedirectResponse|View
//    {
//        return $request->user()->hasVerifiedEmail()
//                    ? redirect()->intended(route('dashboard', absolute: false))
//                    : view('customer.auth.verify-email');
//    }


  public function show(Request $request): View|RedirectResponse
  {
//    dd($request->all());
    // Ensure the user is authenticated with the custom guard
    $customer = $request->user('customer');

    // Redirect to the dashboard if the email is already verified
    if ($customer->hasVerifiedEmail()) {
      return redirect()->intended(route('customer.dashboard'));
    }

    // Display the email verification prompt view
    return view('customer.auth.verify-email');
  }

  /**
   * Verify the user's email address.
   */
  public function verify(Request $request, $id, $hash): RedirectResponse
  {

    $customer = $request->user('customer');

    // Check if the email is already verified
    if ($customer->hasVerifiedEmail()) {
      return redirect()->route('customer.dashboard');
    }

    // Verify the email
    if ($customer->markEmailAsVerified()) {
      event(new \Illuminate\Auth\Events\Verified($customer));
    }

    return redirect()->route('customer.dashboard')->with('verified', true);
  }

  /**
   * Resend the email verification link.
   */
  public function resend(Request $request): RedirectResponse
  {
    $customer = $request->user('customer');

    // Check if the email is already verified
    if ($customer->hasVerifiedEmail()) {
      return redirect()->route('customer.dashboard');
    }

    // Send the email verification notification
    $customer->sendEmailVerificationNotification();

    return back()->with('status', 'verification-link-sent');
  }
}
