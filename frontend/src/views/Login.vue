<template>
    <section class="hero is-fullheight is-half">
        <div class="hero-body">
            <div class="container">
                <div class="columns is-centered">
                    <div class="column is-two-fifths">
                        <div class="card has-card-header-background">
                            <header class="card-header">
                                <p class="card-header-title">
                                    Moviefy
                                </p>
                            </header>
                            <div class="card-content has-text-left">
                                <form v-on:submit.prevent="authentication">
                                    <div class="notification is-danger" v-show="error" v-html="errorMessage"> </div>
                                    <div class="field">
                                        <label class="label">Email</label>
                                        <div class="control">
                                            <input id="email" v-model="email" class="input" :class="{'is-danger': error}" type="email" placeholder="email@example.com">
                                        </div>
                                    </div>
                                    <div class="field">
                                        <label class="label">Password</label>
                                        <div class="control">
                                            <input v-model="password" class="input" :class="{'is-danger': error}" type="password" placeholder="password">
                                        </div>
                                    </div>
                                    <hr />
                                    <div class="field is-grouped">
                                        <div class="control">
                                            <button type="submit" class="button is-primary">Login </button>
                                        </div>
                                        or &nbsp;
                                        <div class="control">
                                            <router-link class="button is-white" to="signup">Sign Up </router-link>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div> 
            </div>
        </div>
    </section>
</template>

<script>
import {Login, UserInfo} from './../Api'

export default {
    name: 'login',
    data(){
        return {
            email: '',
            password: '',
            error: false,
            errorMessage: ''
        }
    },
    methods: {
        authentication(){
            this.error = false;
            this.errorMessage = '';
            Login({email: this.email, password: this.password})
                .then(UserInfo)
                .then(r => {
                    this.$store.dispatch('credentials', r.data);
                    this.$router.replace({name: 'movies'})
                })
                .catch(e => {
                    this.error = true
                    if(e.response && e.response.data){
                        this.errorMessage = e.response.data.message + '<br >'
                        if(e.response.data.errors){
                            Object.keys(e.response.data.errors).forEach(key => {
                                this.errorMessage += "<br />" + e.response.data.errors[key].join('<br />')
                            });
                        }
                    }
                })
        }
    }
}
</script>

<style scoped>
    .card-header{
        background-color: #f5f5f5;
        border-bottom: 0;
    }
</style>