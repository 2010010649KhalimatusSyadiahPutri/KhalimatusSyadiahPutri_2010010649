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
        Schema::create('outcoming_letters', function (Blueprint $table) {
            $table->id();
            $table->string('reference_number');
            $table->string('type');
            $table->text('purpose');
            $table->date('date');
            $table->string('sender');
            $table->longText('review_content');
            $table->longText('base_content');
            $table->string('status');
            $table->string('to');
            $table->foreignId('signature_name')->nullable();
            $table->text('copy_of_letters')->nullable();
            $table->foreignId('user_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('outcoming_letters');
    }
};
