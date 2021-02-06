import axios from 'axios'

process.env.NODE_TLS_REJECT_UNAUTHORIZED = '0'

export default ({ app, store, redirect, $axios }) => {
  axios.defaults.baseURL = process.env.apiUrl

  if (process.server) {
    return
  }

  // Request interceptor
  axios.interceptors.request.use((request) => {
    request.baseURL = process.env.apiUrl

    const token = store.getters['auth/token']

    if (token) {
      request.headers.common.Authorization = `Bearer ${token}`
        $axios.setToken(token, 'Bearer')
    }

    // const locale = store.getters['lang/locale']
    // if (locale) {
    //   request.headers.common['Accept-Language'] = locale
    // }

    return request
  })

  // Response interceptor
  // axios.interceptors.response.use(response => response, (error) => {
  //   const { status } = error.response || {}
  //
  //   if (status >= 500) {
  //       console.log('error')
  //   }
  //
  //     if (status === 401 && store.getters['auth/check']) {
  //         then(() => {
  //             console.log('token_expired')
  //             store.commit('auth/LOGOUT')
  //
  //             redirect({ path: '/login' })
  //         })
  //     }
  //
  //   return Promise.reject(error)
  // })
}
