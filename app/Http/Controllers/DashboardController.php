<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Category;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $userId = auth()->id();
        
        $year = $request->input('year', Carbon::now()->year);
        $month = $request->input('month', Carbon::now()->month);
        
        // Target date (End of selected month)
        $targetDate = Carbon::createFromDate($year, $month, 1)->endOfMonth();
        $startDate = $targetDate->copy()->startOfMonth();

        // 1. Total Balance (As of the end of selected month)
        $totalIncome = Transaction::where('user_id', $userId)
            ->where('type', 'income')
            ->where('transaction_date', '<=', $targetDate)
            ->sum('amount');
            
        $totalExpense = Transaction::where('user_id', $userId)
            ->where('type', 'expense')
            ->where('transaction_date', '<=', $targetDate)
            ->sum('amount');
            
        $currentBalance = $totalIncome - $totalExpense;

        // 2. Monthly Stats (Selected Month)
        $monthlyIncome = Transaction::where('user_id', $userId)
            ->where('type', 'income')
            ->whereBetween('transaction_date', [$startDate, $targetDate])
            ->sum('amount');

        $monthlyExpense = Transaction::where('user_id', $userId)
            ->where('type', 'expense')
            ->whereBetween('transaction_date', [$startDate, $targetDate])
            ->sum('amount');

        // 3. Chart Data (Daily Trend for Selected Month)
        // We want to show every day of the selected month
        $dailyTransactions = Transaction::where('user_id', $userId)
            ->whereBetween('transaction_date', [$startDate->format('Y-m-d'), $targetDate->format('Y-m-d')])
            ->selectRaw('transaction_date, type, SUM(amount) as total')
            ->groupBy('transaction_date', 'type')
            ->orderBy('transaction_date')
            ->get();

        $labels = [];
        $incomeData = [];
        $expenseData = [];

        $daysInMonth = $targetDate->daysInMonth;
        
        for ($day = 1; $day <= $daysInMonth; $day++) {
            $date = Carbon::createFromDate($year, $month, $day)->format('Y-m-d');
            $displayDate = Carbon::createFromDate($year, $month, $day)->format('d M');
            
            // Show label for every 2nd or 3rd day to avoid clutter, or just day number
            $labels[] = (string) $day; // Cast to string
            
            $income = $dailyTransactions->filter(function ($t) use ($date) {
                return $t->transaction_date->format('Y-m-d') === $date && $t->type === 'income';
            })->first();

            $expense = $dailyTransactions->filter(function ($t) use ($date) {
                return $t->transaction_date->format('Y-m-d') === $date && $t->type === 'expense';
            })->first();

            $incomeData[] = $income ? (float) $income->total : 0;
            $expenseData[] = $expense ? (float) $expense->total : 0;
        }

        // 4. Breakdown per Category (Selected Month)
        $categoryBreakdown = Transaction::where('transactions.user_id', $userId)
            ->whereBetween('transaction_date', [$startDate, $targetDate])
            ->join('categories', 'transactions.category_id', '=', 'categories.id')
            ->select('categories.name', 'categories.type', DB::raw('SUM(transactions.amount) as total'))
            ->groupBy('categories.id', 'categories.name', 'categories.type')
            ->orderByDesc('total')
            ->get();

        $incomeBreakdown = $categoryBreakdown->where('type', 'income')->values();
        $expenseBreakdown = $categoryBreakdown->where('type', 'expense')->values();

        // 5. Insight: Burn Rate & Cash Flow
        // If selected month is current month, divide by days passed so far.
        // If past/future, divide by total days in that month.
        $daysInMonth = $targetDate->daysInMonth;
        $daysPassed = ($targetDate->isCurrentMonth()) ? Carbon::now()->day : $daysInMonth;
        
        $dailyBurnRate = $daysPassed > 0 ? $monthlyExpense / $daysPassed : 0;
        $cashFlowStatus = $monthlyIncome - $monthlyExpense;
        $topCategory = $expenseBreakdown->first();

        return Inertia::render('Dashboard', [
            'filters' => [
                'year' => (int) $year,
                'month' => (int) $month,
            ],
            'stats' => [
                'balance' => $currentBalance,
                'monthly_income' => $monthlyIncome,
                'monthly_expense' => $monthlyExpense,
                'cash_flow' => $cashFlowStatus,
                'burn_rate' => $dailyBurnRate,
                'top_category' => $topCategory ? [
                    'name' => $topCategory->name,
                    'amount' => $topCategory->total
                ] : null,
            ],
            'chart' => [
                'labels' => $labels,
                'income' => $incomeData,
                'expense' => $expenseData,
            ],
            'breakdown' => [
                'income' => [
                    'labels' => $incomeBreakdown->pluck('name'),
                    'data' => $incomeBreakdown->pluck('total'),
                ],
                'expense' => [
                    'labels' => $expenseBreakdown->pluck('name'),
                    'data' => $expenseBreakdown->pluck('total'),
                ]
            ]
        ]);
    }
}