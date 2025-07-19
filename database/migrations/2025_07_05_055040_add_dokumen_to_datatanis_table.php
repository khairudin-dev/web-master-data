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
        Schema::table('datatanis', function (Blueprint $table) {
            //
            $table->text('h_pendahuluan')->nullable()->after('s_pendahuluan');
            $table->text('h_pl1')->nullable()->after('s_pl1');
            $table->text('h_pl2')->nullable()->after('s_pl2');
            $table->text('h_pl3')->nullable()->after('s_pl3');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('datatanis', function (Blueprint $table) {
            //
        });
    }
};
