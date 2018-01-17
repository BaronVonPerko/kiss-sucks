<h4>Latest Sucky Songs</h4>
<ul class="latest-songs-list">
    @foreach($songs as $song)
        <li class="song-card">
            <img src="{{$song->song_url}}" alt="">
            <div class="song-details">
                <p>{{$song->title}}</p>
                <p>{{$song->artist}}</p>
            </div>
        </li>
    @endforeach
</ul>