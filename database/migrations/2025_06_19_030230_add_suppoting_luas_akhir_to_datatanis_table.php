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
            $table->decimal('luas_akhir', 5, 2)->default('0')->after('luas');
            $table->decimal('s_pendahuluan', 5, 2)->default('0')->after('k_pendahuluan');
            $table->decimal('s_pl1', 5, 2)->default('0')->after('k_pl1');
            $table->decimal('s_pl2', 5, 2)->default('0')->after('k_pl2');
            $table->decimal('s_pl3', 5, 2)->default('0')->after('k_pl3');
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
