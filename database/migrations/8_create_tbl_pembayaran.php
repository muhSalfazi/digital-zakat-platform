<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tbl_pembayaran', function (Blueprint $table) {
          $table->dateTime('tgl_penyerahan');
          $table->decimal('pembayaran_uang', 10, 2)->default(0);
          $table->integer('jmlh_tanggungan')->default(0);
          $table->decimal('total_pembayaran', 10, 2)->default(0);
          
          $table->unsignedBigInteger('id_muzaki');
          $table->unsignedBigInteger('id_zakat');
          $table->unsignedBigInteger('id_amil');
          
        $table->timestamps();
           $table->foreign('id_muzaki')->references('id')->on('tbl_muzaki')->onDelete('cascade');
           $table->foreign('id_zakat')->references('id')->on('tbl_zakat')->onDelete('cascade');
           $table->foreign('id_amil')->references('id')->on('tbl_users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_pembayaran');
    }
};