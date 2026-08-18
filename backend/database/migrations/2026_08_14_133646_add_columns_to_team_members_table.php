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
        Schema::table('team_members', function (Blueprint $table) {
            $table->foreignId('team_id')->nullable()->after('id')->constrained('teams')->cascadeOnDelete();
            $table->foreignId('user_id')->nullable()->after('team_id')->constrained('users')->cascadeOnDelete();

            $table->unique(['team_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('team_members', function (Blueprint $table) {
            $table->dropUnique(['team_id', 'user_id']);
            $table->dropConstrainedForeignId('user_id');
            $table->dropConstrainedForeignId('team_id');
        });
    }
};
