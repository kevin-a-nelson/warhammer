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
        Schema::create('minatures', function (Blueprint $table) {
            $table->id();
            $table->string('newRecruitId')->unique()->required();
            $table->string('name')->required();
            $table->string('from')->required();
            $table->integer('cost')->required();
            $table->integer('movement')->required();
            $table->integer('toughness')->required();
            $table->integer('armor_save')->required();
            $table->integer('wounds')->required();
            $table->integer('leadership')->required();
            $table->integer('objective_control')->required();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('minature');
    }
};
