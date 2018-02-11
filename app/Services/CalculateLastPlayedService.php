<?php

namespace App\Services;

use \App\Song;
use \App\Stat;

class CalculateLastPlayedService {

    public function __construct() {
        self::calculate();
    }

    private function calculate() {
        $songs = Song::whereNull('last_played')->orderBy('time_played', 'desc')->get();

        foreach($songs as $song) {
            self::calculateForSong($song);
        }
    }

    public static function calculateForSong($song) {
        $playedList = Song::FindSong($song->artist, $song->title)->get();

        if($playedList->count() > 1) {
            $song->update(['last_played' => $playedList[1]->time_played]);
        }
    }


}