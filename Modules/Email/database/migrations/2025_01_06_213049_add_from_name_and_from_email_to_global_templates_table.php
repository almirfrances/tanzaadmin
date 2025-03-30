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
        Schema::table('global_templates', function (Blueprint $table) {
            $table->string('from_name')->after('html_template')->nullable();
            $table->string('from_email')->after('from_name')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('global_templates', function (Blueprint $table) {
            $table->dropColumn(['from_name', 'from_email']);
        });
    }
};
