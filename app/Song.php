<?php

namespace App;

use App\Events\SongCreated;
use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    protected $guarded = [];

    protected $dates = [
        'time_played',
        'last_played'
    ];


    /**
     * Song URL Accessor
     *
     * $this->song_url
     *
     * @return mixed|string
     */
    function getSongUrlAttribute()
    {
        if ($this->thumbnail_url != null) {
            return $this->thumbnail_url;
        } elseif ($this->image_url != null) {
            return $this->image_url;
        } else {
            return asset('images/blank.jpg');
        }
    }


    /**
     * Find an instance of the song in the database by the unique combination
     * of artist name, title, and timestamp of when the song was played.
     *
     * @param $query
     * @param $artist
     * @param $title
     * @param $timestamp
     *
     * @return mixed
     */
    function scopeFindInstance($query, $artist, $title, $timestamp)
    {
        return $query->whereArtist($artist)
                     ->whereTitle($title)
                     ->whereTimePlayed($timestamp);
    }


    /**
     * Find the given song.
     *
     * @param $query
     * @param $artist
     * @param $title
     *
     * @return mixed
     */
    function scopeFindSong($query, $artist, $title)
    {
        return $query->whereArtist($artist)
            ->whereTitle($title)
            ->orderBy('time_played', 'desc');
    }


    /**
     * Return the latest songs played.
     *
     * @param $query
     * @param int $number
     *
     * @return mixed
     */
    function scopeLatest($query, $number = 10)
    {
        return $query->orderBy('time_played', 'desc')->take($number);
    }

    protected $dispatchesEvents = [
        'created' => SongCreated::class,
    ];
}
