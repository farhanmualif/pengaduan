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
        Schema::create('pengaduan', function (Blueprint $table) {
            $table->id();
            $table->string('judul_pengaduan');
            $table->string('tempat_kejadian');
            $table->string('kronologi_kejadian');
            $table->timestamp('tanggal_kejadian');
            $table->string('foto_kejadian');
            $table->boolean('status');
            $table->timestamps();
        });

        Schema::create('pengaduan_users', function (Blueprint $table) {
            $table->unsignedBigInteger('users_id');
            $table->unsignedBigInteger('pengaduan_id');

            $table->foreign('users_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('pengaduan_id')->references('id')->on('pengaduan')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pengaduan_users', function (Blueprint $table) {
            $table->dropForeign(['users_id']);
            $table->dropForeign(['pengaduan_id']);
        });

        Schema::dropIfExists('pengaduan');
        Schema::dropIfExists('pengaduan_users');
    }
};
