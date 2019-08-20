<template>
    <div class="card-image">
        <img :src="`https://image.tmdb.org/t/p/w500${path}`" alt="cover">
    </div>
</template>

<script>
export default {
    props: {
        path: {
            type: String,
            default: "https://via.placeholder.com/200x150"
        }
    }
}
</script>

<style scoped>
    .card-image {
        position: absolute;
        height: 100%;
        top: 0;
        left: 0;
        width: 100%;
        max-height: 340px!important;
        z-index: -1;
    }
    .card-image > img{
        opacity: .8;
        width: inherit;
        height: inherit;
    }
</style>