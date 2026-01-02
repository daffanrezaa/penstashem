<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CheckDatabaseTables extends Command
{
    protected $signature = 'db:check-tables';
    protected $description = 'Check all tables in the database';

    public function handle()
    {
        $this->info("Checking database connection...");
        $this->info("DB Connection: " . config('database.default'));
        $this->info("DB Host: " . config('database.connections.pgsql.host'));
        $this->info("DB Name: " . config('database.connections.pgsql.database'));
        
        try {
            // Get all tables
            $tables = DB::select("SELECT tablename FROM pg_catalog.pg_tables WHERE schemaname = 'public'");
            
            if (empty($tables)) {
                $this->error("No tables found in database!");
                return 1;
            }
            
            $this->info("\nTables found:");
            foreach ($tables as $table) {
                $this->line("  - {$table->tablename}");
            }
            
            // Check users table
            if (Schema::hasTable('users')) {
                $userCount = DB::table('users')->count();
                $this->info("\nUsers table exists with {$userCount} records");
            }
            
            return 0;
        } catch (\Exception $e) {
            $this->error("Error: " . $e->getMessage());
            return 1;
        }
    }
}
