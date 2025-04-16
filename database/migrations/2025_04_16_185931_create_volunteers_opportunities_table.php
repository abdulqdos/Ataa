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
        Schema::create('volunteer_opportunities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('volunteer_id')->constrained('volunteers');
            $table->foreignId('opportunity_id')->constrained('opportunities');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('volunteers_opportunities');
    }
};
