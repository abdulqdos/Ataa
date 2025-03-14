<?php

use App\Models\Organization;
use App\Models\Tag;
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
        Schema::create('organization_tag', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Organization::class , 'organization_id');
            $table->foreignIdFor(Tag::class , 'tag_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('organization_tag');
    }
};
