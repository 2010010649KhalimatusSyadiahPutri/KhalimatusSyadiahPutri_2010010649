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
        Schema::create('kegiatan_publik', function (Blueprint $table) {
            $table->id();
            $table->date('waktu');
            $table->string('kegiatan');
            $table->string('keterangan');
            $table->string('status');
            $table->string('wilayah');
            $table->string('petugas');
            $table->string('lampiran')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kegiatan_publik');
    }
};
