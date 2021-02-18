<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Torrent
 * @package App\Models
 * @property integer $id
 * @property string $info_hash
 * @property integer $post_id
 * @property integer $topic_id
 * @property integer $forum_id
 * @property integer $user_id
 * @property string $file_name
 * @property float $size
 * @property integer $seeders
 * @property integer $leechers
 * @property integer $tor_status
 * @property integer $tor_type
 * @property integer $complete_count
 * @property string $seeder_last_seen
 * @property string $call_seed_time
 * @property integer $speed_up
 * @property integer $speed_down
 * @property string $moderated_at
 * @property integer $moderated_by
 * @property string $created_at
 * @property string $updated_at
 * @mixin \Eloquent
 */
class Torrent extends Model
{

}
