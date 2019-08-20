<template>
    <figure class="image" @click="makeFavorite" :class="{'top-left': topLeft, 'top-rigth': topRigth, 'left-bottom': leftBottom, 'right-bottom': rightBottom}">
        <img class="favorite" :src="icon" alt="Favorite image" @mouseenter="toggleIcon(true)" @mouseleave="toggleIcon">
    </figure>
</template>

<script>
import Heart from './../assets/heart.png'
import HeartActive from './../assets/heart-active.png'
import {ToggleFavorite} from './../Api'

export default {
    name: 'FavoriteButton',
    data() {
        return {
            heart: Heart,
            heartActive: HeartActive,
            icon: null,
        } 
    },
    watch: {
        isFavorite: function(val){
            this.icon = val ? this.heartActive : this.heart
        }
    },
    props: {
        movieId: {
            type: Number,
            default: null
        },
        isFavorite : {
            type: Boolean,
            default: false
        },
        topLeft: {
            type: Boolean,
            default: false
        },
        topRigth: {
            type: Boolean,
            default: false
        },
        leftBottom: {
            type: Boolean,
            default: false
        },
        rightBottom: {
            type: Boolean,
            default: true
        }
    },
    mounted() {
        this.icon = this.isFavorite ? this.heartActive : this.heart
        this.$forceUpdate();

    },
    updated(){
        this.icon = this.isFavorite ? this.heartActive : this.heart;
    },
    methods: {
        makeFavorite(){
            ToggleFavorite(this.movieId)
                .then(r => {
                    this.icon = this.heartActive;
                    this.$emit('toggleFavorite', !this.isFavorite);
                })
        },
        toggleIcon(active){
            if(this.isFavorite) return
            this.icon = active == true ? this.heartActive : this.heart
        }
    }
}
</script>

<style scoped>
    figure {
        position: absolute;
        z-index: 30
    }
    .favorite {
        width: 36px;
        height: 36px;
    }
    .top-left{
        top: 20px;
        left: 20px
    }
    .top-rigth{
        top: 20px;
        right: 20px
    } 
    .left-bottom{
        bottom: 20px;
        left: 20px
    }
    .right-bottom{
        bottom: 20px;
        right: 20px
    }
</style>