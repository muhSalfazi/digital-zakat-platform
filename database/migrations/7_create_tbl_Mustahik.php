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
        Schema::create('tbl_Mustahik', function (Blueprint $table) {
           $table->id();
           $table->string('name');
           $table->string('address');
           $table->string('jumlah_hak');
           $table->string('no_telp')->nullable();
           $table->string('no_kk')->unique();
           
            $table->unsignedBigInteger('id_kategori');
          $table->timestamps();

          $table->foreign('id_kategori')->references('id')->on('tbl_kategori_penerima')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_asnaf');
    }
};