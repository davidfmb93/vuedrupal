const path = require("path");


module.exports = {
  "transpileDependencies": [
    "vuetify"
  ],

  chainWebpack: config => {
    config.module.rule('images').use('url-loader')
      .loader('file-loader') // replaces the url-loader
      .tap(options => Object.assign(options, {
        name: './img/[name].[hash:8].[ext]'
      }))
    config.module.rule('svg').use('file-loader')
      .tap(options => Object.assign(options, {
        name: './img/[name].[hash:8].[ext]'
      }))
  },

  // modules/custom/vuedrupal/vue/dist/images

  configureWebpack: {

    output: {
        filename: "./js/app.js",
        chunkFilename: "./js/chunk-vendors.js"
    },

  },
  css: {
    extract: {
      filename: './css/main.css',
      chunkFilename: './css/chunk-vendors.css',
    },
  },
}