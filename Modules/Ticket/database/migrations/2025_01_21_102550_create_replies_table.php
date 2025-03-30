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
        Schema::create('replies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ticket_id'); // Reference to the ticket
            $table->unsignedBigInteger('user_id')->nullable(); // Reference to the user (if sent by user)
            $table->unsignedBigInteger('admin_id')->nullable(); // Reference to the admin (if sent by admin)
            $table->text('message'); // Reply message
            $table->string('attachment')->nullable(); // File path for attachments
            $table->string('sender_type')->default('user'); // e.g., user or admin
            $table->timestamps(); // Created and updated timestamps
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('replies');
    }
};
