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
        Schema::create('tbl_pengumpulan_zakat', function (Blueprint $table) {
            $table->id();
            // foreign key
            $table->unsignedBigInteger('id_muzaki');
            $table->unsignedBigInteger('id_amil');
            // value
            $table->dateTime('tgl_pengumpulan');
            $table->string('nama_muzaki');
            $table->enum('jenis_pembayaran', ['uang', 'beras'])->default('uang');
            $table->enum('jenis_zakat', allowed: ['fitrah', 'mal'])->default('fitrah');
            $table->integer('jmlh_tanggungan')->default(0);
            $table->integer('jmlh_tanggungandibyr')->default(0);
            // total_pengumpulan
            $table->integer('byr_uang')->nullable();  
            $table->decimal('byr_beras', 10, 2)->nullable();  
        
            $table->timestamps();
        
            // Foreign Key Constraints
            $table->foreign('id_muzaki')->references('id')->on('tbl_muzaki')->onDelete('cascade');
            $table->foreign('id_amil')->references('id')->on('tbl_amil')->onDelete('cascade');
        });        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_pengumpulan_zakat');
    }
};