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
                                <form v-on:submit.prevent="signUp">
                                    <div class="notification" :class="{'is-danger': error, 'is-success': success}" v-show="error || success" v-html="errorMessage">
                                    </div>
                                    <div class="field">
                                        <label class="label">Name</label>
                                        <div class="control">
                                            <input v-model="name" class="input" :class="{'is-danger': error}" type="text" placeholder="John Doe">
                                        </div>
                                    </div>
                                    <div class="field">
                                        <label class="label">Email</label>
                                        <div class="control">
                                            <input v-model="email" class="input" :class="{'is-danger': error}" type="email" placeholder="email@example.com">
                                        </div>
                                    </div>
                                    <div class="field">
                                        <label class="label">Password</label>
                                        <div class="control">
                                            <input v-model="password" class="input" :class="{'is-danger': error}" type="password" placeholder="password">
                                        </div>
                                    </div>
                                     <div class="field">
                                        <label class="label">Confirm password</label>
                                        <div class="control">
                                            <input v-model="confirmPassword" class="input" :class="{'is-danger': error}" type="password" placeholder="password">
                                        </div>
                                    </div>
                                    <hr />
                                    <div class="field is-grouped">
                                        <div class="control">
                                            <button type="submit" class="button is-primary">Sign Up </button>
                                        </div>
                                        or &nbsp;
                                        <div class="control">
                                            <router-link class="button is-white" to="login">Login </router-link>
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
import {SignUp} from './../Api';

export default {
    name: 'signup',
    data(){
        return {
            name: '',
            email: '',
            password: '',
            confirmPassword: '',
            error: false,
            errorMessage: '',
            success: false
        }
    },
    methods:{
        signUp(){
            this.error = false;
            this.errorMessage = '';
            let payload = {
                name: this.name,
                email: this.email,
                password: this.password,
                password_confirmation: this.confirmPassword
            }
            SignUp(payload)
                .then(r => {
                    this.success = true
                    this.errorMessage = r.data.message
                    this.errorMessage += '<br /> Redicting to login...'
                    this.resetUser()
                    let that = this
                    setTimeout(function(){
                        that.$router.push({name: 'login'})
                    }, 3000)
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
        },
        resetUser(){
            this.name = '';
            this.email = '';
            this.password = '';
            this.confirmPassword = '';
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