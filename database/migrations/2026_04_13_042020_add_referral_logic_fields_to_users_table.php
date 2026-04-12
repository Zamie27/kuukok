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
        Schema::table('users', function (Blueprint $table) {
            $table->decimal('lifetime_cashback_earned', 12, 2)->default(0)->after('cashback_balance');
            $table->boolean('has_ordered_hosting')->default(false)->after('lifetime_cashback_earned');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['lifetime_cashback_earned', 'has_ordered_hosting']);
        });
    }
};
