<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Jalankan satu-satu untuk menghindari transaction abort di Neon
        if (!Schema::hasIndex('transactions', 'transactions_user_id_index')) {
            Schema::table('transactions', function (Blueprint $table) {
                $table->index('user_id');
            });
        }
        
        if (!Schema::hasIndex('transactions', 'transactions_category_id_index')) {
            Schema::table('transactions', function (Blueprint $table) {
                $table->index('category_id');
            });
        }

        if (!Schema::hasIndex('transactions', 'transactions_transaction_date_index')) {
            Schema::table('transactions', function (Blueprint $table) {
                $table->index('transaction_date');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropIndex(['user_id']);
            $table->dropIndex(['category_id']);
            $table->dropIndex(['transaction_date']);
        });
    }
};
