<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKegiatanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kegiatan', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->date('tgl_mulai');
            $table->time('jam_mulai');
            $table->date('tgl_selesai');
            $table->time('jam_selesai');
            $table->foreignId('id_ekstrakurikuler');
            $table->enum('jenis', ['riwayat', 'jadwal']);
            $table->timestamps();
            $table->foreign('id_ekstrakurikuler')->references('id')->on('ekstrakurikuler')
            ->onUpdate('cascade')
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
        Schema::dropIfExists('kegiatan');
    }
}
