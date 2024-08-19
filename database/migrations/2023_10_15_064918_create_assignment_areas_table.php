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
        Schema::create('assignment_areas', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('area')->comment('luas wilayah kerja');
            $table->bigInteger('total_population');
            $table->bigInteger('total_head_of_family');
            $table->bigInteger('total_of_male');
            $table->bigInteger('total_of_female');
            $table->foreignId('pimpinan_id')->nullable()->comment('pimpinan yang memberikan kewajiban');
            $table->foreignId('anggota_id')->nullable()->comment('anggota yang dikasih kewajiban');
            $table->foreignId('user_id')->nullable()->comment('user yang membuat data');
            $table->foreignId('district_id')->nullable()->comment('FK Kelurahan atau Desa');
            $table->timestamps();

            $table->foreign('pimpinan_id')->references('id')->on('users')->nullOnDelete();
            $table->foreign('anggota_id')->references('id')->on('users')->nullOnDelete();
            $table->foreign('user_id')->references('id')->on('users')->nullOnDelete();
            // $table->foreign('district_id')->references('id')->on('districts')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assignment_areas');
    }
};
