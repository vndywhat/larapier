<?php

namespace App\Models;

use App\Facades\BbCode;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Post
 * @package App\Models
 * @mixin \Eloquent
 */
class Post extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'topic_id', 'forum_id', 'poster_id', 'text', 'text_html'
    ];

    protected $with = [];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [];

    public function setTextHtmlAttribute($value)
    {
        $this->attributes['text_html'] = BbCode::parse($value);
    }

    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'poster_id')
            ->withCount(['posts']);
    }

    public function torrent()
	{
		return $this->hasOne(Torrent::class);
	}
}
