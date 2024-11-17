<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Mail\GeneralEmail;
use App\Models\Customer;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
  use ValidatesRequests;
    public function create()
    {
      $customers = Customer::select('id', 'name','email')->get();
      return view('admin.email.create',compact('customers'));
    }

    public function sendEmail(Request $request)
    {
      $this->validate($request,[
        'subject' => 'required',
        'email_body' => 'required',
        'user_group' => 'required',
      ]);
      switch ($request->user_group)
      {
        case 1:
          // Send Email to All Users
          $users = Customer::pluck('email')->toArray();
          break;
        case 2:
          // Send Email to Single User
          if ($request->user_email){
            $users = $request->user_email;
          }else{
            return redirect()->back()->withErrors('You must select a user to send email');
          }
          break;
        case 3:
          // Send Email to Multiple Users
          if ($request->user_emails){
            $users = $request->user_emails;
          }else{
            return redirect()->back()->withErrors('You must select a user to send email');
          }
          break;
        case 4:
          // Send Email to All Paid Users
          $users = Customer::whereNotNull('lifetime_package')->pluck('email')->toArray();
          break;
        case 5:
          // Send Email to Monthly Subscribers
          $users = Customer::whereNotNull('monthly_package')->pluck('email')->toArray();
          break;
        case 6:
          // Send Email to Monthly Subscription Inactive
          $users = Customer::where('monthly_package_status', 'inactive')->pluck('email')->toArray();
          break;
        case 7:
          // Send Email to Monthly Unsubscribers
          $users = Customer::whereNull('monthly_package')->pluck('email')->toArray();
          break;
        case 8:
          // Send Email to With Balance
          $users = Customer::where('balance', '>', 0)->pluck('email')->toArray();
          break;
        case 9:
          // Send Email to All Free Users
          $users = Customer::whereNull('lifetime_package')->pluck('email')->toArray();
          break;
        case 10:
          // Send Email to Banned Users
          $users = Customer::whereStatus(3)->pluck('email')->toArray();
          break;
        case 11:
          // Send Email to Email Unverified
          $users = Customer::whereNull('email_verified_at')->pluck('email')->toArray();
          break;
        case 12:
          // Send Email to KYC Unverified
          $users = Customer::with('kyc')->whereHas('kyc', function ($query) {
            $query->where('status', '!=', 2);
          })->pluck('email')->toArray();
          break;
        case 13:
          // Send Email to KYC Pending
          $users = Customer::with('kyc')->whereHas('kyc', function ($query) {
            $query->where('status', 1);
          })->pluck('email')->toArray();
          break;
        case 14:
          // Send Email to KYC Rejected
          $users = Customer::with('kyc')->whereHas('kyc', function ($query) {
            $query->where('status', 3);
          })->pluck('email')->toArray();
          break;
        case 15:
          // Send Email to Number Unverified
          $users = Customer::whereNull('phone_verified_at')->pluck('email')->toArray();
          break;
        default:
          $users = Customer::pluck('email')->toArray();
      }


//      dd($users);
      $to = 'shakilsyead@gmail.com';
      $subject = $request->subject;
      $message = $request->email_body;
      if ($users){
        Mail::to($users)->send(new GeneralEmail($subject,$message));
        return redirect()->back()->with('success', 'Email sent successfully.');
      }
      else{
        return redirect()->back()->withErrors('No user available in this group.');
      }
    }
}
