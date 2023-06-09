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
        Schema::create('anggsuran', function (Blueprint $table) {
            $table->id();
            $table->integer('id_pinjaman');
            $table->integer('id_anggota');
            $table->integer('angsuran');
            $table->enum('lunas', ['1', '0'])->default('0');
            $table->date('tanggal_jatuh_tempo');
            $table->enum('status_telat', ['2' ,'1', '0'])->default('0');
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
        Schema::dropIfExists('anggsuran');
    }
};
