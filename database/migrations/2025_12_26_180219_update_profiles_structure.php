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
        Schema::table('profiles', function (Blueprint $table) {
            $table->string('quote', 200)->nullable();
            $table->longText('about_me')->nullable();
            $table->string('address_city')->nullable();
            $table->string('address_province')->nullable();
            $table->string('address_country')->nullable();
            $table->date('joined_at')->nullable();
            $table->json('specializations')->nullable();
            $table->dropColumn('certifications');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('profiles', function (Blueprint $table) {
            $table->dropColumn([
                'quote',
                'about_me',
                'address_city',
                'address_province',
                'address_country',
                'joined_at',
                'specializations',
            ]);
            $table->json('certifications')->nullable();
        });
    }
};
