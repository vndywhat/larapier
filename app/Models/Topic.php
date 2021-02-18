<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Topic
 * @package App\Models
 * @property integer $id
 * @property string $title
 * @property integer $forum_id
 * @property integer $poster_id
 * @property integer $type
 * @property integer $first_post_id
 * @property integer $last_post_id
 * @property string $last_post_time
 * @property string $created_at
 * @property string $updated_at
 * @mixin \Eloquent
 */

class Topic extends Model
{
    use HasFactory;

    protected $with = [];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'forum_id', 'poster_id', 'type', 'first_post_id', 'last_post_id',
        'last_post_time',
    ];

    public function firstPost()
    {
        return $this->hasOne(Post::class, 'id', 'first_post_id');
    }

    public function lastPost()
    {
        return $this->hasOne(Post::class, 'id', 'last_post_id')->with('author');
    }

    public function posts()
    {
        return $this->hasMany(Post::class, 'topic_id', 'id');
    }

    public function forum()
    {
        return $this->belongsTo(Forum::class)
            ->with('category');
    }

    public function author()
    {
        return $this->hasOne(User::class, 'id', 'poster_id');
    }
}
