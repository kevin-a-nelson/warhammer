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
        Schema::create('board_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('board_id')->constrained('boards');
            $table->foreignId('user_id')->constrained('users');
            $table->boolean('is_owner')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('board_user');
    }
};
