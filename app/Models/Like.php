<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Like extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    public function comment(): BelongsTo 
    {
        return $this->belongsTo(Comment::class);
    }

    public function user(): BelongsTo 
    {
        return $this->belongsTo(User::class);
    }

}
