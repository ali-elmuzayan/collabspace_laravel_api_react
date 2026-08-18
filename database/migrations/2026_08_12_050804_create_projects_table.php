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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('slug')->unique();
            $table->string('type')->comment('web, mobile, desktop, api, frontend, other');

            $table->date('start_date');
            $table->date('end_date');
            $table->date('deadline')->nullable();
            $table->integer('duration')->comment('in days');
            $table->enum('status', ['pending', 'in_progress', 'completed', 'cancelled'])->default('pending');
            $table->enum('priority', ['low', 'medium', 'high', 'critical'])->default('low');
            $table->timestamps();

            // Relationships
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();

            // Indexes:
            $table->index(['created_by']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
