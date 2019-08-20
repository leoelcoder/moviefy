<template>
    <div class="media">
        <div class="media-content">
            {{title}}
        </div>
    </div>
</template>

<script>
import FavoriteButton from './../FavoriteButton.vue'

export default {
    name: 'MovieTitle',
    props: {
        title: {
            type: String,
            default: 'Title'
        }
    }
}
</script>

<style scoped>
    .media{
        z-index: 1;
        background-color: white;
        text-align: center
    }
    .media-content{
        font-size: 18px!important;
        font-weight: bold;
        text-align: left;
        padding: 0px 5px
    }
</style>