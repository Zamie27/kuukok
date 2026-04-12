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
        Schema::table('orders', function (Blueprint $table) {
            // Drop old column if exists
            if (Schema::hasColumn('orders', 'package_type')) {
                $table->dropColumn('package_type');
            }
            
            $table->foreignId('hosting_package_id')->nullable()->constrained('hosting_packages')->nullOnDelete();
            $table->string('customer_name')->nullable()->after('user_id');
            $table->string('customer_email')->nullable()->after('customer_name');
            $table->string('referral_code_used')->nullable()->after('price_total');
            $table->string('payment_proof')->nullable(); // Can backup proof here or use payments table
            $table->text('admin_notes')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign(['hosting_package_id']);
            $table->dropColumn(['hosting_package_id', 'customer_name', 'customer_email', 'referral_code_used', 'payment_proof', 'admin_notes']);
            $table->enum('package_type', ['basic', 'pro', 'custom', 'full'])->after('github_repo_url');
        });
    }
};
