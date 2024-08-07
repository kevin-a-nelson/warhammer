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
        Schema::create('minature_rule', function (Blueprint $table) {
            $table->id();
            $table->foreignId('minature_id')->constrained('minatures');
            $table->foreignId('rule_id')->constrained('rules');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('minature_rule');
    }
};
