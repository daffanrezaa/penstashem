<?php

namespace App\Console\Commands;

use App\Models\Category;
use App\Models\User;
use Illuminate\Console\Command;

class AssignCategoriesToAllUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:assign-categories';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Assign default categories to all registered users';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $users = User::all();
        $defaults = [
            // Income
            ['name' => 'Salary', 'type' => 'income'],
            ['name' => 'Freelance', 'type' => 'income'],
            ['name' => 'Investments', 'type' => 'income'],
            ['name' => 'Gifts', 'type' => 'income'],
            
            // Expense
            ['name' => 'Food & Dining', 'type' => 'expense'],
            ['name' => 'Transportation', 'type' => 'expense'],
            ['name' => 'Housing', 'type' => 'expense'],
            ['name' => 'Utilities', 'type' => 'expense'],
            ['name' => 'Healthcare', 'type' => 'expense'],
            ['name' => 'Entertainment', 'type' => 'expense'],
            ['name' => 'Shopping', 'type' => 'expense'],
        ];

        foreach ($users as $user) {
            $this->info("Checking categories for user: {$user->email}");
            
            foreach ($defaults as $cat) {
                Category::firstOrCreate([
                    'user_id' => $user->id,
                    'name' => $cat['name'],
                    'type' => $cat['type'],
                ]);
            }
        }

        $this->info('All users have been assigned default categories!');
    }
}