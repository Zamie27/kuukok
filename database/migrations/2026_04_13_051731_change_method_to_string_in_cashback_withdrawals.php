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
        Schema::table('cashback_withdrawals', function (Blueprint $table) {
            $table->string('method')->change();
            $table->string('account_number')->nullable()->after('account_name');
        });
    }

    public function down(): void
    {
        Schema::table('cashback_withdrawals', function (Blueprint $table) {
            $table->enum('method', ['bank', 'ewallet'])->change();
            $table->dropColumn('account_number');
        });
    }
};
