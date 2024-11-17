<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class RewardTeamController extends Controller
{
  public function topRecruiters()
  {
    $level1Subscribers = Customer::withCount('subscribers')
      ->where('reference_user', auth()->id())
      ->get();

    // Collect all subscribers from all levels in a single flat collection
    $allSubscribers = collect();

    // Add Level 1 subscribers
    $allSubscribers = $allSubscribers->merge($level1Subscribers);

    // Fetch Level 2 subscribers (subscribers of Level 1) with their subscriber count
    $level1SubscribersIds = $level1Subscribers->pluck('id')->toArray();
    $level2Subscribers = Customer::withCount('subscribers')
      ->whereIn('reference_user', $level1SubscribersIds)
      ->get();
    $allSubscribers = $allSubscribers->merge($level2Subscribers);

    // Fetch Level 3 subscribers (subscribers of Level 2) with their subscriber count
    $level2SubscribersIds = $level2Subscribers->pluck('id')->toArray();
    $level3Subscribers = Customer::withCount('subscribers')
      ->whereIn('reference_user', $level2SubscribersIds)
      ->get();
    $allSubscribers = $allSubscribers->merge($level3Subscribers);

    // Now, let's paginate the merged collection
    $currentPage = LengthAwarePaginator::resolveCurrentPage();
    $perPage = 10;  // Number of items per page

    // Slice the collection to get the items for the current page
    $currentPageItems = $allSubscribers->slice(($currentPage - 1) * $perPage, $perPage)->values();

    // Create the paginator
    $customers = new LengthAwarePaginator(
      $currentPageItems, // Items for the current page
      $allSubscribers->count(), // Total items in the collection
      $perPage, // Items per page
      $currentPage, // Current page number
      ['path' => LengthAwarePaginator::resolveCurrentPath()] // Path for pagination links
    );

    return view('customer.rewards-partner.top-recruiters', compact('customers'));
  }

  public function topSubscribers()
  {
    $level1Subscribers =  Customer::withCount('subscribers')
      ->where('reference_user', auth()->id())
      ->where('monthly_package_status', 'active')
      ->orderBy('monthly_package_enrolled_at', 'desc')
      ->get();

    // Collect all subscribers from all levels in a single flat collection
    $allSubscribers = collect();

    // Add Level 1 subscribers
    $allSubscribers = $allSubscribers->merge($level1Subscribers);

    // Fetch Level 2 subscribers (subscribers of Level 1) with their subscriber count
    $level1SubscribersIds = $level1Subscribers->pluck('id')->toArray();
    $level2Subscribers = Customer::withCount('subscribers')
      ->whereIn('reference_user', $level1SubscribersIds)
      ->where('monthly_package_status', 'active')
      ->orderBy('monthly_package_enrolled_at', 'desc')
      ->get();
    $allSubscribers = $allSubscribers->merge($level2Subscribers);

    // Fetch Level 3 subscribers (subscribers of Level 2) with their subscriber count
    $level2SubscribersIds = $level2Subscribers->pluck('id')->toArray();
    $level3Subscribers = Customer::withCount('subscribers')
      ->whereIn('reference_user', $level2SubscribersIds)
      ->where('monthly_package_status', 'active')
      ->orderBy('monthly_package_enrolled_at', 'desc')
      ->get();
    $allSubscribers = $allSubscribers->merge($level3Subscribers);

    // Now, let's paginate the merged collection
    $currentPage = LengthAwarePaginator::resolveCurrentPage();
    $perPage = 10;  // Number of items per page

    // Slice the collection to get the items for the current page
    $currentPageItems = $allSubscribers->slice(($currentPage - 1) * $perPage, $perPage)->values();

    // Create the paginator
    $customers = new LengthAwarePaginator(
      $currentPageItems, // Items for the current page
      $allSubscribers->count(), // Total items in the collection
      $perPage, // Items per page
      $currentPage, // Current page number
      ['path' => LengthAwarePaginator::resolveCurrentPath()] // Path for pagination links
    );

    return view('customer.rewards-partner.top-recruiters', compact('customers'));
  }

  public function active1y()
  {
    $dateOneYear = Carbon::now()->subYear();
    $level1Subscribers =  Customer::withCount('subscribers')
      ->where('reference_user', auth()->id())
      ->where('monthly_package_status', 'active')
      ->where('monthly_package_enrolled_at', '<', $dateOneYear)
      ->orderBy('subscribers_count', 'desc')
      ->get();

    // Collect all subscribers from all levels in a single flat collection
    $allSubscribers = collect();

    // Add Level 1 subscribers
    $allSubscribers = $allSubscribers->merge($level1Subscribers);

    // Fetch Level 2 subscribers (subscribers of Level 1) with their subscriber count
    $level1SubscribersIds = $level1Subscribers->pluck('id')->toArray();
    $level2Subscribers = Customer::withCount('subscribers')
      ->whereIn('reference_user', $level1SubscribersIds)
      ->where('monthly_package_status', 'active')
      ->where('monthly_package_enrolled_at', '<', $dateOneYear)
      ->orderBy('subscribers_count', 'desc')
      ->get();
    $allSubscribers = $allSubscribers->merge($level2Subscribers);

    // Fetch Level 3 subscribers (subscribers of Level 2) with their subscriber count
    $level2SubscribersIds = $level2Subscribers->pluck('id')->toArray();
    $level3Subscribers = Customer::withCount('subscribers')
      ->whereIn('reference_user', $level2SubscribersIds)
      ->where('monthly_package_status', 'active')
      ->where('monthly_package_enrolled_at', '<', $dateOneYear)
      ->orderBy('subscribers_count', 'desc')
      ->get();
    $allSubscribers = $allSubscribers->merge($level3Subscribers);

    // Now, let's paginate the merged collection
    $currentPage = LengthAwarePaginator::resolveCurrentPage();
    $perPage = 10;  // Number of items per page

    // Slice the collection to get the items for the current page
    $currentPageItems = $allSubscribers->slice(($currentPage - 1) * $perPage, $perPage)->values();

    // Create the paginator
    $customers = new LengthAwarePaginator(
      $currentPageItems, // Items for the current page
      $allSubscribers->count(), // Total items in the collection
      $perPage, // Items per page
      $currentPage, // Current page number
      ['path' => LengthAwarePaginator::resolveCurrentPath()] // Path for pagination links
    );

    return view('customer.rewards-partner.top-recruiters', compact('customers'));
  }



  public function active3m()
  {
    $dateThreeMonths = Carbon::now()->subMonths(3);

    $level1Subscribers =  Customer::withCount('subscribers')
      ->where('reference_user', auth()->id())
      ->where('monthly_package_status', 'active')
      ->where('monthly_package_enrolled_at', '<', $dateThreeMonths)
      ->orderBy('subscribers_count', 'desc')
      ->get();

    // Collect all subscribers from all levels in a single flat collection
    $allSubscribers = collect();

    // Add Level 1 subscribers
    $allSubscribers = $allSubscribers->merge($level1Subscribers);

    // Fetch Level 2 subscribers (subscribers of Level 1) with their subscriber count
    $level1SubscribersIds = $level1Subscribers->pluck('id')->toArray();
    $level2Subscribers = Customer::withCount('subscribers')
      ->whereIn('reference_user', $level1SubscribersIds)
      ->where('monthly_package_status', 'active')
      ->where('monthly_package_enrolled_at', '<', $dateThreeMonths)
      ->orderBy('subscribers_count', 'desc')
      ->get();
    $allSubscribers = $allSubscribers->merge($level2Subscribers);

    // Fetch Level 3 subscribers (subscribers of Level 2) with their subscriber count
    $level2SubscribersIds = $level2Subscribers->pluck('id')->toArray();
    $level3Subscribers = Customer::withCount('subscribers')
      ->whereIn('reference_user', $level2SubscribersIds)
      ->where('monthly_package_status', 'active')
      ->where('monthly_package_enrolled_at', '<', $dateThreeMonths)
      ->orderBy('subscribers_count', 'desc')
      ->get();
    $allSubscribers = $allSubscribers->merge($level3Subscribers);

    // Now, let's paginate the merged collection
    $currentPage = LengthAwarePaginator::resolveCurrentPage();
    $perPage = 10;  // Number of items per page

    // Slice the collection to get the items for the current page
    $currentPageItems = $allSubscribers->slice(($currentPage - 1) * $perPage, $perPage)->values();

    // Create the paginator
    $customers = new LengthAwarePaginator(
      $currentPageItems, // Items for the current page
      $allSubscribers->count(), // Total items in the collection
      $perPage, // Items per page
      $currentPage, // Current page number
      ['path' => LengthAwarePaginator::resolveCurrentPath()] // Path for pagination links
    );

    return view('customer.rewards-partner.top-recruiters', compact('customers'));
  }

  public function active6m()
  {
    $dateSixMonths = Carbon::now()->subMonths(6);
    $level1Subscribers =  Customer::withCount('subscribers')
      ->where('reference_user', auth()->id())
      ->where('monthly_package_status', 'active')
      ->where('monthly_package_enrolled_at', '<', $dateSixMonths)
      ->orderBy('subscribers_count', 'desc')
      ->get();

    $allSubscribers = collect();

    // Add Level 1 subscribers
    $allSubscribers = $allSubscribers->merge($level1Subscribers);

    // Fetch Level 2 subscribers (subscribers of Level 1) with their subscriber count
    $level1SubscribersIds = $level1Subscribers->pluck('id')->toArray();
    $level2Subscribers = Customer::withCount('subscribers')
      ->whereIn('reference_user', $level1SubscribersIds)
      ->where('monthly_package_status', 'active')
      ->where('monthly_package_enrolled_at', '<', $dateSixMonths)
      ->orderBy('subscribers_count', 'desc')
      ->get();
    $allSubscribers = $allSubscribers->merge($level2Subscribers);

    // Fetch Level 3 subscribers (subscribers of Level 2) with their subscriber count
    $level2SubscribersIds = $level2Subscribers->pluck('id')->toArray();
    $level3Subscribers = Customer::withCount('subscribers')
      ->whereIn('reference_user', $level2SubscribersIds)
      ->where('monthly_package_status', 'active')
      ->where('monthly_package_enrolled_at', '<', $dateSixMonths)
      ->orderBy('subscribers_count', 'desc')
      ->get();
    $allSubscribers = $allSubscribers->merge($level3Subscribers);

    // Now, let's paginate the merged collection
    $currentPage = LengthAwarePaginator::resolveCurrentPage();
    $perPage = 10;  // Number of items per page

    // Slice the collection to get the items for the current page
    $currentPageItems = $allSubscribers->slice(($currentPage - 1) * $perPage, $perPage)->values();

    // Create the paginator
    $customers = new LengthAwarePaginator(
      $currentPageItems, // Items for the current page
      $allSubscribers->count(), // Total items in the collection
      $perPage, // Items per page
      $currentPage, // Current page number
      ['path' => LengthAwarePaginator::resolveCurrentPath()] // Path for pagination links
    );

    return view('customer.rewards-partner.top-recruiters', compact('customers'));
  }

  public function allTimeActive()
  {
    $level1Subscribers =  Customer::withCount('subscribers')
      ->where('reference_user', auth()->id())
      ->where('monthly_package','!=', null)
      ->orderBy('subscribers_count', 'desc')
      ->get();

    $allSubscribers = collect();

    // Add Level 1 subscribers
    $allSubscribers = $allSubscribers->merge($level1Subscribers);

    // Fetch Level 2 subscribers (subscribers of Level 1) with their subscriber count
    $level1SubscribersIds = $level1Subscribers->pluck('id')->toArray();
    $level2Subscribers = Customer::withCount('subscribers')
      ->whereIn('reference_user', $level1SubscribersIds)
      ->where('monthly_package','!=', null)
      ->orderBy('subscribers_count', 'desc')
      ->get();
    $allSubscribers = $allSubscribers->merge($level2Subscribers);

    // Fetch Level 3 subscribers (subscribers of Level 2) with their subscriber count
    $level2SubscribersIds = $level2Subscribers->pluck('id')->toArray();
    $level3Subscribers = Customer::withCount('subscribers')
      ->whereIn('reference_user', $level2SubscribersIds)
      ->where('monthly_package','!=', null)
      ->orderBy('subscribers_count', 'desc')
      ->get();
    $allSubscribers = $allSubscribers->merge($level3Subscribers);

    // Now, let's paginate the merged collection
    $currentPage = LengthAwarePaginator::resolveCurrentPage();
    $perPage = 10;  // Number of items per page

    // Slice the collection to get the items for the current page
    $currentPageItems = $allSubscribers->slice(($currentPage - 1) * $perPage, $perPage)->values();

    // Create the paginator
    $customers = new LengthAwarePaginator(
      $currentPageItems, // Items for the current page
      $allSubscribers->count(), // Total items in the collection
      $perPage, // Items per page
      $currentPage, // Current page number
      ['path' => LengthAwarePaginator::resolveCurrentPath()] // Path for pagination links
    );

    return view('customer.rewards-partner.top-recruiters', compact('customers'));
  }

  public function allTimeInactive()
  {
    $level1Subscribers =  Customer::withCount('subscribers')
      ->where('reference_user', auth()->id())
      ->where('monthly_package', null)
      ->orderBy('subscribers_count', 'desc')
      ->get();

    $allSubscribers = collect();

    // Add Level 1 subscribers
    $allSubscribers = $allSubscribers->merge($level1Subscribers);

    // Fetch Level 2 subscribers (subscribers of Level 1) with their subscriber count
    $level1SubscribersIds = $level1Subscribers->pluck('id')->toArray();
    $level2Subscribers = Customer::withCount('subscribers')
      ->whereIn('reference_user', $level1SubscribersIds)
      ->where('monthly_package', null)
      ->orderBy('subscribers_count', 'desc')
      ->get();
    $allSubscribers = $allSubscribers->merge($level2Subscribers);

    // Fetch Level 3 subscribers (subscribers of Level 2) with their subscriber count
    $level2SubscribersIds = $level2Subscribers->pluck('id')->toArray();
    $level3Subscribers = Customer::withCount('subscribers')
      ->whereIn('reference_user', $level2SubscribersIds)
      ->where('monthly_package', null)
      ->orderBy('subscribers_count', 'desc')
      ->get();
    $allSubscribers = $allSubscribers->merge($level3Subscribers);

    // Now, let's paginate the merged collection
    $currentPage = LengthAwarePaginator::resolveCurrentPage();
    $perPage = 10;  // Number of items per page

    // Slice the collection to get the items for the current page
    $currentPageItems = $allSubscribers->slice(($currentPage - 1) * $perPage, $perPage)->values();

    // Create the paginator
    $customers = new LengthAwarePaginator(
      $currentPageItems, // Items for the current page
      $allSubscribers->count(), // Total items in the collection
      $perPage, // Items per page
      $currentPage, // Current page number
      ['path' => LengthAwarePaginator::resolveCurrentPath()] // Path for pagination links
    );

    return view('customer.rewards-partner.top-recruiters', compact('customers'));
  }
}
