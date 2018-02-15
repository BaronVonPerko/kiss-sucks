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
    <p>
        <a href="http://paypal.me/chrisperko" target="_blank">
            Help keep this site ad free!
        </a>
    </p>
</header>

<main>

    <div class="content">
        <section>
            @include('_stats_boxes')
        </section>

        <section>
            @include('_most_played')
        </section>
    </div>

    <aside>
        @include('_latest_songs')
    </aside>

</main>

<footer>
    <a href="http://ChrisPerko.net" target="_blank">&copy; <?php echo date( 'Y' ); ?> Chris Perko</a>
</footer>


@if(App::environment('production'))
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-26651291-15"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }

        gtag('js', new Date());

        gtag('config', 'UA-26651291-15');
    </script>
@endif

</body>
</html>
