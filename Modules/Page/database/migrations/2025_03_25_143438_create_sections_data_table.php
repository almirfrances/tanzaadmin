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
        Schema::create('sections_data', function (Blueprint $table) {
            $table->id();
            // The section_key should match the keys in your JSON blueprint (e.g. "about", "homebanner2")
            $table->string('section_key');
            // This JSON column will store the content entered by the admin
            $table->json('content')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sections_data');
    }
};
