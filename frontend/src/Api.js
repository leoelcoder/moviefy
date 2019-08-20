import axios from 'axios'

const Api = axios.create({
    baseURL: '/api',
    headers: {
        'Accept': 'application/json',
        'Content-Type': 'application/json'
    }
})

export const Login = (payload) => {
    return Api.post('/auth/login', payload)
        .then(r => {
            Api.defaults.headers['Authorization'] = `${r.data.token_type} ${r.data.access_token}`
            localStorage.setItem('access_token', r.data.access_token)
            return r.data.access_token
        })
}

export const RefreshToken = () => {
    let token = localStorage.getItem('access_token')
    Api.defaults.headers['Authorization'] = `Bearer ${token}`;

}
export const SignUp = (payload) => {
    return Api.post('/auth/signup', payload)
}

export const UserInfo = () => {
    return Api.get('/auth/user');
}

export const Logout = () => {
    return Api.get('/auth/logout')
}

export const GetPopularMovies = (page) => {
    return Api.get('/movies/popular/' + page)
}

export const ToggleFavorite = (id) => {
    return Api.put('movies/toggle-favorite/' + id)
}

export const GetFavoritesMovies = () => {
    return Api.get('movies/favorites/')
}

export const GetMovieInfo = (id) => {
    return Api.get('movies/movie/' + id)
}