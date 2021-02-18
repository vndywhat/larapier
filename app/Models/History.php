<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class History
 * @package App\Models
 * @mixin \Eloquent
 */
class History extends Model
{
    use HasFactory;

    /**
     * The Database Table Used By The Model.
     *
     * @var string
     */
    protected $table = 'history';

    /**
     * The Attributes That Are Mass Assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'info_hash',
    ];
}
