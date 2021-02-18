<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Forum
 * @package App\Models
 * @mixin \Eloquent
 */
class Forum extends Model
{
    use HasFactory;

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'description', 'slug',
        'category_id', 'parent_id', 'last_post_id',
        'order', 'locked', 'show_on_index',
        'topics_count', 'posts_count',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'locked' => 'boolean',
        'show_on_index' => 'boolean',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function parent()
    {
        return $this->belongsTo(Forum::class, 'parent_id');
    }

    public function childs()
    {
        return $this->hasMany(Forum::class, 'parent_id')
            ->where('show_on_index', '=', '1')
            ->orderByDesc('order');
    }

    public function topics()
    {
        return $this->hasMany(Topic::class)
            ->with(['author', 'lastPost'])
            ->orderByDesc('created_at');
    }

    public function posts()
    {
        return $this->hasMany(Post::class)->orderByDesc('created_at');
    }

    public function lastPost()
    {

        return $this->hasOne(Post::class, 'id', 'last_post_id')
            ->with(['topic', 'author'])
            ->orderByDesc('created_at');

    }
}
