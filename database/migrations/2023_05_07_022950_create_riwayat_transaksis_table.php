<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('riwayat_transaksi', function (Blueprint $table) {
            $table->id();
            $table->integer('id_anggota');
            $table->integer('nominal');
            $table->enum('jenis', ['penarikan', 'setor'])->default('setor');
            $table->enum('jenis_simpanan', ['pokok','wajib','sukarela'])->default('pokok');
            $table->enum('is_active', ['1', '0'])->default('1');
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('riwayat_transaksi');
    }
};
