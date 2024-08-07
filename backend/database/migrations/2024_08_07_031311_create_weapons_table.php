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
        Schema::create('weapons', function (Blueprint $table) {
            $table->id();
            $table->string('newRecruitId')->unique()->required(); 
            $table->string('name')->required(); 
            $table->string('typeId')->required(); 
            $table->string('typeName')->required(); 
            $table->string('from')->required();
            $table->integer('range')->required();
            $table->string('attack')->required();
            $table->string('combat_skill')->required();
            $table->integer('strength')->required();
            $table->integer('armor_penetration')->required();
            $table->integer('damage')->required();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('weapons');
    }
};
