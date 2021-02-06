
export default {


  env: {
     appUrl: process.env.APP_URL,
     apiUrl: process.env.API_URL || process.env.APP_URL + '/api'
  },

  loading: {
     color: '#45ac34',
     height: '5px'
  },
  /*
  ** Nuxt rendering mode
  ** See https://nuxtjs.org/api/configuration-mode
  */
  mode: 'universal', 
  /*
  ** Nuxt target
  ** See https://nuxtjs.org/api/configuration-target
  */
  target: 'server',

  rootDir: __dirname, 
  srcDir: __dirname,

 /*
  ** Headers of the page
  ** See https://nuxtjs.org/api/configuration-head
  */
  head: {
    title: process.env.npm_package_name || 'PLUR',
    meta: [
      { charset: 'utf-8' },
      { name: 'viewport', content: 'width=device-width, initial-scale=1' },
      { hid: 'description', name: 'description', content: '' }
    ],
    link: [
      { rel: 'icon', type: 'image/x-icon', href: '/assets/img/logos/favicon.ico' }
    ],
    script: [

        {src: 'https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js'},
        /*
        {src: '/assets/js/vendor/jquery.fancybox.min.js' },
        {src: '/assets/js/vendor/slick.min.js'},
        {src: '/assets/js/vendor/aos.js'},
        {src: '/assets/js/vendor/jquery.responsiveTabs.min.js' },
        {src: '/assets/js/vendor/sticky-kit.min.js' },
        {src: '/assets/js/vendor/autosize.min.js'},
        {src: '/assets/js/main.js'}
*/
        //{src: '/assets/js/main.js', body: true}
    ],
  },
  /*
  ** Global CSS
  */
  css: [
      '@/assets/css/normalize.min.css',
      '@/assets/css/jquery.fancybox.min.css',
      '@/assets/css/slick.css',
      '@/assets/css/aos.css',
      '@/assets/css/style.css',
      '@/assets/css/page.css',
      '@/assets/css/style-about.css',
      '@/assets/css/article.css',
      '@/assets/css/breadcrumbs.css',
  ],
  /*
  ** Plugins to load before mounting the App
  ** https://nuxtjs.org/guide/plugins
  */
  plugins: [

  ],
  /*
  ** Auto import components
  ** See https://nuxtjs.org/api/configuration-components
  */
  components: true,
  /*
  ** Nuxt.js dev-modules
  */
  buildModules: [
  ],
  /*
  ** Nuxt.js modules
  */
  modules: [
    // Doc: https://axios.nuxtjs.org/usage
    '@nuxtjs/axios',
    '@nuxtjs/pwa',
    // Doc: https://github.com/nuxt/content
    '@nuxt/content',
      [
      'nuxt-i18n', {
          detectBrowserLanguage: {
              useCookie: true,
              cookieKey: 'i18n_redirected',
              alwaysRedirect: false,
              fallbackLocale: 'ru'
          },
          locales: [
              {
                  name: 'russian',
                  code: 'ru',
                  iso: 'ru-RU',
                  file: 'ru.js'
              },
              {
                  name: 'english',
                  code: 'en',
                  iso: 'en-US',
                  file: 'en.js'
              },
          ],
          lazy: true,
          langDir: 'lang/',
          defaultLocale: 'ru',
      }
      ]
  ],
  /*
  ** Axios module configuration
  ** See https://axios.nuxtjs.org/options
  */
  axios: {
      baseURL: 'https://plur.online/api/'
  },
  /*
  ** Content module configuration
  ** See https://content.nuxtjs.org/configuration
  */
  content: {},
  /*
  ** Build configuration
  ** See https://nuxtjs.org/api/configuration-build/
  */
  build: {

  },

  server: {
    port: 3030, // default: 3000
    host: '0.0.0.0', // default: localhost
  },
}
