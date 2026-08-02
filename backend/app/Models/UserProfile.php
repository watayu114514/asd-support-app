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
        'asd_diagnosis',
        'diagnosis_date',
        'difficulty_note',
    ];

    protected function casts(): array
    {
        return [
            'asd_diagnosis' => 'boolean',
            'diagnosis_date' => 'date',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}