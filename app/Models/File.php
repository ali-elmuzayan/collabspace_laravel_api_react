<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

#[Fillable([
    'name',
    'original_name',
    'file_name',
    'disk',
    'mime_type',
    'extension',
    'file_type',
    'size',
    'status',
    'fileable_type',
    'fileable_id',
    'created_by',
])]
class File extends Model
{
    protected function casts(): array
    {
        return [
            'size' => 'integer',
        ];
    }

    public function fileable(): MorphTo
    {
        return $this->morphTo();
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
