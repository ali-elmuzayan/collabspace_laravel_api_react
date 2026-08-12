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
        Schema::create('files', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('original_name');
            $table->string('file_name');
            $table->string('disk')->default('public');
            $table->string('mime_type')->nullable();
            $table->string('extension', 20);
            $table->string('file_type');
            $table->unsignedBigInteger('size');
            $table->string('status')->default('detached');
            $table->nullableMorphs('attachable');
            $table->timestamps();

            // Relationships:
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();

            // Indexes:
            $table->index(['file_type', 'status']);
            $table->index(['status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('files');
    }
};
