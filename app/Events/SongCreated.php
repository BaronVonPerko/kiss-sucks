<?php

namespace App\Events;

use App\Services\CalculateLastPlayedService;
use App\Song;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class SongCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @param Song $song
     */
    public function __construct(Song $song)
    {
        $existing = Song::whereTitle($song->title)->whereArtist($song->artist)->whereNotNull('release_year')->first();
        if(!is_null($existing))
        {
        	$song->update(['release_year' => $existing->release_year]);
        }

        CalculateLastPlayedService::calculateForSong($song);
    }
}
