<h3 class="section-title">Statistics of 99.5 Kiss San Antonio</h3>
<small class="section-subtitle">Songs played since {{$oldest}}, statistics updated hourly.</small>

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

{{--<h4>Songs range from the year {{$oldestRelease}} to {{$newestRelease}}</h4>--}}