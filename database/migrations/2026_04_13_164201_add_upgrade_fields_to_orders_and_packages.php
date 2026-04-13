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
        Schema::table('hosting_packages', function (Blueprint $table) {
            $table->integer('rank')->default(10)->after('price_text');
            $table->boolean('is_custom_domain')->default(false)->after('rank');
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->enum('type', ['initial', 'upgrade'])->default('initial')->after('user_id');
            $table->unsignedBigInteger('parent_id')->nullable()->after('type');
            $table->foreign('parent_id')->references('id')->on('orders')->nullOnDelete();
            
            $table->string('status')->default('pending_payment')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign(['parent_id']);
            $table->dropColumn(['type', 'parent_id']);
            $table->string('status')->default('pending_payment')->change();
        });

        Schema::table('hosting_packages', function (Blueprint $table) {
            $table->dropColumn(['rank', 'is_custom_domain']);
        });
    }
};
