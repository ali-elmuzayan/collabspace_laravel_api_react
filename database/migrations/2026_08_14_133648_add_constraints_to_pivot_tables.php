<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $duplicateAssignments = DB::table('assignment_task')
            ->select(['task_id', 'user_id'])
            ->selectRaw('MIN(id) as retained_id')
            ->groupBy(['task_id', 'user_id'])
            ->havingRaw('COUNT(*) > 1')
            ->get();

        foreach ($duplicateAssignments as $duplicateAssignment) {
            DB::table('assignment_task')
                ->where('task_id', $duplicateAssignment->task_id)
                ->where('user_id', $duplicateAssignment->user_id)
                ->where('id', '!=', $duplicateAssignment->retained_id)
                ->delete();
        }

        Schema::table('assignment_task', function (Blueprint $table) {
            $table->unique(['task_id', 'user_id']);
        });

        Schema::table('project_members', function (Blueprint $table) {
            $table->dropForeign(['project_id']);
            $table->dropForeign(['user_id']);

            $table->foreign('project_id')->references('id')->on('projects')->cascadeOnDelete();
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
        });

        Schema::table('projects', function (Blueprint $table) {
            $table->dropIndex(['created_by']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->index(['created_by']);
        });

        Schema::table('project_members', function (Blueprint $table) {
            $table->dropForeign(['project_id']);
            $table->dropForeign(['user_id']);

            $table->foreign('project_id')->references('id')->on('projects');
            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::table('assignment_task', function (Blueprint $table) {
            $table->dropUnique(['task_id', 'user_id']);
        });
    }
};
