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
        Schema::table('portfolios', function (Blueprint $table) {
            $table->string('client_name')->nullable()->after('description');
            $table->date('start_date')->nullable()->after('client_name');
            $table->date('end_date')->nullable()->after('start_date');
            $table->string('project_status')->nullable()->after('end_date'); // e.g., 'Completed', 'Ongoing'
            $table->string('live_demo_link')->nullable()->after('project_status');
        });

        // Pivot table for Portfolio <-> TechStack
        Schema::create('portfolio_tech_stack', function (Blueprint $table) {
            $table->id();
            $table->foreignId('portfolio_id')->constrained()->cascadeOnDelete();
            $table->foreignId('tech_stack_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });

        // Pivot table for Portfolio <-> Profile (Team Members)
        Schema::create('portfolio_team_member', function (Blueprint $table) {
            $table->id();
            $table->foreignId('portfolio_id')->constrained()->cascadeOnDelete();
            $table->foreignId('profile_id')->constrained('profiles')->cascadeOnDelete();
            $table->string('role')->nullable(); // Role in this specific project
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('portfolio_team_member');
        Schema::dropIfExists('portfolio_tech_stack');

        Schema::table('portfolios', function (Blueprint $table) {
            $table->dropColumn(['client_name', 'start_date', 'end_date', 'project_status', 'live_demo_link']);
        });
    }
};
