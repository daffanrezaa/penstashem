<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();

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

        foreach ($users as $user) {
            foreach ($categories as $cat) {
                Category::firstOrCreate([
                    'user_id' => $user->id,
                    'name' => $cat['name'],
                    'type' => $cat['type'],
                ]);
            }
        }
    }
}