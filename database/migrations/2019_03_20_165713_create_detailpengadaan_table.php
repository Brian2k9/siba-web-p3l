<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetailpengadaanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_pengadaan', function (Blueprint $table) {
            $table->bigIncrements('id'); //id detail trans pengadaan
            $table->bigInteger('id_trans_pengadaan')->unsigned();
            $table->bigInteger('id_sparepart')->unsigned();
            $table->integer('jumlah_pengadaan');
            $table->timestamps();
        });

        Schema::table('detail_pengadaan', function (Blueprint $table) {
            $table->foreign('id_trans_pengadaan')->references('id')
            ->on('trans_pengadaan')
            ->onDelete('cascade');

            $table->foreign('id_sparepart')->references('id')
            ->on('spareparts')
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
        Schema::dropIfExists('detailpengadaan');
    }
}
