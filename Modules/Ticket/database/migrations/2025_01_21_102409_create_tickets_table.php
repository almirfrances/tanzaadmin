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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Reference to the user
            $table->string('subject'); // Ticket subject
            $table->text('description'); // Ticket description
            $table->string('category'); // e.g., General Support, Technical Support, Sales Support
            $table->string('priority'); // e.g., High, Medium, Low
            $table->string('status')->default('open'); // e.g., open, closed, reopened
            $table->string('attachment')->nullable(); // File path for attachments
            $table->timestamp('auto_close_at')->nullable(); // For auto-closing tickets
            $table->timestamps(); // Created and updated timestamps
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
