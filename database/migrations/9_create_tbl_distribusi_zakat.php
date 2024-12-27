<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tbl_distribusi_zakat', function (Blueprint $table) {
            $table->id();
            // foreign key
            $table->unsignedBigInteger('id_amil');
            $table->unsignedBigInteger('id_mustahik');
            // value
            $table->date('tgl_penerima');
            $table->string('nama_mustahik');
            $table->enum('jenis_zakat', ['fitrah', 'mal'])->default('fitrah');
            $table->decimal('jmlh_uang', 10, 2)->default(0);
            $table->integer('jmlh_beras')->default(0);
            $table->timestamps();

            // Foreign Key Constraints
            $table->foreign('id_amil')->references('id')->on('tbl_amil')->onDelete('cascade');
            $table->foreign('id_mustahik')->references('id')->on('tbl_Mustahik')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_distribusi_zakat');
    }
};