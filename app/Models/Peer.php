<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Peer
 * @package App\Models
 * @property integer $id
 * @property string $peer_id
 * @property string $md5_peer_id
 * @property integer $topic_id
 * @property integer $torrent_id
 * @property integer $user_id
 * @property string $info_hash
 * @property string $ip
 * @property integer $port
 * @property string $client
 * @property boolean $seeder
 * @property boolean $releaser
 * @property integer $tor_type
 * @property integer $uploaded
 * @property integer $downloaded
 * @property integer $remain
 * @property integer $speed_up
 * @property integer $speed_down
 * @property string $created_at
 * @property string $updated_at
 * @mixin \Eloquent
 */
class Peer extends Model
{

}
