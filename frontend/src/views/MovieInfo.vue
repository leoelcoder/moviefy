<template>
    <div class="container">
        <div class="columns">
            <div class="column is-one-quarter-tablet cover">
                <MovieCover :path="movie.poster_path"/>
            </div>
            <div class="column is-two-quarters-tablet info">
                <MovieTitle :title="movie.title" class="title"/>
                <br /><br />
                <div class="content movie-sinopsis">
                    <h4>Overview: </h4>
                    {{movie.overview}}
                </div>
                <FavoriteButton :movie-id="movie.id" :isFavorite="favorite"/>
            </div>
             <div class="column is-one-quarter-tablet cover">
                <MovieCover :path="movie.backdrop_path"/>
            </div>
        </div>
    </div>
</template>

<script>
import MovieCover from './../components/Movie/MovieCover'
import MovieSinopsis from './../components/Movie/MovieSinopsis.vue'
import MovieTitle from './../components/Movie/MovieTitle.vue'
import FavoriteButton from './../components/FavoriteButton.vue'

import {GetMovieInfo} from './../Api'

export default {
    name: 'MovieInfo',
    data(){
        return {
            movie: {},
            favorite: false
        }
    },
    components: {
        MovieCover,
        MovieSinopsis,
        MovieTitle,
        FavoriteButton
    },
    mounted() {
        let that = this;
        GetMovieInfo(this.$route.params.id)
            .then(r => {
                that.favorite = r.data.favorite
                that.movie = r.data
                that.$forceUpdate()
            })
            that.$forceUpdate()
    },
}
</script>

<style scoped>
    .container{
        margin-top: 40px;
    }
    .cover{
        height: 330px;
        position: relative;
    }
    .info{
        height: 330px;
        position: relative;
        background-color: hsl(204, 86%, 53%);
        color: white;
        text-align: left
    }
    .title {
        color: black!important
    }
</style>