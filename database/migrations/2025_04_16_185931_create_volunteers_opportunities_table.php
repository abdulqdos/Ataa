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
                $table->foreignId('volunteer_id')->constrained()->onDelete('cascade');
                $table->foreignId('opportunity_id')->constrained()->onDelete('cascade');
                $table->text('description')->nullable();
                $table->integer('hours')->nullable();
                $table->date('participation_date')->nullable();
                $table->text('report')->nullable();
                $table->tinyInteger('eval_commitment')->nullable();
                $table->tinyInteger('eval_teamwork')->nullable();
                $table->tinyInteger('eval_leadership')->nullable();
                $table->float('eval_total')->nullable();
                $table->string('certificate_path')->nullable();
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
