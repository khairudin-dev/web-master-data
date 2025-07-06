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
            $table->decimal('tonase_sertifikat', 8, 2)->nullable()->change();
            $table->date('tg_kadaluarsa')->nullable()->change();
            $table->enum('mutu',[0,1])->nullable()->change();
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
