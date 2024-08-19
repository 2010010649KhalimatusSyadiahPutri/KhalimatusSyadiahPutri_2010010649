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
        Schema::create('outcomes', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('type');
            $table->bigInteger('total');
            $table->string('description')->nullable();
            $table->string('report')->nullable();
            $table->foreignId('operational_id');
            $table->foreignId('user_id');
            $table->timestamps();

            $table->foreign('operational_id')->references('id')->on('operationals')->cascadeOnDelete();
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('outcomes');
    }
};
