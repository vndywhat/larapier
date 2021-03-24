<?php

namespace App\Jobs;

use App\Models\Peer;
use App\Models\Torrent;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessStartedAnnounceRequest implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected array $queries;
    protected User $user;
    protected Torrent $torrent;

    /**
     * Create a new job instance.
     *
     * @param array $queries
     * @param User $user
     * @param Torrent $torrent
     */
    public function __construct(array $queries, User $user, Torrent $torrent)
    {
        $this->queries = $queries;
        $this->user = $user;
        $this->torrent = $torrent;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // Get The Current Peer
        $peer = Peer::where('torrent_id', '=', $this->torrent->id)
            ->where('peer_id', $this->queries['peer_id'])
            ->where('user_id', '=', $this->user->id)
            ->first();

        // Creates a new peer if not existing
        if ($peer === null) {
            if ($this->queries['uploaded'] > 0 || $this->queries['downloaded'] > 0) {
                $this->queries['event'] = 'started';
            }
            $peer = new Peer();
        }

        /*// Get history information
        $history = History::where('info_hash', '=', $this->queries['info_hash'])->where('user_id', '=', $this->user->id)->first();

        // If no History record found then create one
        if ($history === null) {
            $history = new History();
            $history->user_id = $this->user->id;
            $history->info_hash = $this->queries['info_hash'];
        }*/

        $realUploaded = $this->queries['uploaded'];
        $realDownloaded = $this->queries['downloaded'];

        // Up/Down speed
        $speed_up = $speed_down = 0;
		if($peer->updated_at && $peer->updated_at->timestamp < now()->timestamp) {
            if($realUploaded > $peer->uploaded) {
                $speed_up = ceil(($realUploaded - $peer->uploaded) / (now()->diffInSeconds($peer->updated_at)));
            }
            if($realDownloaded > $peer->downloaded) {
                $speed_down = ceil(($realDownloaded - $peer->downloaded) / (now()->diffInSeconds($peer->updated_at)));
            }
        }

        // Peer Update
        $peer->peer_id = $this->queries['peer_id'];
        $peer->md5_peer_id = \md5($this->queries['peer_id']);
        $peer->topic_id = $this->torrent->topic_id;
        $peer->torrent_id = $this->torrent->id;
        $peer->user_id = $this->user->id;
        $peer->info_hash = $this->queries['info_hash'];
        $peer->ip = $this->queries['ip-address'];
        $peer->port = $this->queries['port'];
        $peer->client = $this->queries['user-agent'];
        $peer->seeder = $this->queries['left'] == 0;
        $peer->releaser = ($this->torrent->user_id === $this->user->id);
        $peer->tor_type = $this->torrent->tor_type;
        $peer->uploaded = $realUploaded;
        $peer->downloaded = $realDownloaded;
        $peer->remain = $this->queries['left'];
        $peer->speed_up = $speed_up;
        $peer->speed_down = $speed_down;
        $peer->save();
        // End Peer Update

        /*// History Update
        $history->agent = $this->queries['user-agent'];
        $history->active = 1;
        $history->seeder = $this->queries['left'] == 0;
        //$history->immune = 1;
        $history->uploaded += 0;
        $history->actual_uploaded += 0;
        $history->client_uploaded = $realUploaded;
        $history->downloaded += 0;
        $history->actual_downloaded += 0;
        $history->client_downloaded = $realDownloaded;
        $history->save();
        // End History Update*/

        // Sync Seeders / Leechers Count
		$this->torrent->seeders = Peer::where('torrent_id', '=', $this->torrent->id)->where('remain', '=', '0')->count();
		$this->torrent->leechers = Peer::where('torrent_id', '=', $this->torrent->id)->where('remain', '>', '0')->count();
		$this->torrent->speed_up = Peer::where('torrent_id', '=', $this->torrent->id)->sum('speed_up');
		$this->torrent->speed_down = Peer::where('torrent_id', '=', $this->torrent->id)->sum('speed_down');
		$this->torrent->save();
    }
}
