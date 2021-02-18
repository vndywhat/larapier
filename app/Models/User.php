<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use Illuminate\Support\Carbon;
use Carbon\CarbonInterface;

/**
 * Class User
 * @package App\Models
 * @mixin \Eloquent
 */
class User extends Authenticatable
{
    use HasFactory, Notifiable;

    const GENDER_NONE = 0;
    const GENDER_MALE = 1;
    const GENDER_FEMALE = 2;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'email',
        'password',
        'lang',
        'signature',
        'from',
        'telegram',
        'website',
        'gender'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'points' => 'float',
    ];

    public function getGenderAttribute($value)
    {
        switch ($value)
        {
            case self::GENDER_MALE:
                return 'Мужской';
                break;
            case self::GENDER_FEMALE:
                return 'Женский';
                break;
            default:
                return 'Не определён';
        }
    }

    public function joinedDate()
    {
        $created = new Carbon($this->created_at);

        return now()->diffForHumans($created, CarbonInterface::DIFF_ABSOLUTE);
    }

    public function posts()
    {
        return $this->hasMany(Post::class, 'poster_id');
    }

    public function topics()
    {
        return $this->hasMany(Topic::class, 'poster_id');
    }
}
