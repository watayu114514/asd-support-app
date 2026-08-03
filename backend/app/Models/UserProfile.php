<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserProfile extends Model
{
    protected $fillable = [
        'user_id',
        'age',
        'occupation',
        'diagnosis_status',
        'diagnosis_date',
        'strengths',
        'weaknesses',
        'difficulty_note',
        'memo',
    ];

    protected function casts(): array
    {
        return [
            'diagnosis_date' => 'date',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}