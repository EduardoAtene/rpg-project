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
        Schema::create('player_session', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->foreignId('player_id')->constrained('players')->onDelete('cascade');
            $table->foreignId('session_id')->constrained('rpg_sessions')->onDelete('cascade');
            $table->enum('status', ['uninitialized','attend', 'missing'])->default('uninitialized');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('player_session');
    }
};
