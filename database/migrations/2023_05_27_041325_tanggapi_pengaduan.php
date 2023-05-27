<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tanggapi', function(Blueprint $table) {
            $table->id();
            $table->text('isi_tanggapi');
            $table->string('ditanggapi_oleh');
            $table->timestamps();
        });

        Schema::create('tanggapi_pengaduan', function(Blueprint $table) {
            $table->unsignedBigInteger('pengaduan_id');
            $table->unsignedBigInteger('tanggapi_id');

            $table->foreign('pengaduan_id')->references('id')->on('pengaduan');
            $table->foreign('tanggapi_id')->references('id')->on('tanggapi');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tanggapi_pengaduan', function (Blueprint $table) {
            $table->dropForeign(['pengaduan_id']);
            $table->dropForeign(['tanggapi_id']);
        });

        Schema::dropIfExists('tanggapi');
        Schema::dropIfExists('tanggapi_pengaduan');
    }
};
