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
        Schema::create('products_ins', function (Blueprint $table) {
            $table->id();
            $table->string('kode_pegawai');
            $table->string('kode_supplier');
            $table->string('merk_barang');
            $table->string('ukuran')->default('-');
            $table->integer('jumlah_barang');
            $table->integer('harga_satuan');
            $table->integer('total_harga');
            $table->date('tanggal_masuk');
            $table->date('expired');
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
        Schema::dropIfExists('products_ins');
    }
};
