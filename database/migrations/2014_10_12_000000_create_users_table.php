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
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // id => biginteger primary key auto increment dan unsigned
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('fullname')->nullable();
            $table->foreignId('rank_id')->nullable(); // foreignId => Foreign Key dengan tipe data bigInteger dengan tambahan Index
            $table->foreignId('position_id')->nullable();
            $table->foreignId('branching_id')->nullable();
            $table->string('nrp')->nullable();
            $table->string('phone_number')->nullable();
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('rank_id')->references('id')->on('ranks')->nullOnDelete();
            $table->foreign('position_id')->references('id')->on('positions')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
