<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMahasiswaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mahasiswa', function (Blueprint $table) {
            $table->bigIncrements('nim');
            $table->string('nama_mhs');
            $table->string('email');
            $table->string('fakultas');
            $table->string('jurusan');
            $table->string('semester');
            $table->string('no_tlp');
            $table->string('alamat');
            $table->string('foto');
            $table->string('tgl_lahir');
            $table->string('tempat_lahir');
            $table->string('sekolah_asal');
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
        Schema::dropIfExists('mahasiswa');
    }
}
