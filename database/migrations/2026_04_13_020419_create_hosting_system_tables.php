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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('project_name');
            $table->string('whatsapp_number');
            $table->string('github_repo_url')->nullable();
            $table->enum('package_type', ['basic', 'pro', 'custom', 'full']);
            $table->enum('domain_type', ['subdomain', 'custom']);
            $table->string('domain_name')->nullable();
            $table->decimal('price_total', 12, 2);
            $table->enum('status', ['pending_payment', 'waiting_confirmation', 'active', 'rejected'])->default('pending_payment');
            $table->timestamps();
        });

        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->cascadeOnDelete();
            $table->enum('payment_method', ['bank', 'ewallet']);
            $table->string('payment_provider')->nullable(); // e.g. BCA, DANA
            $table->string('account_name');
            $table->string('proof_image');
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->timestamps();
        });

        Schema::create('hosting_accounts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->cascadeOnDelete();
            $table->string('ftp_host')->nullable();
            $table->string('ftp_username')->nullable();
            $table->string('ftp_password')->nullable();
            $table->string('ftp_port')->default('21');
            $table->string('db_name')->nullable();
            $table->string('db_username')->nullable();
            $table->string('db_password')->nullable();
            $table->string('db_host')->default('localhost');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hosting_accounts');
        Schema::dropIfExists('payments');
        Schema::dropIfExists('orders');
    }
};
