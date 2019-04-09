<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSparepartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spareparts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('kode_sparepart');
            $table->string('nama_sparepart');
            $table->string('merk_sparepart');
            $table->string('tipe_sparepart');
            $table->string('gambar_sparepart');
            $table->integer('jumlah_stok_sparepart');
            $table->float('harga_beli_sparepart');
            $table->float('harga_jual_sparepart');
            $table->integer('jumlah_minimal');
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
        Schema::dropIfExists('spareparts');
    }
}
