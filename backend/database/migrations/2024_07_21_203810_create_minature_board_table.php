<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**    $table->id();
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('minature_board', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('minature_id');
            $table->unsignedBigInteger('board_id');
            $table->timestamps();
        
            $table->foreign('minature_id')->references('id')->on('minatures')->onDelete('cascade');
            $table->foreign('board_id')->references('id')->on('boards')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('minature_board');
    }
};
