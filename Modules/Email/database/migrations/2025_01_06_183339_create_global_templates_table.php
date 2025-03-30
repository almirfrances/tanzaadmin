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
        Schema::create('global_templates', function (Blueprint $table) {
            $table->id();
            $table->string('name')->default('Global Template');
            $table->string('subject')->nullable(); // Email subject
            $table->text('html_template');
            $table->json('shortcodes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('global_templates');
    }
};
