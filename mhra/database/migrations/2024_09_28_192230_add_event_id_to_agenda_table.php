<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('agenda', function (Blueprint $table) {
            $table->foreignIdFor(\App\Models\Event::class)->nullable()->constrained('events');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('agenda', function (Blueprint $table) {
            $table->dropForeignIdFor(\App\Models\Event::class);
        });
    }
};

