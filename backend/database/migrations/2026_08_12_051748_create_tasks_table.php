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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('title'); 
            $table->text('description')->nullable(); 
            $table->date('start_date'); 
            $table->date('end_date'); 
            $table->integer('sort_order')->default(0);
            $table->integer('duration')->comment('in days'); 
            $table->smallInteger('progress')->default(0); 
            $table->enum('status', ['pending', 'in_progress', 'completed', 'cancelled'])->default('pending'); 
            $table->enum('priority', ['low', 'medium', 'high', 'critical'])->default('low'); 
            $table->timestamps();

            // Relationships: 
            $table->foreignId('project_id')->constrained('projects')->onDelete('cascade');
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('parent_task_id')->nullable()->constrained('tasks')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
