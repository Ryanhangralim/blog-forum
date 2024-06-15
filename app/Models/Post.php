<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    use HasFactory;

    //yang boleh diisi
    // protected $fillable = [
    //     'title',
    //     'excerpt',
    //     'body',
    // ];

    //yang tidak boleh diisi
    protected $guarded = [
        'id'
    ];

    protected $with = ['category', 'author'];

    //scope query
    public function scopeFilter($query, array $filters){
            // jika ada, masukann nilai, jika tidak maka false
            $query->when($filters['search'] ?? false, function($query, $search) {
                return $query->where(function($query) use ($search) {
                $query->where('title', 'like', '%' . $search . '%')
                ->orWhere('body', 'like', '%' . $search . '%');
                });
        });
    }

    public function category() : BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function author() : BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    //default menggunakan slug
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
