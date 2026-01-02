<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DemoUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Create Demo User
        $user = User::firstOrCreate(
            ['email' => 'demo@example.com'],
            [
                'name' => 'Demo User',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );

        // 2. Ensure Default Categories exist for this user
        $categories = [
            // Income
            ['name' => 'Monthly Allowance', 'type' => 'income'],
            ['name' => 'Freelance', 'type' => 'income'],
            ['name' => 'Salary', 'type' => 'income'],
            ['name' => 'Bonus', 'type' => 'income'],
            ['name' => 'Gift', 'type' => 'income'],
            
            // Expense
            ['name' => 'Food', 'type' => 'expense'],
            ['name' => 'Transportation', 'type' => 'expense'],
            ['name' => 'Bills', 'type' => 'expense'],
            ['name' => 'Shopping', 'type' => 'expense'],
            ['name' => 'Education', 'type' => 'expense'],
            ['name' => 'Entertainment', 'type' => 'expense'],
            ['name' => 'Health', 'type' => 'expense'],
        ];

        foreach ($categories as $cat) {
            Category::firstOrCreate([
                'user_id' => $user->id,
                'name' => $cat['name'],
                'type' => $cat['type'],
            ]);
        }

        // Refresh categories to get IDs
        $incomeCategories = Category::where('user_id', $user->id)->where('type', 'income')->get();
        $expenseCategories = Category::where('user_id', $user->id)->where('type', 'expense')->get();

        // 3. Generate Dummy Transactions (Last 12 Months)
        $startDate = Carbon::now()->subMonths(12)->startOfMonth();
        $endDate = Carbon::now();

        // Clear existing transactions for demo user to avoid duplicates if re-run
        Transaction::where('user_id', $user->id)->delete();

        $currentDate = $startDate->copy();

        while ($currentDate <= $endDate) {
            // A. Monthly Salary (Income) - Once a month
            Transaction::create([
                'user_id' => $user->id,
                'category_id' => $incomeCategories->where('name', 'Salary')->first()->id ?? $incomeCategories->first()->id,
                'type' => 'income',
                'amount' => rand(5000000, 8000000), // Random salary between 5-8 million
                'transaction_date' => $currentDate->copy()->setDay(25), // Payday
                'note' => 'Monthly Salary',
            ]);

            // B. Random Freelance/Bonus (Income) - Occasional
            if (rand(0, 100) < 30) { // 30% chance
                Transaction::create([
                    'user_id' => $user->id,
                    'category_id' => $incomeCategories->where('name', 'Freelance')->first()->id ?? $incomeCategories->first()->id,
                    'type' => 'income',
                    'amount' => rand(500000, 2000000),
                    'transaction_date' => $currentDate->copy()->setDay(rand(1, 28)),
                    'note' => 'Freelance Project',
                ]);
            }

            // C. Daily/Weekly Expenses
            // Create about 10-15 expenses per month
            $numExpenses = rand(10, 15);
            for ($i = 0; $i < $numExpenses; $i++) {
                $randomCategory = $expenseCategories->random();
                $amount = 0;
                $note = '';

                switch ($randomCategory->name) {
                    case 'Food':
                        $amount = rand(20000, 150000);
                        $note = 'Lunch/Dinner';
                        break;
                    case 'Transportation':
                        $amount = rand(10000, 100000);
                        $note = 'Grab/Gojek/Fuel';
                        break;
                    case 'Bills':
                        $amount = rand(100000, 500000);
                        $note = 'Electricity/Internet';
                        break;
                    case 'Shopping':
                        $amount = rand(100000, 1000000);
                        $note = 'Groceries/Clothes';
                        break;
                    case 'Entertainment':
                        $amount = rand(50000, 300000);
                        $note = 'Movie/Netflix';
                        break;
                    default:
                        $amount = rand(50000, 200000);
                        $note = 'Misc';
                }

                Transaction::create([
                    'user_id' => $user->id,
                    'category_id' => $randomCategory->id,
                    'type' => 'expense',
                    'amount' => $amount,
                    'transaction_date' => $currentDate->copy()->setDay(rand(1, 28)),
                    'note' => $note,
                ]);
            }

            $currentDate->addMonth();
        }
    }
}
