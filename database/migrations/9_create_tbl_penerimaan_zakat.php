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
        Schema::create('tbl_penerimaan_zakat', function (Blueprint $table) {
             $table->id();
             $table->date('tgl_penerima');
             $table->decimal('jmlh_uang_diterima', 10, 2)->default(0);
             $table->integer('jmlh_beras_diterima')->default(0);
            $table->unsignedBigInteger('id_amil');
            $table->unsignedBigInteger('id_asnaf');
           $table->timestamps();

           $table->foreign('id_amil')->references('id')->on('tbl_users')->onDelete('cascade');
           $table->foreign('id_asnaf')->references('id')->on('tbl_Mustahik')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl__penerimaan_zakat');
    }
};