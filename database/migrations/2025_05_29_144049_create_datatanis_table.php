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
        Schema::create('datatanis', function (Blueprint $table) {
            $table->id();
            $table->string('no_blok')->unique();
            $table->string('nama');
            $table->string('lapang')->unique()->nullable();
            $table->string('varietas');
            $table->string('kb');
            $table->string('musim');
            $table->text('alamat');
            $table->text('lokasi');
            $table->string('i_label');
            $table->string('label_sumber');
            $table->date('semai');
            $table->date('tanam');
            $table->decimal('luas', 5, 2);
            $table->date('tg_pendahuluan')->nullable();
            $table->string('i_pendahuluan')->nullable();
            $table->text('k_pendahuluan')->nullable();
            $table->date('tg_pl1')->nullable();
            $table->string('i_pl1')->nullable();
            $table->text('k_pl1')->nullable();
            $table->date('tg_pl2')->nullable();
            $table->string('i_pl2')->nullable();
            $table->text('k_pl2')->nullable();
            $table->date('tg_pl3')->nullable();
            $table->string('i_pl3')->nullable();
            $table->text('k_pl3')->nullable();
            $table->date('panen')->nullable();
            $table->decimal('lulus', 5, 2)->nullable();
            $table->decimal('taksasi', 7, 2)->nullable();
            $table->decimal('tonase', 8, 2)->nullable();
            $table->integer('umur_padi')->nullable();
            $table->integer('gkp')->nullable();
            $table->integer('cbb')->nullable();
            $table->date('tg_pengambilan')->nullable();
            $table->date('tg_selesai')->nullable();
            $table->integer('campuran')->nullable();
            $table->integer('kotoran_bersih')->nullable();
            $table->integer('ka')->nullable();
            $table->integer('kecambah')->nullable();
            $table->integer('mutu')->nullable();
            $table->integer('tonase_sertifikat')->nullable();
            $table->string('no_sertifikat')->nullable();
            $table->string('tg_kadaluarsa')->nullable();
            $table->integer('label')->nullable();
            $table->string('seri_label')->nullable();
            $table->string('bantuan')->nullable();
            $table->integer('t_bantuan')->nullable();
            $table->string('market')->nullable();
            $table->integer('t_market')->nullable();
            $table->string('penangkaran')->nullable();
            $table->integer('t_penangkaran')->nullable();
            $table->integer('qcl')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('datatanis');
    }
};
