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
        Schema::create('social_logins', function (Blueprint $table) {
            $table->id();
            $table->string('provider'); // e.g., google, github, facebook, twitter
            $table->string('client_id');
            $table->string('client_secret');
            $table->string('redirect_url');
            $table->boolean('status')->default(0); // 1 = Active, 0 = Inactive
            $table->timestamps();
        });
 
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('social_logins');
    }
};
