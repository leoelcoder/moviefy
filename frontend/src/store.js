import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export default new Vuex.Store({
  state: {
    isAuthenticated: false,
    user:{
      name: '',
      email: ''
    }
  },  
  mutations: {
    SET_IS_AUTHENTICATED(state, value){
      state.isAuthenticated = value
    },
    SET_USER(state, value){
      state.user = value
    }
  },
  actions: {
    isAuthenticated(context){
        let token = localStorage.getItem('access_token')
        context.commit('SET_IS_AUTHENTICATED', !!token)
        context.commit('SET_USER', { name: localStorage.getItem('user_name'), email: localStorage.getItem('user_email') })
    },
    credentials(context, payload){
      context.commit('SET_USER', { name: payload.name, email: payload.email})
      localStorage.setItem('user_name', payload.name)
      localStorage.setItem('user_email', payload.email)
      context.commit('SET_IS_AUTHENTICATED', true)
    },
    logout(context){
      context.commit('SET_IS_AUTHENTICATED', false)
      context.commit('SET_USER', {name: '', email: ''})
      localStorage.removeItem('access_token')
      localStorage.removeItem('user_name')
      localStorage.removeItem('user_email')
    }
  }
})
