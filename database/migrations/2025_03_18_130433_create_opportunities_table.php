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
        Schema::create('opportunities', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->longText('description');
            $table->date('start_date');
            $table->date('end_date');
            $table->time('start_time');
            $table->time('end_time');
            $table->string('img_url')->nullable();
            $table->string('location');
            $table->string('location_url', 2048)->nullable();
            $table->integer('count');
            $table->integer('accepted_count')->default(0);
            $table->boolean('has_certificate')->default(false);
            $table->foreignId('organization_id')->constrained('organizations')->OnDelete('cascade');
            $table->foreignId('sector_id')->constrained('sectors');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('opportunities');
    }
};
