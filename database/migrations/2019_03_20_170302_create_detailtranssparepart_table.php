<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetailtranssparepartTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_transsparepart', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_trans_penjualan')->unsigned();
            $table->bigInteger('id_sparepart')->unsigned();
            $table->integer('jumlah_barang');
            $table->float('total_harga_jasa');
            $table->timestamps();
        });

        Schema::table('detail_transsparepart', function (Blueprint $table) {
            $table->foreign('id_trans_penjualan')->references('id')
            ->on('trans_penjualan')
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
        Schema::dropIfExists('detailtranssparepart');
    }
}
