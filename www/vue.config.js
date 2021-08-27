module.exports = {
    //mode: 'production',
    devServer: {
        disableHostCheck: true,
        hot: true,
        proxy: {
            "^/api": {
                target: "http://webserver/",
                ws: true,
                secure: false
            },
        },
        port: 8080,
        watchOptions: {
            ignored: /node_modules/,
            aggregateTimeout: 300,
            poll: 1000,
        },
    },
};