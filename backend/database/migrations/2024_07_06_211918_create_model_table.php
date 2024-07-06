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
        Schema::create('models', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('movement');
            $table->integer('toughness');
            $table->integer('save');
            $table->integer('wounds');
            $table->integer('leadership');
            $table->integer('objectiveControl');
            $table->integer('invulnerableSave');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('models');
    }
};
