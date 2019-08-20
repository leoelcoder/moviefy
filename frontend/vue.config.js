module.exports = {
    devServer: {
        host: '0.0.0.0',
        port: 8080,
        proxy:{
            '^/api': {
                target: 'http://backend:8000',
                ws: true,
                changeOrigin: true
            }
        }
    }
}