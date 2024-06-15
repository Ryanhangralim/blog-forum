<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;
    protected $guarded = ["id"];

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    // scope query
    public function scopeFilter($query, array $filters){
            // jika ada, masukann nilai, jika tidak maka false
            $query->when($filters['search'] ?? false, function($query, $search) {
                return $query->where(function($query) use ($search) {
                $query->where('title', 'like', '%' . $search . '%')
                ->orWhere('body', 'like', '%' . $search . '%');
            });
        });
    }
    
    //default menggunakan slug
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
