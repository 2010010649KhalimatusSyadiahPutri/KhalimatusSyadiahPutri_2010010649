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
        Schema::create('public_activity_attachments', function (Blueprint $table) {
            $table->id();
            $table->string('path');
            $table->foreignId('public_activity_history_id');
            $table->foreignId('public_activity_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('public_activity_attachments');
    }
};
