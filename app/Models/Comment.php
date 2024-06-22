<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    // protected $with = ['author'];

    public function post(): BelongsTo 
    {
        return $this->belongsTo(Post::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function replies(): HasMany
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }

    public function parent(): BelongsTo 
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }
    
    public function likes(): HasMany
    {
        return $this->hasMany(Like::class);
    }

    public function like_count(): int
    {
        $like = $this->likes()->count();
        return $like;
    }

// Comment.php (Model)

public function getIsLikedAttribute(): bool
{
    $user = Auth::user();
    if (!$user) {
        return false; // If user is not authenticated, return false
    }

    // Check if the authenticated user has liked this specific comment
    return $this->likes()->where('user_id', $user->id)->exists();
}

    // public function allReplies()
    // {
    //     return $this->replies()->with('allReplies')->get();
    // }

}
