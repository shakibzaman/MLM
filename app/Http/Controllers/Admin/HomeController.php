<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Deposit;
use App\Models\MembershipLog;
use App\Models\SubscriptionLog;
use App\Models\SupportTicket;
use App\Models\UserAgent;
use App\Models\Withdraw;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class HomeController extends Controller
{
    public function index()
    {
        $pendingDeposit = Deposit::where('status', config('app.statuses.pending'))->get();
        $pendingDepositCount = $pendingDeposit->count();

        $pendingWithdraw = Withdraw::where('status', 'pending')->get();
        $pendingWithdrawCount = $pendingWithdraw->count();

        $openSupportTicket = SupportTicket::where('status', 'open')->get();
        $openSupportTicketCount = $openSupportTicket->count();

        $customers = Customer::all();
        $allCustomerCount = $customers->count();

        $activeCustomerCount = $customers->whereNotNull('lifetime_package')->count();
        $monthlyActiveCustomerCount = $customers->where('monthly_package_status', '!=', 'inactive')->count();

        $freeCustomerCount = $customers->whereNull('lifetime_package')->count();

        $totalDeposits = Deposit::all();
        $totalDepositAmount = $totalDeposits->where('status', '!=', 3)->sum('amount');
        $totalPendingDepositAmount = $totalDeposits->where('status', '=', 1)->sum('amount');
        $totalWithdraw = Withdraw::all();
        $totalWithdrawAmount = $totalWithdraw->where('status', '!=', 'rejected')->sum('amount');
        $totalPendingWithdrawAmount = $totalWithdraw->where('status', '=', 'pending')->sum('amount');
        $totalDirectUser = $customers->where('reference_user', 1)->count();
        $totalReferralUser =  $customers->pluck('reference_user')->unique()->count();
        $memberships =  MembershipLog::with('package')
            ->get() // Retrieve the records
            ->groupBy(function ($log) {
                return $log->package->name; // Group by the 'name' of the related 'package'
            })
            ->map(function ($group) {
                return $group->count(); // Count the number of logs for each group
            });
        $subscriptions = SubscriptionLog::select('customer_id', DB::raw('count(*) as total_subscriptions'))
            ->groupBy('customer_id');
        $customerCount6MonthActive = $subscriptions->having('total_subscriptions', '>=', 6)
            ->count();

        $customerCount1YearActive = $subscriptions->having('total_subscriptions', '>=', 12)
            ->count();

        $browsers = UserAgent::select('browser', \DB::raw('count(*) as total'))
            ->groupBy('browser')->pluck('total', 'browser')->toArray();
        $oss = UserAgent::select('os', \DB::raw('count(*) as total'))
            ->groupBy('os')->pluck('total', 'os')->toArray();

        $countryData = Customer::join('countries', 'customers.country_id', '=', 'countries.id')
            ->selectRaw('countries.name as country_name, COUNT(customers.id) as customer_count')
            ->groupBy('countries.name')
            ->get();

        $user = Auth::user()->load('roles');
        return view('admin.dashboard', compact('user', 'pendingDepositCount', 'pendingWithdrawCount', 'openSupportTicketCount', 'allCustomerCount', 'activeCustomerCount', 'freeCustomerCount', 'totalDeposits', 'totalWithdraw', 'totalDepositAmount', 'totalWithdrawAmount', 'totalPendingDepositAmount', 'totalPendingWithdrawAmount', 'totalDirectUser', 'memberships', 'browsers', 'oss', 'countryData', 'totalReferralUser', 'customerCount6MonthActive', 'customerCount1YearActive'));
    }
    public function pusherPage()
    {
        return view('access_log.pusher');
    }

    // app/Http/Controllers/DatabaseExportController.php



}
