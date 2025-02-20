<?php

namespace App\Models;

use App\Models\Post;
use App\Models\ParentCategory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;
    use Sluggable;

    protected $fillable = ['name', 'slug', 'parent', 'ordering'];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function parent_category()
    {
        // return $this->hasOne(ParentCategory::class, 'id', 'parent');
        return $this->belongsTo(ParentCategory::class, 'parent', 'id');
    }

    public function posts()
    {
        return $this->hasMany(Post::class, 'category', 'id');
    }
}
