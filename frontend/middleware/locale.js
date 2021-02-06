import axios from 'axios'
/*
 * 1. sets i18n.locale and state.locale if possible
 * 2. redirects if not with locale
 */

export default function ({
                             isHMR, app, store, route, params, error, redirect
                         }) {

    if (isHMR) { // ignore if called from hot module replacement
        return;
    } // if url does not have language, redirect to default language

    else if (!params.language) {
        if (process.env.appLocale) {
            //return redirect('/'+process.env.appLocale+route.fullPath);
         }
         //else {
        //     let language = window.navigator ? (window.navigator.language ||
        //         window.navigator.systemLanguage ||
        //         window.navigator.userLanguage) : "ru";
        //     return redirect('/'+language.substr(0, 2).toLowerCase()+route.fullPath);
        // }
    }
    // based on directory structure _language/xxxx, en/about has params.lang as "en"
    const locale = params.language || route.params.language;
    if (locale) {
        axios.defaults.headers.common['Accept-Language'] = locale
    }
    store.commit('SET_LANG', locale); // set store
    app.i18n.locale = store.state.locale;
}
