<?php

namespace App\Http\Controllers;

use App\Models\AccessLog;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AccessLogController extends Controller
{
    public function index(Request $request)
    {
        // Fetch all users for the dropdown (for the admin to select)
        $users = User::all();

        // Retrieve filter parameters
        $selectedUser = $request->input('user_id');
        $filter = $request->input('filter');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Build the query for access logs
        $query = AccessLog::query();

        // Filter by user if a user is selected
        if ($selectedUser) {
            $query->where('user_id', $selectedUser);
        }

        // Filter by the selected time period
        switch ($filter) {
            case 'today':
                $query->whereDate('created_at', Carbon::today());
                break;

            case 'yesterday':
                $query->whereDate('created_at', Carbon::yesterday());
                break;

            case 'this_week':
                $query->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
                break;

            case 'last_week':
                $query->whereBetween('created_at', [
                    Carbon::now()->subWeek()->startOfWeek(),
                    Carbon::now()->subWeek()->endOfWeek()
                ]);
                break;

            case 'this_month':
                $query->whereMonth('created_at', Carbon::now()->month)
                    ->whereYear('created_at', Carbon::now()->year);
                break;

            case 'last_month':
                $query->whereMonth('created_at', Carbon::now()->subMonth()->month)
                    ->whereYear('created_at', Carbon::now()->subMonth()->year);
                break;

            case 'custom':
                if ($startDate && $endDate) {
                    $query->whereBetween('created_at', [
                        Carbon::parse($startDate)->startOfDay(),
                        Carbon::parse($endDate)->endOfDay()
                    ]);
                }
                break;

            default:
                // No time period selected, no additional date filtering
                break;
        }

        // Get filtered logs
        $logs = $query->with('user')->orderby('id', 'desc')->paginate(20);

        return view('access_log.index', compact('logs', 'users', 'selectedUser', 'filter', 'startDate', 'endDate'));
    }
}
