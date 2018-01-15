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

<main>

    <div class="content">
        <h3 class="section-title">Statistics of 99.5 Kiss San Antonio</h3>
        <small class="section-subtitle">Data Retrieved Since {{$oldest}}</small>

        <div class="box-stats">
            <div class="section">
                <div class="section-heading">Total Songs</div>
                <div class="data">{{number_format($songCount)}}</div>
            </div>
            <div class="section">
                <div class="section-heading">Unique Songs</div>
                <div class="data">{{number_format($uniqueSongs)}}</div>
            </div>
            <div class="section">
                <div class="section-heading">Unique Artists</div>
                <div class="data">{{number_format($uniqueArtists)}}</div>
            </div>
        </div>
    </div>

    <aside>
        <h4>Latest Sucky Songs</h4>
        <ul>
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
    </aside>

</main>

</body>
</html>
