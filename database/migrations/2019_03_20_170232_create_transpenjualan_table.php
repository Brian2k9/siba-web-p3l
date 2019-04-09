<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTranspenjualanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trans_penjualan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_pelanggan')->unsigned();
            $table->bigInteger('id_cabang')->unsigned();
            $table->float('total_harga_trans');
            $table->float('discount_penjualan');
            $table->float('grand_total');
            $table->string('status_transaksi');
            $table->string('status_pembayaran');
            $table->string('no_plat_kendaraan');
            $table->date('tanggal_penjualan');
            $table->timestamps();
        });
        
        Schema::table('trans_penjualan', function (Blueprint $table) {
            $table->foreign('id_pelanggan')->references('id')
            ->on('pelanggans')
            ->onDelete('cascade');

            $table->foreign('id_cabang')->references('id')
            ->on('cabangs')
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
        Schema::dropIfExists('transpenjualan');
    }
}
