<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Category;

class DifficultyRecord extends Model
{
    protected $fillable = [
        'category_id',
        'title',
        'situation',
        'feeling',
        'severity',
        'occurred_at',
    ];

    protected $casts = [
        'occurred_at' => 'datetime',
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