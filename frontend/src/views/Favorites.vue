<template>
    <div class="container">
        <div class="columns is-multiline">
           <div class="column is-one-fifth-tablet" v-for="(movie, index) in movies" :key="index">
                <Movie v-on:movie-info="viewMovie" :movie="movie" :favorite="true" v-on:toggleFavorite="removeFavorite"/>
                <p>Favorite since: {{movie.created_at}}</p>
            </div>
        </div>
    </div>
</template>

<script>
import Movie from './../components/Movie/Movie.vue'
import {GetFavoritesMovies} from './../Api'

export default {
    name: 'favorites-movies',
    data(){
        return {
            movies: []
        }
    },
    created(){
        this.getFavorites();
    },
    components: {
        Movie
    },
    methods: {
        viewMovie(id){
            this.$router.push({ name: 'movieinfo', params: { id: id} });
        },
        getFavorites(){
            GetFavoritesMovies()
                .then(r => {
                    this.movies = r.data
                })
        },
        removeFavorite(id){
            this.movies = this.movies.filter(item =>item.id !== id)
        }
    }
}
</script>

<style scoped>
    .container{
        margin-top: 40px;
    }
</style>