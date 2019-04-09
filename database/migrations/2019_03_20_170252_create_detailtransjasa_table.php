<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetailtransjasaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_transjasa', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_trans_penjualan')->unsigned();
            $table->bigInteger('id_jasa')->unsigned();
            $table->bigInteger('id_pegawai')->unsigned();
            $table->bigInteger('id_kendaraan')->unsigned();
            $table->integer('jumlah_jasa');
            $table->float('total_harga_jasa');
            $table->timestamps();
        });

        Schema::table('detail_transjasa', function (Blueprint $table) {
            $table->foreign('id_trans_penjualan')->references('id')
            ->on('trans_penjualan')
            ->onDelete('cascade');

            $table->foreign('id_jasa')->references('id')
            ->on('jasa_services')
            ->onDelete('cascade');

            $table->foreign('id_pegawai')->references('id')
            ->on('pegawais')
            ->onDelete('cascade');

            $table->foreign('id_kendaraan')->references('id')
            ->on('kendaraans')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detailtransjasa');
    }
}
