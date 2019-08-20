<template>
    <div class="container">
        <div class="columns is-multiline">
            <div class="column is-one-fifth-tablet" v-for="(movie, index) in movies" :key="index">
                <Movie v-on:movie-info="viewMovie" :movie="movie"/>
            </div>
        </div>
    </div>
</template>

<script>
import {GetPopularMovies} from './../Api'
import Movie from './../components/Movie/Movie.vue'

export default {
    name: 'movies',
    data(){
        return {
            movies: []
        }
    },
    components: {
        Movie
    },
    created(){
        GetPopularMovies()
            .then(r => {
                this.movies = r.data.results
            })
    },
    methods: {
        viewMovie(id){
            this.$router.push({ name: 'movieinfo', params: { id: id } });
        }
    }
}
</script>

<style scoped>
    .container{
        margin-top: 40px;
    }
</style>