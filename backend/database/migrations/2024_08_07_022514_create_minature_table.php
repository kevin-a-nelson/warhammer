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
            $table->string('cost')->required();
            $table->string('movement')->required();
            $table->string('toughness')->required();
            $table->string('armor_save')->required();
            $table->string('wounds')->required();
            $table->string('leadership')->required();
            $table->string('objective_control')->required();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('minatures');
    }
};
