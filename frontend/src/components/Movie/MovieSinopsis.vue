<template>
    <div class="content movie-sinopsis" @click="emitClick">
        <h4>Overview: </h4>
        {{sinopsis}}
    </div>
</template>

<script>
export default {
    name: 'MovieSinopsis',
    props: {
        sinopsis: {
            type: String,
            default: 'Lorem insump'
        }
    },
    methods: {
        emitClick(){
            this.$emit('clickEvent')
        }
    },
}
</script>

<style scoped>
    .movie-sinopsis{
        font-size: 13px;
        text-align: left;
        overflow: hidden;
        height: 100%;
        position: absolute;
        top: 0;
        left: 0;
        background-color: hsl(204, 86%, 53%);
        color: white;
        padding: 10px
    }
</style>