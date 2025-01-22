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
        Schema::create('rpg_sessions', function (Blueprint $table) {
            $table->id()->autoIncrement();

            $table->string('name');
            $table->dateTime('date_session');
            $table->enum('status', ['waiting', 'in_progress', 'closed'])->default('waiting');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rpg_sessions');
    }
};
