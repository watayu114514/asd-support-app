<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $fillable = [
        'name',
        'sort',
    ];

    public function issueRecords(): HasMany
    {
        return $this->hasMany(IssueRecord::class);
    }
}
