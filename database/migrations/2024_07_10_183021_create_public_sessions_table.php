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
        Schema::create('public_sessions', function (Blueprint $table) {
            $table->id();
            $table->string('description');
            $table->date('date');
            $table->time('time');
            $table->foreignId('client_id')->constrained()->onDelete('cascade');
            $table->string('attachment');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('public_sessions');
    }
};
