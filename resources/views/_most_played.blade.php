<h3 class="section-title">Most Played Artists</h3>
<small class="section-subtitle">The following artists make up <strong>{{$topArtistsTotalPercent}}%</strong>
    of
    all songs played.
</small>
<ul class="most-played-artists">
@foreach($topArtists as $artist)
    <li>
        <img src="{{$artist->image}}" alt="">
        <div class="artist-info">
            <p>{{$artist->name}}</p>
            <em>Last played {{$artist->last_played->diffForHumans()}}</em>
        </div>
        <p class="percent">{{$artist->percent}}%</p>
    </li>
@endforeach
</ul>