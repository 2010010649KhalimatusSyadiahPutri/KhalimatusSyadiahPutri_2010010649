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
        Schema::create('natural_disasters', function (Blueprint $table) {
            $table->id();
            $table->dateTime('time');
            $table->string('disaster_type');
            $table->integer('fatalities')->nullable();
            $table->integer('fatality_of_males')->nullable();
            $table->integer('fatality_of_females')->nullable();
            $table->integer('children')->nullable();
            $table->integer('elderly')->nullable();
            $table->integer('mature')->nullable();
            $table->foreignId('assignment_area_id')->nullable();
            $table->foreignId('officer_id')->nullable()->comment('Anggota Yang Bertugas');
            $table->foreignId('user_id')->nullable()->comment('User yang Membuat Data');
            $table->timestamps();

            $table->foreign('assignment_area_id')->references('id')->on('assignment_areas')->nullOnDelete();
            $table->foreign('officer_id')->references('id')->on('users')->nullOnDelete();
            $table->foreign('user_id')->references('id')->on('users')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('natural_disasters');
    }
};
