<h4>Latest Sucky Songs</h4>
<ul class="latest-songs-list">
    @foreach($songs as $song)
        <li class="song-card">
            <img src="{{$song->song_url}}" alt="">
            <div class="song-details">
                <p>
                    {{$song->title}}
                    @if($song->release_year)
                        <em>({{$song->release_year}})</em>
                    @endempty
                </p>
                <p>{{$song->artist}}</p>
                @if($song->last_played)
                    <p class="last-played">also played {{$song->last_played->diffForHumans()}}</p>
                @endif
            </div>
        </li>
    @endforeach
</ul>