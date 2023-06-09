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
        Schema::create('data_anggota', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->string('nik')->unique();
            $table->string('npwp')->nullable();
            $table->date('tanggal_masuk');
            $table->string('nama');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->enum('jenis_kelamin', ['laki-laki', 'perempuan']);
            $table->string('nomor_hp');
            $table->text('alamat');
            $table->text('image')->nullable();
            $table->enum('is_active', ['1', '0'])->default('1');
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
        Schema::dropIfExists('data_anggota');
    }
};
