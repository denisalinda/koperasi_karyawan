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
        Schema::create('unit_usaha', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pemesan');
            $table->string('jasa');
            $table->date('tanggal');
            $table->string('harga');
            $table->enum('jenis_usaha', ['jasa', 'barang'])->default('jasa');
            $table->enum('is_active', ['1', '0'])->default('1');
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
        Schema::dropIfExists('unit_usaha');
    }
};
