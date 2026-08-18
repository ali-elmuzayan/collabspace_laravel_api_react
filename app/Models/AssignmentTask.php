<?php

namespace App\Models;

use App\Enums\AssignmentRole;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class AssignmentTask extends Pivot
{
    public $incrementing = true;

    protected $table = 'assignment_task';

    protected $fillable = [
        'task_id',
        'user_id',
        'role',
    ];

    protected function casts(): array
    {
        return [
            'role' => AssignmentRole::class,
        ];
    }

    public function task(): BelongsTo
    {
        return $this->belongsTo(Task::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
