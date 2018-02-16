<template>
    <div class="search-form">
        <autocomplete
                source="api/search/"
                @selected="songSelected"
                placeholder="Search...">
        </autocomplete>
        <em v-if="searching">Calculating data for {{song}} <strong>{{artist}}</strong></em>
    </div>
</template>

<script>
    // https://github.com/charliekassel/vuejs-autocomplete
    import Autocomplete from 'vuejs-auto-complete';

    export default {

        data: () => {
            return {
                searching: false,
                title: '',
                artist: '',
            }
        },

        components: {
            Autocomplete,
        },

        methods: {
            songSelected (song) {
                this.song = song.display.split('<strong>')[0];
                this.artist = song.display.split('<strong>')[1].replace('</strong>', '');
                this.fetchSongData();
            },

            fetchSongData () {
                this.searching = true;
            },
        }
    }
</script>
