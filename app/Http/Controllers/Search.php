<?php

namespace App\Http\Controllers;

use App\Song;
use Illuminate\Http\Request;

class Search extends Controller {
	public function __invoke( Request $request, $query ) {
		$results = Song::where( "artist", "like", "%$query%" )
		               ->orWhere( "title", "like", "%$query%" )
		               ->groupBy( "artist", "title" )
		               ->get( [ "artist", "title" ] );

		$ret = [];
		foreach ( $results as $result ) {
			$ret[] = [ "name" => "$result->title <strong>$result->artist</strong>" ];
		}

		return $ret;
	}
}
