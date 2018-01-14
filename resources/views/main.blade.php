<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Kiss Sucks San Antonio</title>

    <link rel="stylesheet" href="{{mix('css/app.css')}}">

</head>
<body>

<header>
    <h1>99.5 Kiss Sucks San Antonio</h1>
</header>

<div>
    <h3>Latest Sucky Songs</h3>

    <div class="row">
        <div class="col-xs-12 col-sm-6">
            @foreach($songs as $song)
                <div class="flex">
                    <img src="{{$song->thumbnail_url}}" alt="{{$song->artist}}">
                    <div>
                        <h5>{{$song->title}}</h5>
                        <p>{{$song->artist}}</p>
                        <small>Played at: {{Carbon\Carbon::parse($song->time_played)->toTimeString()}}</small>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <h3>Sucky Statistics</h3>

    <p>Statistics of 99.5 Kiss Rocks data since {{$oldest}}.</p>

    <p>Total Songs Played: {{$songCount}}</p>
    <p>Unique Artists: {{$uniqueArtists}}</p>
    <p>Most Played Artist: {{$mostPlayedArtist}}</p>
    <p>Unique Songs: {{$uniqueSongs}}</p>
</div>

</body>
</html>
