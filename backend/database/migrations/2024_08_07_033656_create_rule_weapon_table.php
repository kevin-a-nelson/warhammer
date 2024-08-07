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
        Schema::create('rule_weapon', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rule_id')->constrained('rules');
            $table->foreignId('weapon_id')->constrained('weapons');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rule_weapon');
    }
};
