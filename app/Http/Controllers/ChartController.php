<?php

namespace App\Http\Controllers;

use App\Models\Deposit;
use App\Models\Withdraw;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ChartController extends Controller
{
    public function getChartData(Request $request)
    {
        // If no date range is provided, use the current month
        $startDate = $request->input('start_date') ?? Carbon::now()->startOfMonth()->toDateString();
        $endDate = $request->input('end_date')
            ? Carbon::parse($request->input('end_date'))->endOfDay()->toDateTimeString()
            : Carbon::now()->endOfMonth()->toDateTimeString();
        info('End data', [$endDate]);

        // Fetch deposit data for each day in the range
        $deposits = Deposit::whereBetween('created_at', [$startDate, $endDate])
            ->where('status', '!=', 3)
            ->selectRaw('DATE(created_at) as date, SUM(amount) as total_amount')
            ->groupBy('date')
            ->pluck('total_amount', 'date')
            ->toArray();

        // Fetch withdraw data for each day in the range
        $withdrawals = Withdraw::whereBetween('created_at', [$startDate, $endDate])
            ->where('status', '!=', 'rejected')
            ->selectRaw('DATE(created_at) as date, SUM(amount) as total_amount')
            ->groupBy('date')
            ->pluck('total_amount', 'date')
            ->toArray();

        // Generate labels and fill data for each day in the range
        $labels = [];
        $totalDepositData = [];
        $totalWithdrawData = [];

        $currentDate = strtotime($startDate);
        $endDate = strtotime($endDate);

        while ($currentDate <= $endDate) {
            $date = date('Y-m-d', $currentDate);
            $labels[] = $date;

            $totalDepositData[] = $deposits[$date] ?? 0;
            $totalWithdrawData[] = $withdrawals[$date] ?? 0;

            $currentDate = strtotime('+1 day', $currentDate);
        }

        return response()->json([
            'labels' => $labels,
            'total_deposit' => $totalDepositData,
            'total_withdraw' => $totalWithdrawData,

        ]);
    }
}
