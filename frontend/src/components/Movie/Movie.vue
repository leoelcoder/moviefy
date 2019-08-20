<template>
    <div class="card" v-on:mouseenter="toggleSinopsis" v-on:mouseleave="toggleSinopsis">
        <div class="card-content" >
            <MovieTitle :title="movie.title"/>
            <MovieCover :path="movie.poster_path"/>
        </div>
       
        <MovieSinopsis :sinopsis="movie.overview" v-show="sinopsisActive" v-on:clickEvent="viewMovie"/>
        <FavoriteButton :movie-id="movie.id" v-on:toggleFavorite="toggleFavorite" :isFavorite="favorite || isFavorite"/>
    </div>
</template>

<script>
import MovieCover from './MovieCover.vue'
import MovieTitle from './MovieTitle.vue'
import FavoriteButton from './../FavoriteButton.vue'
import MovieSinopsis from './MovieSinopsis.vue'

export default {
    data(){
        return {
            sinopsisActive: false,
            isFavorite:false
        }
    },
    props: {
        movie: {
            type: Object,
            default: () => ({})
        },
        favorite: {
            type: Boolean,
            default: false
        }
    },
    components: {
        MovieCover,
        MovieTitle,
        MovieSinopsis,
        FavoriteButton
    },
    mounted(){
        this.isFavorite = this.movie.favorite
    },
    methods: {
        toggleSinopsis(){
            this.sinopsisActive = !this.sinopsisActive
        },
        toggleFavorite(value){
            this.isFavorite = value
            this.$emit('toggleFavorite', this.movie.id)
        },
        viewMovie(){
            this.$emit('movie-info', this.movie.id);
        }
    }
}
</script>

<style scoped>
    .card {
        height: 340px;
        position: relative;
        background-color: transparent!important
    }
    .card-content{
        padding: 0px!important
    }
</style>