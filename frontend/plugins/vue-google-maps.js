import Vue from 'vue'
import * as VueGoogleMaps from 'vue2-google-maps'

Vue.use(VueGoogleMaps, {
    load: {
        key: 'AIzaSyBhTDZgc9bADR66mmeMfStpuhW15NPjK80',
        libraries: 'places',
        region: 'RU',
    	language: 'ru',
    },
    //installComponents: true
})
