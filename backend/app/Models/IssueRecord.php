<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class IssueRecord extends Model
{
    protected $fillable = [
        'user_id',
        'category_id',
        'occurred_at',
        'title',
        'situation',
        'feeling',
        'cause',
        'countermeasure',
        'work_scene',
        'fatigue_level',
        'stress_level',
        'severity',
        'is_resolved',
    ];
    
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
