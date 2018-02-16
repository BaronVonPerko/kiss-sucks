<template>
    <div class="search-form">
        <autocomplete
                source="api/search/"
                @selected="songSelected"
                placeholder="Search...">
        </autocomplete>
        <em v-if="searching">Calculating data for {{title}} <strong>{{artist}}</strong></em>
        <div class="song-stats" v-if="stats">
            <h3>{{title}} <em>{{artist}}</em></h3>
            <small class="section-subtitle">The following values show how many time this song or this artist has been played</small>

            <div class="section">
                <div class="item">
                    <h4>This Month</h4>
                    <div>
                        <small>Song</small>
                        <strong>{{stats.songThisMonth}}</strong>
                    </div>
                    <div>
                        <small>Artist</small>
                        <strong>{{stats.artistThisMonth}}</strong>
                    </div>
                </div>
                <div class="item">
                    <h4>Last Month</h4>
                    <div>
                        <small>Song</small>
                        <strong>{{stats.songLastMonth}}</strong>
                    </div>
                    <div>
                        <small>Artist</small>
                        <strong>{{stats.artistLastMonth}}</strong>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    // https://github.com/charliekassel/vuejs-autocomplete
    import Autocomplete from 'vuejs-auto-complete';

    import axios from 'axios';

    export default {

        data: () => {
            return {
                searching: false,
                title: '',
                artist: '',
                stats: null,
            }
        },

        components: {
            Autocomplete,
        },

        methods: {
            songSelected (song) {
                this.title = song.display.split('<strong>')[0];
                this.artist = song.display.split('<strong>')[1].replace('</strong>', '');
                this.fetchSongData();
            },

            fetchSongData () {
                this.searching = true;

                axios.get('api/songdata/' + this.artist + "/" + this.title)
                    .then(res => {
                        this.searching = false;
                        this.stats = res.data;
                    });
            },
        }
    }
</script>
