import Vue from 'vue'
import Router from 'vue-router'
import Login from './views/Login.vue'
import SignUp from './views/SignUp.vue'
import Movies from './views/Movies.vue'
import FavoritesMovies from './views/Favorites.vue'
import MovieInfo from './views/MovieInfo.vue'
import Store from './store';
import { RefreshToken } from './Api';

Vue.use(Router)
const R = new Router({
  routes: [
    {
      path: '/',
      redirect: '/movies'
    },
    {
      path: '/login',
      name: 'login',
      component: Login
    },
    {
      path: '/signup',
      name: 'signup',
      component: SignUp
    },
    {
      path: '/movies',
      name: 'movies',
      component: Movies
    },
    {
      path: '/favorites-movies',
      name: 'favorites-movies',
      component: FavoritesMovies
    },
    {
      path: '/movies-details/:id',
      name: 'movieinfo',
      component: MovieInfo
    }
   
  ]
})

R.beforeEach((to, from, next) => {
  RefreshToken();
  R.app.$store.dispatch('isAuthenticated');
  if(to.name != 'login' && to.name != 'signup'){
    if (!R.app.$store.state.isAuthenticated){
      return next({ name: 'login' })
    } else {
      next();
    }
  } else {
    R.app.$store.state.isAuthenticated ? next({path: '/'}) : next();
  }
})

export default R
