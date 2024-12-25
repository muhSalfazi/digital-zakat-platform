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
        Schema::create('tbl_amil', function (Blueprint $table) {
             $table->id();
             $table->string('name');
             $table->string('phone')->unique();
             $table->string('address');
             $table->string('imageProfile')->nullable();
             $table->unsignedBigInteger('id_amil')->nullable();
            //  $table->enum('status', ['aktif', 'non-aktif'])->default('aktif');
             $table->timestamps();

             $table->foreign('id_amil')->references('id')->on('tbl_users')->onDelete('cascade');
             });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_amil');
    }
};