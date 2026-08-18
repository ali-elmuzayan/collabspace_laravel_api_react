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
        Schema::table('project_members', function (Blueprint $table) {
            $table->enum('role', ['admin', 'editor', 'viewer'])->default('viewer')->after('user_id');
        });

        if (Schema::hasTable('project_guests')) {
            DB::transaction(function (): void {
                DB::table('project_guests')
                    ->orderBy('id')
                    ->chunkById(100, function ($guests): void {
                        foreach ($guests as $guest) {
                            DB::table('project_members')->updateOrInsert(
                                [
                                    'project_id' => $guest->project_id,
                                    'user_id' => $guest->user_id,
                                ],
                                [
                                    'role' => $guest->role,
                                    'created_at' => $guest->created_at,
                                    'updated_at' => $guest->updated_at,
                                ],
                            );
                        }
                    });
            });

            Schema::dropIfExists('project_guests');
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('project_guests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained('projects')->cascadeOnDelete();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->enum('role', ['admin', 'editor', 'viewer'])->default('viewer');
            $table->timestamps();
        });

        foreach (
            DB::table('project_members')
                ->whereIn('role', ['admin', 'editor', 'viewer'])
                ->orderBy('id')
                ->get() as $member
        ) {
            DB::table('project_guests')->insert([
                'project_id' => $member->project_id,
                'user_id' => $member->user_id,
                'role' => $member->role,
                'created_at' => $member->created_at,
                'updated_at' => $member->updated_at,
            ]);
        }

        Schema::table('project_members', function (Blueprint $table) {
            $table->dropColumn('role');
        });
    }
};
