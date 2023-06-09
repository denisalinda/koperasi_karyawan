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
        Schema::create('pinjaman', function (Blueprint $table) {
            $table->id();
            $table->integer('id_nama_anggota');
            $table->string('jumlah_pinjman_diajukan');
            $table->string('jumlah_pinjman')->nullable();
            $table->integer('jangka_waktu');
            $table->text('tujuan_pinjaman');
            $table->string('bunga');
            $table->enum('lunas', ['1', '0'])->default('0');
            $table->enum('acc', ['4','3','2','1', '0'])->default('0');
            $table->enum('is_active', ['1', '0'])->default('1');
            $table->date('tanggal_pencarian')->nullable();
            $table->text('bukti_pencairan')->nullable();
            $table->string('pencairan_melalui')->nullable();
            $table->string('created_by');
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
        Schema::dropIfExists('pinjaman');
    }
};
