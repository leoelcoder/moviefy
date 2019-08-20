<template>
    <nav class="navbar is-primary">
        <div class="container">
            <div class="navbar-brand">
                <a href="" class="navbar-item">
                    Moviefy
                </a>
                <span class="navbar-burger burger" data-target="menu-navigation" @click="showMenu">
                    <span></span>
                    <span></span>
                    <span></span>
                </span>
            </div>
            <div id="menu-navigation" class="navbar-menu" :class="{'is-active': mobileMenu}">
                <div class="navbar-start">
                    <router-link class="navbar-item" :to="{path: '/'}">Movies</router-link>
                    <router-link class="navbar-item" to="favorites-movies">Favorites</router-link>
                </div>
                <div class="navbar-end">
                    <li class="navbar-item" v-show="isAuthenticated">Hola, {{user.name}}</li>
                    <a href="#" class="navbar-item" v-show="isAuthenticated" @click.prevent="logout">Logout</a>
                    <router-link to="login" class="navbar-item" v-show="!isAuthenticated">Login</router-link>
                </div>
            </div>
        </div>
    </nav>
</template>

<script>
import {Logout} from './../Api'

export default {
    name: 'Nav',
    data(){
        return {
            mobileMenu: false
        }
    },
    computed: {
        isAuthenticated(){
            return this.$store.state.isAuthenticated
        },
        user(){
            return this.$store.state.user
        }
    },
    methods: {
        showMenu(target){
            this.mobileMenu = !this.mobileMenu;
        },
        logout(){
            Logout()
                .then(() => {
                    this.$store.dispatch('logout')
                    this.$router.replace({name: 'login'})
                })
                .catch(console.log)
        }
    }
}
</script>

<style scoped>
    .navbar-brand{
        font-weight: bold;
    }
</style>