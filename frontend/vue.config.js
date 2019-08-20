module.exports = {
    devServer: {
        host: '0.0.0.0',
        port: 8080,
        proxy:{
            '^/api': {
                target: 'http://0.0.0.0:8000',
                ws: true,
                changeOrigin: true
            }
        }
    }
}