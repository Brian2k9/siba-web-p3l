<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTranspengadaanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trans_pengadaan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_supplier')->unsigned();
            $table->bigInteger('id_cabang')->unsigned();
            $table->date('tanggal_pengadaan');
            $table->float('total_harga_pengadaan');
            $table->timestamps();
        });

        Schema::table('trans_pengadaan', function(Blueprint $table) {
            $table->foreign('id_supplier')->references('id')
            ->on('suppliers')
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
        Schema::dropIfExists('trans_pengadaan');
    }
}
