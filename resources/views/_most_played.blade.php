<h3 class="section-title">Most Played Artists</h3>
<small class="section-subtitle">The following artists make up <strong>{{$topArtistsTotalPercent}}%</strong>
    of
    all songs played.
</small>
<ul class="most-played-artists">
@foreach($topArtists as $artist)
    <li>
        <img src="{{$artist->image}}" alt="">
        <p>{{$artist->name}}</p>
        <p class="percent">{{$artist->percent}}%</p>
    </li>
@endforeach
</ul>