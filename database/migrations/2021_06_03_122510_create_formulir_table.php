<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormulirTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('formulir', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_ekstrakurikuler');
            $table->string('username');
            $table->text('alamat');
            $table->string('tempat_lahir');
            $table->date('tgl_lahir');
            $table->string('usia');
            $table->string('hp');
            $table->string('ayah');
            $table->string('ibu');
            $table->string('hp_ortu');
            $table->text('pengalaman_org');
            $table->text('motto');
            $table->string('gol_darah')->nullable();
            $table->string('riwayat_penyakit');
            $table->text('alasan_masuk');
            $table->enum('status', ['pending', 'diterima', 'ditolak']);
            $table->timestamps();
            $table->foreign('username')->references('username')->on('users')
            ->onUpdate('cascade')
            ->onDelete('cascade');
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
        Schema::dropIfExists('formulir');
    }
}
