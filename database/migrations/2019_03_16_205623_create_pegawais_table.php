<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePegawaisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pegawais', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->biginteger('id_role')->unsigned();
            $table->string('nama_pegawai');
            $table->string('alamat_pegawai');
            $table->string('no_telp_pegawai');
            $table->float('gaji_perminggu');
            $table->string('password_pegawai');
            $table->biginteger('id_cabang')->unsigned();
            $table->timestamps();
        });

        Schema::table('pegawais', function(Blueprint $table) {
            $table->foreign('id_role')->references('id')
            ->on('roles')
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
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::dropIfExists('id_cabang');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');

        Schema::dropIfExists('pegawais');
    }
}
