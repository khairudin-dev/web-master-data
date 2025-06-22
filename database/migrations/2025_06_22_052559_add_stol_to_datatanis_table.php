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
            $table->decimal('stok', 7, 2)->default('0')->after('t_penangkaran');
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
