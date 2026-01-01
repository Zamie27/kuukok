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
        Schema::table('posts', function (Blueprint $table) {
            if (!Schema::hasColumn('posts', 'content_blocks')) {
                $table->json('content_blocks')->nullable()->after('content');
            }
            if (!Schema::hasColumn('posts', 'whatsapp_clicks')) {
                $table->unsignedBigInteger('whatsapp_clicks')->default(0)->after('read_time');
            }
            if (!Schema::hasColumn('posts', 'share_clicks')) {
                $table->unsignedBigInteger('share_clicks')->default(0)->after('whatsapp_clicks');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn(['content_blocks', 'whatsapp_clicks', 'share_clicks']);
        });
    }
};
