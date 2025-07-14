<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'status',
        'deadline',
        'user_id',
    ];

    protected $casts = [
        'deadline' => 'datetime',
    ];

    // Each task belongs to a user
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
